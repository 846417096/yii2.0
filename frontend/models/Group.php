<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/19
 * Time: 15:37
 */

namespace frontend\models;


use common\models\HttpRequest;
use yii\db\ActiveRecord;

class Group extends ActiveRecord
{
    public function rules()
    {
        return [

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '创建人',
            'name' => '团队名',
            'desc' => '描述',
            'created_time' => '组织创建时间',
        ];
    }

    /*
     * @param $type 返回数据类型是数组还是对象
     * @return 返回一个数组 键名 array object
     */
    public static function GetAllGroup()
    {
        $user_id = \Yii::$app->user->getId();
        $data_json = HttpRequest::request($user_id . '?type=user');
        $data_array = json_decode($data_json, true);
        $data_object = json_decode($data_json);
        $data=array(
            'array'=>$data_array,
            'object'=>$data_object
            );
        return $data;

    }

    /*
     * @param $gid 组织id
     */

    public static function GetOneGroup($gid)
    {

    }

}