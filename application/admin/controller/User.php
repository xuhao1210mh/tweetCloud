<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\Request;

class User extends Base{

    public function _initialize(){
        
    }

    //展示用户列表
    public function userList(Request $request){
        $phone = $_GET['phone'];
        if(empty($phone)){
            $result = Model('user')->getUser($phone);
            $this->assign('result', $result);
        }else{
            $result = Model('user')->getUser();
            $this->assign('result', $result);
        }
        return view();
    }

    //添加用户
    public function userAdd(Request $request){
        if($request->isAjax()){
            $data = [
                'phone' => $_POST['phone'],
                'nickname' => $_POST['nickname'],
                'password' => md5($_POST['password']),
                'level' => 1,
                'money' => 0,
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

    //创建用户文件夹
    public function createFile($filename){
        $heads = 'files/' . $filename . '/heads';
        if(!is_dir($heads)){
            mkdir($heads, 0777, true);
        }
    }
}