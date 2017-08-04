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
            'user_id'=>'创建人',
            'name'=>'团队名',
            'desc' => '描述',
            'created_time' => '组织创建时间',
        ];
    }


}