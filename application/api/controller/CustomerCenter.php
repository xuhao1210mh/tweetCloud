<?php

namespace app\api\controller;

use \app\api\controller\Base;

class CustomerCenter extends Base{

    //直推列表
    public function pushList(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);

        $year = $_POST['year'];

        $month = $_POST['month'];
        $small_month = $month - 1;
        $big_month = $month + 1;

        $date = $year . '-' . $month;
        $small_date = $year . '-0' . $small_month;
        $big_date = $year . '-0' . $big_month;

        $result = Model('push')->getMonthPush($uid, $date, $small_date, $big_date);
        if($result['code'] == 90){
            $this->returnJson(90, '前一月份有记录，后一月份无记录', $result['data']);
        }
        if($result['code'] == 100){
            $this->returnJson(100, '前一月份有记录，后一月份有记录', $result['data']);
        }
        if($result['code'] == 110){
            $this->returnJson(110, '前一月份无记录，后一月份有记录', $result['data']);   
        }
        if($result['code'] == 120){
            $this->returnJson(120, '前一月份无记录，后一月份无记录', $result['data']);   
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
        //检测该手机用户是否申请过此产品
        $count = Model('push')->checkPhone($product_id, $data['phone']);
        if($count){
            $this->returnJson(0, '您已申请过此产品');
        }
        //创建客户信息，并获取客户id
        $client = self::addClient($data);
        if($client){
            $result = self::addPush($product_id, $uid, $data['client_id'], $data['name'], $data['phone']);
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
    private function addPush($product_id, $uid, $client_id, $client_name, $client_phone){
        $product_info = Model('product')->getProductInfo($product_id);
        $data = [
            'push_id' => uniqid('o'),
            'product_id' => $product_id,
            'uid' => $uid,
            'product_name' => $product_info['name'],
            'name' => $client_name,
            'number' => $client_phone,
            'client_id' => $client_id,
            'create_date' => date('Y-m'),
            'create_time' => date('Y-m-d H:i:s'),
            'status' => 1  //待审核状态
        ];
        $result = Model('push')->setPush($data);
        if($result){
            $this->returnJson(1, '请求成功', $product_info['url']);
        }
        $this->returnJson(0, '请求失败');
    }

    public function dateTest(){
        $year = $_POST['year'];
        $month = $_POST['month'];
        $small_month = $month - 1;
        $big_month = $month + 1;
        $date = $year . '-' . $month;
        $small_date = $year . '-0' . $small_month;
        $big_date = $year . '-0' . $big_month;
        echo $date . '<br>';
        echo $small_date . '<br>';
        echo $big_date . '<br>';
        exit;
    }

}