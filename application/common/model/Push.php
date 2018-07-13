<?php

namespace app\common\model;

use \think\Model;

class Push extends Model{
    //对应表为push表
    protected $table = 'push';

    public function getPush($uid, $date){
        $result = $this->where("uid='$uid' and create_date='$date'")->select();
        return $result;
    }

}