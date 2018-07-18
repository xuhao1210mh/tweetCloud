<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;

class Payment extends Base{

    //验证银行卡信息
    public function checkCardInfo(){
        $card = $_POST['card'];
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, "http://v.juhe.cn/bankcardinfo/query?key=f0837601a9f4ba045ff6ebcbd14f0b39&bankcard=$card");
        //设置头文件的信息作为数据流输出
        //curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        echo $data;
    }

}