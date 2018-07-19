<?php

namespace app\common\model;

use \think\Model;

class Withdraw extends Model{

    protected $table = 'withdraw';

    public function createWithdrawInfo($data){
        $result = $this->save($data);
        if($result){
            return 1;
        }
        return 0;
    }

}