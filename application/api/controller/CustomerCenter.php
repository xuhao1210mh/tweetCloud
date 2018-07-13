<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;
use \think\facade\Session;

class CustomerCenter extends Base{

    public function __construct(){
        
    }

    public function pushList(){
        $this->checkSession();
        $uid = Session::get('uid');
        $date = $_POST['date'];
        $date = '2018-07-11';
        $result = Model('push')->getPush($uid, $date);
        $this->returnJson(1, '成功', $result);
    }
}