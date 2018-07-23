<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;

class PersonalCenter extends Base{

    //展示用户信息
    public function userInfo(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        $result = Model('user')->getUserInfo($uid);
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        return 0;
    }

    //收入记录
    public function revenue(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        $result = Model('push')->getPush($uid, '', 2);
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //提现记录
    public function withdrawList(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        $result = Model('withdraw')->getWithdraw($uid);
       foreach($result as $key => $v){
           if($result[$key]['type'] == '支付宝'){
               $result[$key]['account'] = '支付宝';
           }
           if($result[$key]['type'] == '微信'){
            $result[$key]['account'] = '微信'; 
           }
       }
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //专属客服
    public function customerService(){
        //$token = $this->checkToken();
        $result = Model('qrcode')->getCustomerService();
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //获取头像
    public function heads(){
        $result = Model('heads')->getHeads();
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //设置头像
    public function setHeads(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();

        $uid = $redis->get($token);
        $head = $_POST['head'];

        $result = Model('user')->setUserHeads($uid, $head);
        if($result){
            $this->returnJson(1, '头像修改成功', $result);
        }
        $this->returnJson(0, '头像修改失败');

    }

}