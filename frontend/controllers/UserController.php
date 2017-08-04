<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/17
 * Time: 23:59
 */

namespace frontend\controllers;

use common\models\HttpRequest;
use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\UserinfoForm;
use frontend\models\UpdataForm;


class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('/site/index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (\Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionView()
    {
        $id = \Yii::$app->user->getId();
        $cache = \Yii::$app->cache;
        $data = $cache->get('user' . $id);
        if ($data === false) {
            $this->Createcache();
        }
        $data = unserialize($cache->get('user' . $id)   );
        return $this->render('view', ['model' => $data]);
        /*$model = User::findByUsername($id);*/
    }


    public function actionUpdate($id)
    {

        $cache = \Yii::$app->cache;
        $data = $cache->get('user' . $id);
        if ($data === false) {
            $this->Createcache();
            $this->actionUpdate($id);
        }
        $data = unserialize($data);

        $model = new UpdataForm();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->updata())
                return $this->render('view');
        } else {
            return $this->render('update', [
                'model' => $data,
            ]);
        }
    }

    public function getdata($parame)
    {
        $cache = \Yii::$app->cache;
        $data = $cache->get($parame);
        if ($data === false) {
            $this->Createcache();
            $this->getdata($parame);
        } else {
            return unserialize($data);
        }
    }

    public function Createcache()
    {
        $cache = \Yii::$app->cache;
        $data = HttpRequest::request('users');
        $data = json_decode($data);
        foreach ($data as $k => $v) {
            $id = $v->id;
            $cachedata = serialize($v);
            $cache->set('user' . $id, $cachedata, 60 * 60);
        }
    }
}