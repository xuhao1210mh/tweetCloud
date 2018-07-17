<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Push extends Model{
    //对应表为push表
    protected $table = 'push';

    //
    public function getPush($uid, $date = '', $status = ''){
        //$result = $this->where("uid='$uid' and create_date='$date'")->select();
        if($status == 2){
            $result = Db::query("select push_id,product_name,money,put_time from push where uid='$uid' and status='$status' order by put_time");
            if($result){
                return $result;
            }
            return 0;
        }
        $result = Db::query("select push_id,product_id,product_name,name,number,create_date,status from push where uid='$uid' and create_date='$date' order by create_time desc");
        if($result){
            return $result;
        }
        return 0;
    }

    public function getAllPush($push_id = ''){
        if($push_id == ''){
            $result = $this->where("status=1")->select();
            return $result;
        }
        $result = $this->where("status=1 and push_id='$push_id'")->select();
        return $result;
    }

    //创建直推表信息
    public function setPush($data){
        $result = $this->save($data);
        if($result){
            return $result;
        }
        return 0;
    }

    //检测客户是否申请过此产品
    public function checkPhone($product_id, $client_phone){
        $result = $this->where("product_id='$product_id' and number='$client_phone'")->find();
        if($result){
            return 1;
        }
        return 0;
    }

}