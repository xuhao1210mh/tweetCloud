<?php

namespace app\api\controller;

use \app\api\controller\Base;

class Share extends Base{

    //分享页链接
    public function share(){
        $token = $this->checkToken();
        $redis = $this->redisConnect();
        $uid = $redis->get($token);
        $product_id = $_POST['product_id'];
        $url = "xinxirenzheng.html?uid=$uid&product_id=$product_id";
        $this->returnJson(1, '请求成功', $url);
    }

}