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
        return 0;
    }

    //提现记录
    public function withdrawList(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        $result = Model('witdraw')->getWithdraw($uid);
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

    //申请提现
    public function withdraw(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);

        $money = $_POST['money'];
        //选择支付/提现方式。1：支付宝；2：微信；3：银行卡。
        $type = $_POST['type'];

        $user_money = Model('user')->getMoney($uid);
        if($money > $user_money){
            $this->returnJson(0, '余额不足');
        }

        if($type == 1){
            $info = Model('alipay')->getInfo($uid);
        }
        if($type == 2){
            $info = Model('wechat')->getInfo($uid);
        }
        if($type == 3){
            $info = Model('card')->getInfo($uid);
        }

        $result = Model('withdraw')->createWithdrawInfo($uid, $money, $info);
        if($result){
            $this->returnJson(1, '请求成功');
        }
        $this->returnJson(0, '请求失败');
    }

    //添加银行卡信息
    public function addCardInfo(){
        
    }

}