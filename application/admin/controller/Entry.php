<?php

namespace app\admin\controller;

use \think\Controller;
use \think\Request;
use \think\facade\Session;

class Entry extends Controller{

    //登陆
    public function login(Request $request){
        if($request->isAjax()){

            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
            ];

            $result = Model('admin')->checkAdmin($data);
            if(!$result ){
                $this->error('登陆失败');
            }

            Session::set('uid', $result);
            $this->success('登陆成功', '/admin/main/index');
        }

        return view();
    }

}