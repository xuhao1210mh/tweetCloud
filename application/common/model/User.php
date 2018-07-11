<?php

namespace app\common\model;

use \think\Model;

class User extends Model{

    protected $table = 'user';

    //获取用户
    public function getUser(){

        $result = $this->where("status=1")->select();
        return $result;

    }

    //添加用户
    public function postUser($data){
        $result = $this->save($data);
        if($result){
            return 1;
        }
        return 0;
    }

    public function checkUser($data){
        $username = $data['username'];
        $password = $data['password'];
        $result = $this->where("phone='$username' and password='$password'")->value('uid, phone');
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

}