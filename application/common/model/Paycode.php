<?php

namespace app\common\model;

use \think\Model;

class Paycode extends Model{
    
    protected $table = 'paycode';

    public function getCode(){
        $result = $this->where("id=1")->find();
        if($result){
            return $result;
        }
        return 0;
    }

    public function setCode($img_paths){
        $result = $this->save([
            'alipaycode' => $img_paths[0],
            'wechatcode' => $img_paths[1]
        ], ['id' => 1]);
        if($result){
            return $result;
        }
        return 0;
    }

}