<?php

namespace app\api\controller;

use \app\api\controller\Base;

class CustomerCenter extends Base{

    //直推列表
    public function pushList(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        $date = $_POST['date'];
        $result = Model('push')->getPush($uid, $date);
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //创建直推信息
    public function createPush(){
        $product_id = $_POST['product_id'];
        $uid = $_POST['uid'];
        //客户信息
        $data = [
            'client_id' => uniqid('c'),
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'age' => $_POST['age'],
            'area' => $_POST['area']
        ];

        $client_id = self::addClient($data);
        if($client_id){
            $result = self::addPush($product_id, $uid, $client_id);
        }
        $this->returnJson(0, '请求失败');
    }

    //增加客户信息
    private function addClient($data){
        $result = Model('client')->postClient($data);
        if($result){
            return $result;
        }
        return 0;
    }

    //增加直推信息
    private function addPush($product_id, $uid, $client_id){
        $user_info = Model('user')->getUserInfo($uid);
        $product_info = Model('product')->getProductInfo($product_id);
        $data = [
            'push_id' => uniqid('o'),
            'product_id' => $product_id,
            'uid' => $uid,
            'product_name' => $product_info['name'],
            'name' => $user_info['nickname'],
            'number' => $user_info['phone'],
            'client_id' => $client_id,
            'create_date' => date('Y:m'),
            'create_time' => date('Y:m:d H:i:s'),
            'status' => 1
        ];
        $result = Model('push')->setPush($data);
        if($result){
            $this->returnJson(1, '请求成功', $product_info['url']);
        }
        $this->returnJson(0, '请求失败');
    }

}