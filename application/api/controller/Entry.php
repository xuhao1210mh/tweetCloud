<?php

namespace app\api\controller;

use \think\Controller;

class Entry extends Controller{

    public function login(){
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];
        $result = Model('user')->checkUser($data);
        if($result){
            $redis = $this->redisConnect();
            returnJson(1, '登陆成功');
        }
        returnJson(0, '登陆失败');
    }

}