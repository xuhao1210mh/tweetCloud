<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;
use \think\facade\Session;

class CustomerCenter extends Base{

    public function pushList(){
        $this->checkToken();
        $uid = Session::get('uid');
        $date = $_POST['date'];
        $result = Model('push')->getPush($uid, $date);
        $this->returnJson(1, '成功', $result);
    }

}