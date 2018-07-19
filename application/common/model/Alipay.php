<?php

namespace app\common\model;

use \think\Model;

class Alipay extends Model{
    
    protected $table = 'alipay';

    public function getInfo($uid){
        $result = $this->where("uid='$uid'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

}