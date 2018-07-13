<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;
use \think\facade\Session;

class CustomerCenter extends Base{

    public function pushList(){
        $this->checkSession();
        //$uid = Session::get('uid');
        //$date = $_POST['date'];
        $uid = 10024;
        $date = '2018-07';
        $result = Model('push')->getPush($uid, $date);
        $this->returnJson(1, '成功', $result);
    }

}