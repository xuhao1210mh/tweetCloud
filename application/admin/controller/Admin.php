<?php

namespace app\admin\controller;

use \think\Controller;
use \think\Request;
use \think\facade\Session;

class Admin extends Base{

    public function admin(){
        $result = Model('admin')->getAdminList();
        $this->assign('result', $result);
        return view();
    }

    public function adminEdit(Request $request){
        $data['uid'] = $_GET['uid'];
        $result = Model('admin')->getAdminInfo($data['uid']);
        $this->assign('result', $result);
        if($request->isAjax()){
            $data['uid'] = $_POST['uid'];
            $data['password'] = $_POST['password'];
            $result = Model('admin')->updateAdmin($data);
            if($result){
                $this->success('修改成功');
            }
            $this->error('修改失败');
        }
        return view();
    }

}