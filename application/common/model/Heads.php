<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Heads extends Model{

    protected $table = 'heads';

    public function getHeads(){
        $result = Db::query("select head from heads");
        if($result){
            return $result;
        }
        return 0;
    }

    public function setHeads($data){
        $result = $this->save($data);
        if($result){
            return $result;
        }
        return 0;
    }

}