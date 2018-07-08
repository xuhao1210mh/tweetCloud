<?php

namespace app\common\model;

use \think\Model;

class Admin extends Model{
    //对应表为admin表
    protected $table = 'admin';

    public function checkAdmin($data){

        $username = $data['username'];
        $password = $data['password'];

        $result = $this->where("username='$username' and password='$password'")->value('uid');
        if($result){
            return $result;
        }

        return false;
    }
    
}