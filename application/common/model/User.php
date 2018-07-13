<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class User extends Model{

    //对应user表
    protected $table = 'user';

    //获取用户
    public function getUser(){

        $result = $this->where("status=1")->select();
        return $result;

    }

    //添加用户
    public function postUser($data){
        $phone = $data['phone'];
        $result = $this->where("phone='$phone'")->find();
        if($result){
            return 0;
        }
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
        $phone = $data['phone'];
        $password = $data['password'];
        $result = $this->where("phone='$phone' and password='$password'")->find();
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    //按佣金进行排序
    public function getSequence(){
        $result = $this->order("money desc")->select();
        return $result;
    }

    //获取用户信息
    public function getUserInfo($uid){
        $result = Db::query("select uid,phone,nickname,money,level,head from user where uid='$uid'");
        return $result;
    }

}