<?php
/**
 * Created by PhpStorm.
 * User: 84641
 * Date: 2017/8/7
 * Time: 0:58
 */

namespace frontend\controllers\controller;


use yii\web\Controller;
use common\models\HttpRequest;

class BaseController extends Controller
{
    /*
     *@param $url 请求地址
     *@return  返回json
     */
    public static function GET($url)
    {
        return HttpRequest::request($url);
    }

    /*
     * @param $url 请求地址
     * @param $data 发送的数据
     * @return 返回json
     */
    public static function POST($url, $data)
    {
        return HttpRequest::request($url, 'POST', $data);
    }

    /*
     * @param $url 请求地址
     * @param $data 删除的数据
     * @return 返回json
     */
    public static function DELETE($url, $data)
    {
        return HttpRequest::request($url, 'DELETE', $data);
    }

    /*
     * @param $url 请求地址
     * @param $data 修改的数据
     * @return 返回json
     */
    public static function PUT($url, $data)
    {
        return HttpRequest::request($url, 'PUT', $data);
    }

    /*
     * @param $type 是所需数据的类型  如果为空 则返回所有缓存 如果存在 则返回该类型数据
     * 该函数判断缓存是都存在 如果存在则直接返回缓存数据 否则返回false
     */
    public static function GetDate($type = "")
    {
        $id = \Yii::$app->user->getId();
        $cache = \Yii::$app->cache;
        if (self::checkChace($type)) {
            $data = $cache->get($id);
            if (!empty($type)) {
                return $data[$type];
            } else {
                return $data;
            }
        } else {
            return false;
        }
    }

    public static function checkChace($type = "")
    {
        $id = \Yii::$app->user->getId();
        $cache = \Yii::$app->cache;
        $data = $cache->get($id);
        if (!empty($type) && !empty($data[$type])) {
            return true;
        } else if (empty($data)) {
            return true;
        } else {
            return false;
        }

    }

    /*
     *@param $id 用户id
     *@param $type 储存的类型
     */
    public static function createCache($id, $type, $data)
    {
        $cache = \Yii::$app->cache;
        $need = $cache->get($id);
        $need[$type] = $data;

        var_dump($need);
        die();
        if ($cache->get($id)) {
            return $cache->set($id, $need[$type], 60 * 60);
        } else {

            var_dump($need);
            die();
        }

    }

}