<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\facade\Session;

class Index extends Base{

    public function message(){

    }

    //佣金排行
    public function sequence(){
        $result = Model('user')->getSequence();
        $this->returnJson(1, '成功', $result);
    }

    //产品列表
    public function product(){
        //根据类别编号获取相应产品
        $cate_id = $_POST['cate_id'];
        $result = Model('product')->getProduct($cate_id);
        $this->returnJson(1, '成功', $result);
    }

    //获取产品详情
    public function productInfo(){
        //根据产品id获取产品信息
        $product_id = $_POST['product_id'];
        $result = Model('product')->getProductInfo($product_id);
        $this->returnJson(1, '成功', $result);
    }

}