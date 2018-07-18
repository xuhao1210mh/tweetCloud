<?php

namespace app\common\model;

use \think\Model;

class Alipay extends Model{
    
    protected $table = 'wechat';

    public function getInfo($uid){
        $result = $this->where("uid='$uid'")->find();
        if($result){
            return 1;
        }
        return 0;
    }

}