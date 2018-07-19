<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Withdraw extends Model{

    protected $table = 'withdraw';

    //创建提现订单
    public function createWithdrawInfo($data){
        $result = $this->save($data);
        if($result){
            return 1;
        }
        return 0;
    }

    //获取提现记录
    public function getWithdraw($uid){
        // $result = $this->where("uid='$uid'")->select();
        $result = Db::table('withdraw')->field('sum,type,account,create_date,create_time')->where("uid='$uid'")->select();
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

}