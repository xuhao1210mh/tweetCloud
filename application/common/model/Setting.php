<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Setting extends Model{

    //获取客服微信号
    public function getWechat(){
        $result = $this->where("id=1")->value('wechat');
        if($result){
            return $result;
        }
        return 0;
    }

    //获取设置信息
    public function getSetting(){
        $result = $this->where("id=1")->find();
        if($result){
            return $result;
        }
        return 0;
    }

    //修改设置信息
    public function setSetting($data){
        $result = $this->save([
            'name'  => $data['name'],
            'wechat' => $data['wechat']
        ],['id' => 1]);
        if($result){
            return 1;
        }
        return 0;
    }

    public function getTimes(){
        $result = $this->where('id=1')->value('time');
        if($result){
            return $result;
        }
        return 0;
    }

}