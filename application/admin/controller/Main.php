<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;
use \think\Db;

class Main extends Base{

    public function index(){
        $this->checkSession();
        return view();
    }

    public function welcome(){
        $this->checkSession();
        $username = Session::get('username');
        $this->assign('username', $username);

        $user = Db::query("select count(*) as sum from user where status=1");
        $this->assign('user_sum', $user[0]['sum']);

        $product = Db::query("select count(*) as sum from product where status=1");
        $this->assign('product_sum', $product[0]['sum']);

        $push = Db::query("select count(*) as sum from push");
        $this->assign('push_sum', $push[0]['sum']);

        $withdraw = Db::query("select count(*) as sum from withdraw");
        $this->assign('withdraw_sum', $withdraw[0]['sum']);

        $admin = Db::query("select count(*) as sum from admin where status=1");
        $this->assign('admin_sum', $admin[0]['sum']);

        return view();
    }

}