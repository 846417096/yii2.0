<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/18
 * Time: 9:14
 */

namespace frontend\models;


use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use common\models\HttpRequest;

class UserinfoForm extends ActiveRecord
{
    public $username;
    public $email;

    public function rules()
    {
        return [
            ['username', 'string', 'min' => 6, 'max' => 30, 'message' => '用户名不能小于6个字符或者大于30个字符'],
            ['username', 'required', 'messag' => '用户名不能为空'],
            ['username', 'filter', 'filter' => 'trim'],

            ['email', 'email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'require', 'message' => '邮箱不能为空'],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => '该邮箱已经被使用'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户昵称',
            'emai' => '邮箱',
        ];
    }

    public function updata(){
        if (!$this->validate()){
            return null;
        }else{
            $id=\Yii::$app->user->getId();
            $data=[];
            $data['SignForm']['username']=$this->username;
            $data['SignForm']['email']=$this->email;
            return HttpRequest::request('users?user_id='.$id,'PUT',$data);
        }
    }
}