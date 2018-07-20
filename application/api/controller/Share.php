<?php

namespace app\api\controller;

use \app\api\controller\Base;

class Share extends Base{

    //分享产品信息
    public function productName(){
        $product_id = $_POST['product_id'];
        $name = Model('product')->getProductName($product_id);
        if($product_name){
            $this->returnJson(1, '请求成功', $product_name);
        }
        $this->returnJson(0, '请求失败');
    }

    //分享页链接
    public function share(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        $product_id = $_POST['product_id'];

        $data['product_name'] = Model('product')->getProductName($product_id);
        $data['url'] = "fxdjsxq.html?uid=$uid&product_id=$product_id";

        $this->returnJson(1, '请求成功', $data);
    }

}