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
            $result = Db::query("select push_id,product_name,money,put_time from push where uid='$uid' and status='$status' order by put_time desc");
            if($result){
                return $result;
            }
            return 0;
        }
        $result = Db::query("select push_id,product_id,product_name,name,number,create_time,status from push where uid='$uid' and create_date='$date' order by create_time desc");
        if($result){
            return $result;
        }
        return 0;
    }

    public function getAllPush($push_id = ''){
        if($push_id == ''){
            $result = $this->where("status=1")->order("create_time desc")->select();
            return $result;
        }
        $result = $this->where("status=1 and push_id='$push_id'")->order("create_time desc")->select();
        return $result;
    }

    public function getAccessPush($push_id=''){
        if($push_id == ''){
            $result = $this->where("status=2")->order("create_time desc")->select();
            return $result;
        }
        $result = $this->where("status=2 and push_id='$push_id'")->order("create_time desc")->select();
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

    //根据申请单号获取代理人id
    public function getUId($push_id){
        $result = $this->where("push_id='$push_id'")->value('uid');
        if($result){
            return $result;
        }
        return 0;
    }

    //设置申请单状态(success)，并设置佣金金额
    public function setSuccess($push_id, $money){
        $result = $this->save([
            'money' => $money,
            'status' => 2,
            'put_time' => date("Y:m:d H:i:s"),
        ], ['push_id' => $push_id]);
        if($result){
            return 1;
        }
        return 0;
    }

    //设置申请单状态(fail)
    public function setFail($push_id){
        $result = $this->save([
            'status' => 0,
            'put_time' => date("Y:m:d H:i:s"),
        ], ['push_id' => $push_id]);
        if($result){
            return 1;
        }
        return 0;
    }

    //删除/审核不通过
    public function deletePush($push_id){
        $result = $this->save([
            'status' => 0
        ], ['push_id' => $push_id]);
        if($result){
            return 1;
        }
        return 0;
    }

    //获取直推表，当前月份，前后月份
    public function getMonthPush($uid, $date, $small_date, $big_date){
        //当前月份
        $current_push = Db::query("select push_id,product_id,product_name,name,number,create_time,status from push where uid='$uid' and create_date='$date' order by create_time desc");
        if($current_push){
            //前一月份
            $former_push = Db::query("select push_id,product_id,product_name,name,number,create_time,status from push where uid='$uid' and create_date='$small_date' order by create_time desc");
            //后一月份
            $latter_push = Db::query("select push_id,product_id,product_name,name,number,create_time,status from push where uid='$uid' and create_date='$big_date' order by create_time desc");
            if($former_push && !$latter_push){
                //前一月份有记录，后一月份无记录
                $response = [
                    'code' => 90,
                    'data' => $current_push
                ];
                return $response;
            }
            if($former_push && $latter_push){
                //前一月份有记录，后一月份有记录
                $response = [
                    'code' => 100,
                    'data' => $current_push
                ];
                return $response;
            }
            if(!$former_push && $latter_push){
                //前一月份无记录，后一月份有记录
                $response = [
                    'code' => 110,
                    'data' => $current_push
                ];
                return $response;
            }
            if(!$former_push && !$latter_push){
                //前一月份无记录，后一月份有记录
                $response = [
                    'code' => 120,
                    'data' => $current_push
                ];
                return $response;
            }
        }else{
            return 0;
        }
    }

}