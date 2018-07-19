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
        if(!empty($phone)){
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
                'level' => '一',
                'money' => 0,
                'create_time' => date('Y-m-d H:i:s'),
                'status' => 1
            ];
            $result = Model('user')->postUser($data);
            if($result){
                $filename = $result[0]['LAST_INSERT_ID()'];
                $this->createFile($filename);
                $this->success($result);
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

    //修改用户信息页面
    public function userEdit(Request $request){
        $uid = $_GET['uid'];
        $user_info = Model('user')->getAllUserInfo($uid);
        $this->assign('result', $user_info);
        return view();
    }

    //修改用户信息
    public function userEditInfo(Request $request){
        if($request->isAjax()){
            $uid = $_POST['uid'];
            $data = [
                'phone' => $_POST['phone'],
                'nickname' => $_POST['nickname'],
                'password' => md5($_POST['password'])
            ];
            $result = Model('user')->editUser($uid, $data);
            if($result){
                $this->success('修改成功');
            }
            $this->error('修改失败');
        }
    }

    //创建用户文件夹
    public function createFile($filename){
        $file_path = 'files/user/' . $filename;
        if(!is_dir($file_path)){
            mkdir($file_path, 0777, true);
        }
    }
}