<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Product extends Model{

    //获取各种类产品数量
    public function getQuantity($cate_id){
        if($cate_id == 1){
            $result = $this->where("cate_id='$cate_id'")->select();
            return count($result);
        }
        if($cate_id == 2){
            $result = $this->where("cate_id='$cate_id'")->select();
            return count($result);
        }
        if($cate_id == 3){
            $result = $this->where("cate_id='$cate_id'")->select();
            return count($result);
        }
    }

    //根据分类id获取产品列表
    public function getProduct($cate_id){
        $result = Db::query("select product_id,name,pic,method from product where cate_id='$cate_id' order by create_time desc");
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

    //获取产品列表
    public function getProductList($name = ''){
        if($name){
            $reuslt = $this->where("name='$name'")->select();
            return $result;
        }
        $result = $this->where("status=1")->select();
        return $result;        
    }

}