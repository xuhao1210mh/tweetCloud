<?php

namespace app\common\model;

use \think\Model;

class Admin extends Model{
    //对应表为admin表
    protected $table = 'admin';

    //验证管理员的登录信息
    public function checkAdmin($data){

        $username = $data['username'];
        $password = $data['password'];

        $result = $this->where("username='$username' and password='$password'")->value('username');
        if($result){
            return $result;
        }

        return false;
    }

    //创建管理员
    public function createAdmin($data){

    }

    //删除管理员
    public function deleteAdmin($uid){
        
    }

}