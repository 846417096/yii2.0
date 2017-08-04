<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/17
 * Time: 11:16
 */

namespace frontend\models;


use yii\base\Model;
use common\models\HttpRequest;


class UpdatauserForm extends Model
{
    public $email;
    public $username;

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

    public function updata()
    {
        if (!$this->validate()) {
            return null;
        } else {
            $data=[];
            $data['SignForm']['email']=$this->email;
            $data['SignForm']['username']=$this->username;
            return HttpRequest::request('users/','PUT',$data);
        }
    }
}