<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class Message extends Model{

    protected $table = 'message';

    //获取系统公告
    public function getMessage($date){
        $result = $this->order("create_time desc")->limit(5)->select();
        if($result){
            return $result;
        }
        return 0;
    }

    //增加系统公告
    public function setMessage(){
        
    }

    //删除系统公告
    public function deleteMessage(){
        
    }

}