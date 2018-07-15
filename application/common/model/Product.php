<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Product extends Model{

    //获取产品列表
    public function getProduct($cate_id){
        $result = Db::query("select product_id,name from product where cate_id=3 order by create_time desc");
        if($result){
            return $result;
        }
        return 0;
    }

    //获取产品详情
    public function getProductInfo($product_id){
        $result = $this->where("product_id='$product_id'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

}