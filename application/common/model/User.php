<?php

namespace app\common\model;

use \think\Model;
use \think\Db;

class User extends Model{

    //对应user表
    protected $table = 'user';

    //获取用户
    public function getUser($phone = ''){
        if(!empty($phone)){
            $result = $this->where("status=1 and phone='$phone'")->select();
            return $result;
        }
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
            return Db::query("select LAST_INSERT_ID()");
        }
        return 0;
    }

    //修改用户信息
    public function editUser($uid, $data){
        $phone = $data['phone'];
        $old_phone = $this->where("uid='$uid'")->value('phone');
        if($phone != $old_phone){
            $result = $this->where("phone='$phone'")->find();
            if($result){
                return 0;
            }
        }
        $result = $this->save([
            'phone' => $data['phone'],
            'nickname' => $data['nickname'],
            'password' => $data['password']
        ], ['uid' => $uid]);
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
        // $result = $this->order("money desc")->select();
        $result = Db::table('user')->field('uid,head,nickname,money')->order('money desc')->limit(3)->select();
        if($result){
            return $result;
        }
        return 0;
    }

    //获取用户信息(个人中心)
    public function getUserInfo($uid){
        $result = Db::table('user')->field('uid,phone,nickname,level,head,money')->where("uid='$uid'")->find();
        //$result = Db::query("select uid,phone,nickname,money,level,head from user where uid='$uid'");
        if($result){
            return $result;
        }
        return 0;
    }

    //设置用户所获佣金
    public function setMoney($uid, $money){
        $result = Db::execute("update user set money=money+$money where uid=$uid");
        if($result){
            return 1;
        }
        return 0;
    }

    public function getAllUserInfo($uid){
        $result = $this->where("uid='$uid'")->find();
        if($result){
            return $result;
        }
        return 0;
    }

    //设置头像
    public function saveHead($uid, $img_path){
        $result = $this->save([
            'head' => $img_path,
        ], ['uid' => $uid]);
        if($result){
            return 1;
        }
        return 0;
    }

    //获取佣金金额
    public function getMoney($uid){
        $money = $this->where("uid='$uid'")->value('money');
        if($money){
            return $money;
        }
        return 0;
    }

    //申请提现时扣除余额
    public function deductMoney($uid, $money){
        $result = Db::execute("update user set money=money-'$money' where uid='$uid'");
        if($result){
            return 1;
        }
        return 0;
    }

    //设置用户头像
    public function setUserHeads($uid, $head){
        $result = $this->save([
            'head' => $head
        ], ['uid' => $uid]);
        if($result){
            return $result;
        }
        return 0;
    }

}