<?php

namespace app\api\controller;

use \think\Controller;
use \app\api\controller\Base;

class User extends Base{

    //登陆
    public function login(){
        //获取前端传递数据
        $data = [
            'phone' => $_POST['phone'],
            'password' => md5($_POST['password'])
        ];
        $result = Model('user')->checkUser($data);
        if(!empty($result)){
            $uid = $result['uid'];
            //创建redis连接
            $redis = $this->redisConnect();
            //存储token，键名：md5(uid),键值：uid，有效期：432000
            $redis->setex(md5($uid), 432000, $uid);
            $this->returnJson(1, '登陆成功', md5($uid));
        }
        $this->returnJson(0, '用户名或密码错误');
    }

    //退出登陆
    public function logout(){
        $token = $_SERVER['HTTP_TOKEN'];
        $redis = $this->redisConnect();
        $redis->delete($token);
        $uid = $redis->get($token);
        if(empty($uid)){
            $this->returnJson(1, '退出成功');
        }
        $this->returnJson(0, '退出失败');
    }

}