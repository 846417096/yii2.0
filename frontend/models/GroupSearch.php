<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/19
 * Time: 15:42
 */

namespace frontend\models;

use  common\models\HttpRequest;
use frontend\models\User;

class GroupSearch extends Group
{
    public function rules()
    {
        return [
            [['user_id', 'id'], 'integer'],
            [['name', 'desc', 'created_time'], 'safe'],
        ];
    }

    public function search($config=[])
    {
        $data = HttpRequest::request('groups');
        $data = json_decode($data,true);
        return $data;
    }

    public function searchByid($id)
    {
        $data = HttpRequest::request('groups');
        $data = json_decode($data, true);
        foreach ($data as $key => $value) {
            if ($value['user_id'] == $id) {
                $group_id[$key] = $value['id'];
            }
        }
        foreach ($group_id as $k => $v) {
            $data=HttpRequest::request('groups/'.$v);
            $data=json_decode($data,true);
            $dataArr[$k]=$data['data'][0];
        }
        return $dataArr;
    }

    public function searchBygid($id){
        $data=HttpRequest::request('user-groups/'.$id.'type=group');
        $person=json_decode($data,true);
        $person=$person['data'];
        if (isset($person)){
            return $person;
        }else{
            return null;
        }
    }
}