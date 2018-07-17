<?php

namespace app\api\controller;

use \app\api\controller\Base;

class Index extends Base{

    //系统公告
    public function message(){
        //$info = Model('push')->getPushInfo();
        //$this->returnJson(1, '请求成功', $info);
        $result = Model('message')->getMessage();
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

    //各种类产品数量
    public function Quantity(){
        $data['card'] = Model('product')->getQuantity(1);
        $data['bond'] = Model('product')->getQuantity(2);
        $data['loan'] = Model('product')->getQuantity(3);
        $this->returnJson(1, '请求成功', $data);
    }

    //产品列表
    public function product(){
        //$cate_id = $_POST['cate_id'];
        $card = Model('product')->getProduct(1);
        $bond = Model('product')->getProduct(2);
        $loan = Model('product')->getProduct(3);
        $result = [
            'card' => $card,
            'bond' => $bond,
            'loan' => $loan
        ];
        if($result){
            $this->returnJson(1, '成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //获取产品详情
    public function productInfo(){
        //$token = $this->checkToken();
        $product_id = $_POST['product_id'];
        $result = Model('product')->getProductInfo($product_id);
        if($result){
            $this->returnJson(1, '成功', $result);
        }
        $this->returnJson(0, '请求失败');
    }

    //获取客服微信号
    public function wechat(){
        $wechat_number = Model('setting')->getWechat();
        if($wechat_number){
            $this->returnJson(1, '请求成功', $wechat_number);
        }
        $this->returnJson(0, '请求失败');
    }

}