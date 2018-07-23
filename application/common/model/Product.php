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
        $result = Db::query("select product_id,name,pic,method from product where cate_id='$cate_id' and status=1 order by create_time desc");
        if($result){
            return $result;
        }
        return 0;
    }

    //获取产品详情
    public function getProductInfo($product_id){
        $result = Db::table('product')->field('product_id,name,pic,rate,payment_method,limit,deadline,condition,note,url')->find();
        if($result){
            return $result;
        }
        return 0;
    }

    //获取产品列表
    public function getProductList($name = ''){
        if($name){
            $result = $this->where("status=1 and name='$name'")->select();
            return $result;
        }
        $result = $this->where("status=1")->select();
        return $result;        
    }

    //创建新产品
    public function createProduct($product_id = '', $data){
        if(empty($product_id)){
            $result = $this->save($data);
            if($result){
                return 1;
            }
            return 0;
        }
        $result = $this->save([
            'pic' => $data['pic'],
            'name' => $data['name'],
            'cate_id' => $data['cate_id'],
            'summary' => $data['summary'],
            'method' => $data['method'],
            'rate' => $data['rate'],
            'payment_method' => $data['payment_method'],
            'limit' => $data['limit'],
            'deadline' => $data['deadline'],
            'content' => $data['content'],
            'condition' => $data['condition'],
            'note' => $data['note'],
            'url' => $data['url'],
            'create_time' => date("Y-m-d H:i:s"),
            'status' => 1,
        ], ['product_id' => $product_id]);
        if($result){
            return 1;
        }
        return 0;
    }

    //获取产品更为详尽的信息
    public function getProductMoreInfo($product_id){
        $result = $this->where("product_id='$product_id'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

    //删除产品
    public function delProduct($product_id){
        $result = $this->save([
            'status' => 0
        ], ['product_id' => $product_id]);
        if($result){
            return $result;
        }
        return 0;
    }

    //获取产品名
    public function getProductName($product_id){
        $result = $this->where("product_id='$product_id'")->value('name');
        if($result){
            return $result;
        }
        return 0;
    }

}