<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Withdraw extends Model{

    protected $table = 'withdraw';

    //创建提现订单
    public function createWithdrawInfo($data){
        //return $data;exit;
        $result = $this->save($data);
        if($result){
            return 1;
        }
        return 0;
    }

    //获取提现记录
    public function getWithdraw($uid){
        // $result = $this->where("uid='$uid'")->select();
        $result = Db::table('withdraw')->field('sum,type,account,create_date,create_time')->where("uid='$uid'")->order('create_date desc')->order('create_time desc')->select();
        if($result){
            return $result;
        }
        return 0;
    }

    //获取当天提现次数
    public function getTimes($uid, $date){
        $result = Db::query("select count(*) from withdraw where uid='$uid' and create_date='$date'");
        return $result;
    }

    //获取所有提现申请单
    public function getAllWithdraw($id = ''){
        if(!empty($id)){
            $result = $this->where("status=1 and uid='$id'")->order('create_date desc')->order('create_time desc')->select();
            return $result;
        }
        $result = $this->where("status=1")->order('create_date desc')->order('create_time desc')->select();
        return $result;
    }

    //获取提现信息
    public function getInfoById($id){
        $result = $this->where("id='$id'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

    //改变提现单状态
    public function finishThisOrder($id){
        $result = $this->save([
            'status' => 2
        ], ['id' => $id]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function getAllFinishWithdraw($id = ''){
        if(!empty($id)){
            $result = $this->where("status=2 and uid='$id'")->order('create_date desc')->order('create_time desc')->select();
            return $result;
        }
        $result = $this->where("status=2")->order('create_date desc')->order('create_time desc')->select();
        return $result;
    }

    //改变提现单状态(删除)
    public function delThisOrder($id){
        $result = $this->save([
            'status' => 0
        ], ['id' => $id]);
        if($result){
            return 1;
        }
        return 0;
    }

}