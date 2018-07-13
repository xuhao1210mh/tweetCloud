<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Push extends Model{
    //对应表为push表
    protected $table = 'push';

    public function getPush($uid, $date){
        //$result = $this->where("uid='$uid' and create_date='$date'")->select();
        $result = Db::query("select id,product_name,name,number,create_date,status from push where uid='$uid' and create_date='$date'");
        return $result;
    }

}