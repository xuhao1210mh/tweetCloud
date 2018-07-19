<?php

namespace app\common\model;

use \think\Model;

class wechat extends Model{
    
    protected $table = 'wechat';

    public function getInfo($uid){
        $result = $this->where("uid='$uid'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

}