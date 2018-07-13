<?php

namespace app\common\model;

use \think\Model;

class Product extends Model{

    //获取产品列表
    public function getProduct($cate_id){
        $result = $this->where("cate_id='$cate_id'")->order("create_time desc")->select();
        return $result;
    }

    //获取产品详情
    public function getProductInfo($product_id){
        $result = $this->where("product_id='$product_id'")->find();
        return $result;
    }

}