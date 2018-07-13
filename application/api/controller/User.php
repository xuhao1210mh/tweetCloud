<?php

namespace app\api\controller;

use \think\Controller;
use \app\api\controller\Base;
use \think\facade\Session;

class User extends Base{

    //登陆
    public function login(){
        $data = [
            'phone' => md5($_POST['phone']),
            'password' => md5($_POST['password'])
        ];
        $result = Model('user')->checkUser($data);
        if(!empty($result)){
            $uid = $result['uid'];
            $phone = $result['phone'];
            // $redis = $this->redisConnect();
            // $redis->setex(md5($uid), 432000, $phone);
            Session::set('uid', $uid);
            $this->returnJson(1, '登陆成功', md5($uid));
        }
        $this->returnJson(0, '登陆失败');
    }

    public function logout(){
        Session::delete('uid');
        $uid = Session::get('uid');
        if(empty($uid)){
            $this->returnJson(1, '退出成功');
        }
        $this->returnJson(0, '退出失败');
    }

}