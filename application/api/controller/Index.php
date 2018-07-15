<?php

namespace app\api\controller;

use \app\api\controller\Base;

class Index extends Base{

    //系统公告
    public function message(){
        $date = $_POST['date'];
        $result = Model('message')->getMessage($date);
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //佣金排行
    public function sequence(){
        $result = Model('user')->getSequence();
        if($result){
            $this->returnJson(1, '请求成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //产品列表
    public function product(){
        $cate_id = $_POST['cate_id'];
        $result = Model('product')->getProduct($cate_id);
        if($result){
            $this->returnJson(1, '成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //获取产品详情
    public function productInfo(){
        $token = $this->checkToken();
        $product_id = $_POST['product_id'];
        $result = Model('product')->getProductInfo($product_id);
        if($result){
            $this->returnJson(1, '成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

}