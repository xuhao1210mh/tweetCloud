<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;

class Main extends Base{

    public function _initialize(){
        
    }

    public function index(){
        return view();
    }

    public function welcome(){
        $username = Session::get('username');
        $this->assign('username', $username);
        return view();
    }

}