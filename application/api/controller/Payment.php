<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;

class Payment extends Base{

    //展示用户银行卡信息
    public function showCardinfo(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);

        $result = Model('cardpay')->getCardInfo($uid);
        if($result){
            //print_r($result);
            $this->returnJson(1, '请求成功', $result);
            exit;
        }
        $this->returnJson(0, '请求失败');
    }

    //输出持卡人信息
    public function getUserInfo(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);

        $result = Model('user')->getUserInfo($uid);
        if($result){
            $data = array_slice($result, 1, 2);
            $this->returnJson(1, '请求成功', $data);
        }
        $this->returnJson(0, '请求失败');
    }

    //验证银行卡信息
    public function checkCardInfo(){
        $card = $_POST['card'];
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, "http://v.juhe.cn/bankcardinfo/query?key=f0837601a9f4ba045ff6ebcbd14f0b39&bankcard=$card");
        //设置头文件的信息作为数据流输出
        //curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        echo $data;
    }

    //保存/添加银行卡信息
    public function saveCardInfo(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);

        $data = [
            'uid' => $uid,
            'name' => $_POST['name'],
            'account' => $_POST['account'],
            'type' => $_POST['type'] . $_POST['cardtype'],
            'phone' => $_POST['phone'],
            'create_time' => date('Y-m-d H:i:s')
        ];

        $result = Model('cardpay')->setCardInfo($data);
        if($result){
            $this->returnJson(1, '添加银行卡成功');
        }
        $this->returnJson(0, '添加银行卡失败');
    }

    //申请提现
    public function withdraw(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        //获取当前日期
        $date = $_POST['date'];

        $money = $_POST['money'];
        //选择支付/提现方式。1：支付宝；2：微信；3：银行卡。
        $type = $_POST['type'];

        //系统设定提现次数
        $time = Model('setting')->getTimes();
        //当日提现次数
        $withdraw_time = Model('withdraw')->getTimes($uid, $date);
        $withdraw_time = $withdraw_time[0]['count(*)'];
        // echo $time;
        // echo '<br>';
        // echo $withdraw_time;
        // exit;
        if($withdraw_time >= $time){
            $this->returnJson(0, '您今日的提现次数已超上限');
        }

        $user_money = Model('user')->getMoney($uid);
        if($money > $user_money){
            $this->returnJson(0, '余额不足');
        }

        //info表示提现账号信息
        if($type == 1){
            $info = Model('alipay')->getInfo($uid);
            if(!$info){
                $this->returnJson(0, '请完善提现账户信息');
            }
            $type = '支付宝';
        }
        if($type == 2){
            $info = Model('wechat')->getInfo($uid);
            if(!$info){
                $this->returnJson(0, '请完善提现账户信息');
            }
            $type = '微信';
        }
        if($type == 3){
            $id = $_POST['id'];
            $info = Model('cardpay')->getInfo($id, $uid);
            if(!$info){
                $this->returnJson(0, '请完善提现账户信息');
            }
            $type = '银行卡';
        }

        //echo json_encode($info);

        $data = [
            'id' => uniqid('w'),
            'uid' => $uid,
            'sum' => $money,
            'account' => $info['account'],
            'type' => $info['type'],
            'create_date' => $date,
            'create_time' => date('H:i:s'),
            'status' => 1
        ];
        $result = Model('withdraw')->createWithdrawInfo($data);
        if($result){
            //print_r($data);exit;
            $result = Model('user')->deductMoney($uid, $money);
            if($result){
                $this->returnJson(1, '申请提现成功');
            }
            $this->returnJson(0, '申请提现失败');
        }
        exit;
        $this->returnJson(0, '申请提现失败');
    }

}