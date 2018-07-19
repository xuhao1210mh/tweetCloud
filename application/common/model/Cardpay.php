<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Cardpay extends Model{
    
    protected $table = 'cardpay';

    //获取银行卡信息
    public function getCardInfo($uid){
        //$result = $this->where("uid='$uid'")->select();
        $result = Db::query("select id,RIGHT(account, 4) as account, type from cardpay where uid='$uid'");
        if($result){
            return $result;
        }
        return 0;
    }

    //增添银行卡信息
    public function setCardInfo($data){
        $uid = $data['uid'];
        // $result = $this->where("uid='$uid'")->find();
        // if($result){
        //     $result = $this->save([
        //         'name' => $data['name'],
        //         'card' => $data['card'],
        //         'type' => $data['type'],
        //         'phone' => $data['phone'],
        //         'create_time' => $data['create_time']
        //     ], ['uid' => $uid]);
        //     if($result){
        //         return 1;
        //     }
        //     return 0;
        // }else{
        $result = $this->save($data);
        if($result){
            return 1;
        }
        return 0;
        //}
        //return 0;
    }

    public function getInfo($id, $uid){
        $result = $this->where("id=$id and uid='$uid'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

}