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

    //获取管理员列表
    public function getAdminList(){
        $result = Model('admin')->where("status=1")->select();
        if($result){
            return $result;
        }
        return 0;
    }

    //修改管理员信息
    public function updateAdmin($data){
        $result = $this->save([
            'password' => $data['password'],
        ], ['uid' => $data['uid']]);
        if($result){
            return 1;
        }
        return 0;
    }

    //获取管理员信息
    public function getAdminInfo($uid){
        $result = $this->where("uid='$uid'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

    //添加管理员
    public function postAdmin($data){
        $result = $this->save($data);
        if($result){
            return 1;
        }
        return 0;
    }

    //删除管理员
    public function deleteAdmin($uid){
        $result = $this->save([
            'status' => 0
        ], ['uid' => $uid]);
        if($result){
            return 1;
        }
        return 0;
    }

}