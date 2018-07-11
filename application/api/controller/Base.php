<?php

namespace app\api\controller;

use \think\Controller;
use \think\Request;

header('Access-Control-Allow-Origin:*');

class Base extends Controller{

    public function _initialize(){
        
    }

    public function returnJson($code, $msg, $data = null){
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        echo json_encode($response);
        exit;
    }

    public function redisConnect(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        return $redis;
    }

}