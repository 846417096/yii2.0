<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/18
 * Time: 18:15
 */

namespace frontend\controllers;


use frontend\controllers\controller\BaseController;
use frontend\models\GSignupForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\GroupSearch;
use common\models\HttpRequest;
use frontend\models\User;

class GroupController extends BaseController
{
    /*
     * 显示所有组织
     */
    public function actionIndex()
    {
        return $this->actionMygroup();
    }

    public function actionSearch($id)
    {
        $data = new GroupSearch();
        $id = $data->searchByid($id);
        if (!empty($id)) {
            foreach ($id as $key => $value) {
                $data = [];
                $json = HttpRequest::request('groups/' . $value);
                $data = json_decode($json, true);
            }
            return $this->render('search', ['model' => $data]);
        } else {
            return null;
        }
    }

    public function actionSignup()
    {
        $model = new GSignupForm();
        if ($model->load(\Yii::$app->request->post())) {
            $gid = $model->create();
            $gid = json_decode($gid);
            $gid = $gid->data[0]->id;
            $this->actionJoingroup($gid);
            return $this->actionIndex();
        }

        return $this->render('gsignup', ['model' => $model]);
    }

    public function actionMygroup()
    {
        $id = \Yii::$app->user->getId();
        $data = self::GetDate('Mygroup');
        if (empty($data)) {
            $data = self::GET('user-groups/' . $id . '?type=user');
            $data = json_decode($data, true);
            self::createCache($id,'Mygroup',$data);
        }
        if ($this->checkArray($data)) {
            if ($data['message'] == '此用户未加入任何组织') {
                return $this->render('index', ['data' => null]);
            } else {
                $data = ArrayHelper::getValue($data, 'data.1');

                $data = $this->checkState($data)['active'];

                return $this->render('index', ['data' => $data]);
            }
        } else {
            return $this->render('index', ['data' => null]);
        }

    }

    public function actionRewrite()
    {
        $id = \Yii::$app->user->getId();
        $data = HttpRequest::request('user-groups/' . $id . '?type=user');
        $data = json_decode($data, true);
        if ($this->checkArray($data)) {
            if ($data['message'] == '此用户未加入任何组织') {
                return $this->render('index', ['data' => null]);
            } else {
                $data = ArrayHelper::getValue($data, 'data.1');

                $data = $this->checkState($data)['die'];

                return $this->render('index', ['data' => $data]);
            }
        } else {
            return $this->render('index', ['data' => null]);
        }
    }

    public function actionViewgroup($gid)
    {
        $data = HttpRequest::request('groups/' . $gid);
        $data = json_decode($data);
        $data = ArrayHelper::getValue($data, 'data.0');
        return $this->render('showgroup', ['data' => $data]);
    }

    public function actionViewmember($gid)
    {
        $data = HttpRequest::request('user-groups/' . $gid . '?type=group');
        $data = json_decode($data);
        if ($data->success == 'success') {
            $data = $data->data[1];
            return $this->render('showmember', ['data' => $data]);
        }
    }

    public function actionJoingroup($gid)
    {
        $user_id = \Yii::$app->user->getId();
        $group_id = $gid;
        $data['UserGroupForm']['user_id'] = $user_id;
        $data['UserGroupForm']['group_id'] = $gid;
        $state = HttpRequest::request('user-groups', 'POST', $data);
        $state = json_decode($state, true);
        if ($this->checkArray($state)) {
            return false;
        } else {
            return $this->actionMygroup();
        }
    }

    public function actionResign($gid)
    {
        $id = \Yii::$app->user->getId();
        $data['data'][1][0] = $id;
        $data['data'][1][1] = $gid;
        $res = HttpRequest::request('user-groups', 'DELETE', $data);
        if (!$res) {
            return false;
        } else {
            return true;
        }
    }

    public function actionDelete($gid)
    {
        $data['data'][1] = $gid;
        HttpRequest::request('groups', 'DELETE', $data);
        return $this->actionMygroup();
    }

    /*
        public function checkmember($gid)
        {
            $id = \Yii::$app->user->getId();
            $users = HttpRequest::request('user-groups/' . $id . '/?group_id=' . $gid);
            $state = ArrayHelper::getValue($users, 'message');
            if ($state == 'success') {
                $member = ArrayHelper::getValue($users, 'data');
                if (!empty($member)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }*/

    public function checkState($data = [])
    {
        foreach ($data as $k => $v) {
            if ($v['state'] == 1) {
                $Activedata[$k] = $v;
            } else {
                $Diedata[$k] = $v;
            }
        }
        if (isset($Diedata) && isset($Activedata)) {
            $data = array(
                'active' => $Activedata,
                'die' => $Diedata,
            );
        } else if (isset($Diedata)) {
            $data = array(
                'die' => $Diedata,
            );
        } else if (isset($Activedata)) {
            $data = array(
                'active' => $Activedata,
            );
        } else {
            return null;
        }
        return $data;
    }

    public function checkArray($data = [])
    {
        if ($data['success'] == 'success') {
            return true;
        } else {
            return false;
        }
    }

    public function checkObject($data = [])
    {
        if ($data->success == 'success') {
            return true;
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $data = new GroupSearch();
        $model = $data->search();
        return $model;
    }

    /*    public function getByid(){
            $data=new GroupSearch();
            $id=\Yii::$app->user->getId();
            $model=$data->searchByid($id);
            return $model;
        }*/
}