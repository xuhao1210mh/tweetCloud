<?php

namespace app\common\model;

use \think\Model;

class Alipay extends Model{
    
    protected $table = 'cardpay';

    //获取银行卡信息
    public function getInfo($uid){
        $result = $this->where("uid='$uid'")->find();
        if($result){
            return 1;
        }
        return 0;
    }

    public function setCardInfo($data){
        $uid = $data['uid'];
        $result = $this->where("uid='$uid'")->find();
        if($result){
            $result = $this->save([
                'name' => $data['name'],
                'card' => $data['card'],
                'type' => $data['type'],
                'phone' => $data['phone'],
                'create_time' => $data['create_time']
            ], ['uid' => $uid]);
            if($result){
                return 1;
            }
            return 0;
        }else{
            $result = $this->save($data);
            if($result){
                return 1;
            }
            return 0;
        }
        return 0;
    }

}