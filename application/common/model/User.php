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

    //删除用户
    public function deleteUser($uid){
        $result = $this->where("uid=$uid")->delete();
        if($result){
            return 1;
        }else{
            return 0;
        }
    }

    //用户登陆时，进行检测
    public function checkUser($data){
        $phone = $data['username'];
        $password = $data['password'];
        $uid = $this->where("phone='$phone' and password='$password'")->value('uid');
        if($uid){
            return $uid;
        }else{
            return 0;
        }
    }

}