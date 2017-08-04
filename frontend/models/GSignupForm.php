<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/20
 * Time: 12:16
 */

namespace frontend\models;


use yii\base\Model;
use common\models\HttpRequest;

class GSignupForm extends Model
{
    public $user_id;
    public $name;
    public $desc;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['desc', 'string', 'max' => 200],
        ];
    }

    /**
     * 建立一个团队
     *
     * @return User|null the saved model or null if saving fails
     */
    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        /*        $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->$this->password;
                $user->generateAuthKey();
                return $user->save() ? $user : null;*/
        $data = [];
        $data['GroupForm']['user_id'] = \Yii::$app->user->getId();
        $data['GroupForm']['name'] = $this->name;
        $data['GroupForm']['desc'] = $this->desc;

        return HttpRequest::request('groups', 'POST', $data);
    }

    /**
     * 建立一个团队部门
     *
     * @return User|null the saved model or null if saving fails
     */

    public function createD($gid){
        if (!$this->validate()){
            return null;
        }
        $id=\Yii::$app->user->getId();
        $data=[];
        $data['DepartmentForm']['user_id']=$id;
        $data['DepartmentForm']['group_id']=$gid;
        $data['DepartmentForm']['name']=$this->name;
        $data['DepartmentForm']['desc']=$this->desc;

        return HttpRequest::request('departments','POST',$data);
    }


}