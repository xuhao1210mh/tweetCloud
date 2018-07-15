<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Qrcode extends Model{

    protected $table = 'qrcode';

    //获取客服信息
    public function getCustomerService(){
        $result = $this->where('id=1')->find();
        if($result){
            return $result;
        }
        return 0;
    }

}