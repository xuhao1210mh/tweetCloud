<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;

class Main extends Base{

    public function index(){
        $this->checkSession();
        return view();
    }

    public function welcome(){
        $this->checkSession();
        $username = Session::get('username');
        $this->assign('username', $username);
        return view();
    }

}