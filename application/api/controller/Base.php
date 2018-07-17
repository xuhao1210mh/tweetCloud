<?php

namespace app\api\controller;

use \think\Controller;
use \think\Request;
use \think\facade\Session;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, DELETE, PUT, OPTIONS");
header('Access-Control-Allow-Headers: x-requested-with, token');

class Base extends Controller{

    //检测header头里的token
    public function checkToken(){
        $token = $_POST['token'];
        $redis = self::redisConnect();
        $uid = $redis->get($token);
        if(empty($uid)){
            self::returnJson(11, '请登陆');
        }else{
            $redis->setex($token, 432000, $uid);
            return $token;
        }
    }

    //返回json数据
    public function returnJson($code, $msg, $data = null){
        $response = [
            /**
             * code = 11时，用户未登陆；
             * code = 1时，请求成功；
             * code = 0时，请求失败；
             * code = 10时，未知错误;
             */
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        echo json_encode($response);
        exit;
    }

    //创建redis连接
    public function redisConnect(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        return $redis;
    }

}