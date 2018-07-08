<?php

namespace app\admin\controller;

use \think\Controller;
use \think\facade\Session;

class Base extends Controller{

    public function __construct(){
        $uid = Session::get('uid');
        if(!$uid){
            $this->error('请登陆', '/admin/entry/login');
        }
    }

}