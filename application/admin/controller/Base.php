<?php

namespace app\admin\controller;

use \think\Controller;
use \think\facade\Session;

class Base extends Controller{

    public function _initialize(){
        $username = Session::get('username');
        if(empty($username)){
            $this->error('请登陆', '/admin/entry/login');
        }
    }

}