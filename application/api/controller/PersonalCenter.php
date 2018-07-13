<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;
use \think\facade\Session;

class PersonalCenter extends Base{

    public function userInfo(){
        $this->checkSession();
        $uid = Session::get('uid');
        $result = Model('user')->getUserInfo($uid);
        $this->returnJson(1, '成功', $result);
    }

}