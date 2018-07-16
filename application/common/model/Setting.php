<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Setting extends Model{

    public function getWechat(){
        $result = $this->where("id=1")->find();
        if($result){
            return $result;
        }
        return 0;
    }

}