<?php

namespace app\api\controller;

use \think\Controller;
use \app\api\controller\Base;

class Entry extends Base{

    public function __construct(){

    }

    public function login(){
        // $data = [
        //     'phone' => $_POST['phone'],
        //     'password' => $_POST['password']
        // ];
        $data = [
            'username' => '1875219984',
            'password' => 'xuhao9898'
        ];
        $result = Model('user')->checkUser($data);
        if(!empty($result)){
            //$uid = $result['uid'];
            //$redis = $this->redisConnect();
            //$redis->setex('');
            $this->returnJson(1, '登陆成功');
        }
        $this->returnJson(0, '登陆失败');
    }

    public function test(){
        parent::__construct();
    }

}