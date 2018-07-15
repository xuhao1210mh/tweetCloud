<?php

namespace app\api\controller;

use \app\api\controller\Base;

class Share extends Base{

    //分享页信息
    public function share(){
        $data['product_id'] = $_GET['product_id'];
        $data['uid'] = $_GET['uid'];
        $this->returnJson(1, '请求成功', $data);
    }

}