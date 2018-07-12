<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\Request;

class User extends Base{

    public function _initialize(){
        
    }

    public function userList(){
        $result = Model('user')->getUser();
        $this->assign('result', $result);
        return view();
    }

    public function userAdd(Request $request){
        if($request->isAjax()){
            $data = [
                'phone' => $_POST['phone'],
                'nickname' => $_POST['nickname'],
                'password' => $_POST['password'],
                'level' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'status' => 1
            ];
            $result = Model('user')->postUser($data);
            if($result == 1){
                $this->success('增加成功');
            }else{
                $this->error('增加失败');
            }
        }
        return view();
    }

    //用户删除
    public function userDel(){
        $uid = $_POST['uid'];
        $result = Model('user')->deleteUser($uid);
        if($result){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}