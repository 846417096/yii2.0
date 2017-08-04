<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/21
 * Time: 17:26
 */

namespace frontend\controllers;


use frontend\models\GSignupForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\HttpRequest;

class DepartmentController extends Controller
{
    public function actionSignup($gid)
    {
        $model = new GSignupForm();
        if ($model->load(\Yii::$app->request->post())) {
            $model->createD($gid);
            return $this->goBack();
        }
        return $this->render('Dsignup', ['model' => $model]);
    }

    public function actionViewdepartment($gid)
    {
        $data = HttpRequest::request('departments/' . $gid . '?type=group');
        $model = json_decode($data);
        if (!empty($model->data[0])) {
            $model = $model->data[0];
        } else {
            $model = null;
        }
        return $this->render('showdepartment', ['model' => $model]);

    }

    /*
     * 差一个视图文件return
     *
     */
    public function actionViewperson($gid)
    {
        $id = \Yii::$app->user->getId();
        $users = HttpRequest::request('user-groups/' . $gid . '/?type=group');
        $users = json_decode($users, true);
        $users = ArrayHelper::getValue($users, 'data.id');
    }

    public function actionAddperson($gid)
    {

    }


    public function getdata()
    {

    }

    public function Createcache()
    {
        $cache = \Yii::$app->cache;
        $data = HttpRequest::request('departments');
        $data = json_decode($data);
        foreach ($data as $k => $v) {
            $id = $v->group_id;
            $cachedata = serialize($v);
            $cache->set('departments' . $id, $cachedata, 60 * 60);
        }
    }

}