<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;

class CustomerCenter extends Base{

    public function _initialize(){
        
    }

    public function pushList(){
        $uid = 10001;
        //$date = $_POST['date'];
        $date = '2018-07-11';
        $result = Model('push')->getPush($uid, $date);
        $this->returnJson(1, '成功', $result);
    }
}