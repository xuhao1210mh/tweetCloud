<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;
use \think\Request;

class Push extends Base{
    
    public function pushList(Request $request){
        $push_id = $_GET['push_id'];
        if($push_id == ''){
            $result = Model('push')->getAllPush();
            $this->assign('result', $result);
        }else{
            $result = Model('push')->getAllPush($push_id);
            $this->assign('result', $result);
        }
        return view();
    }

    public function pushCheck(){
        $push_id = $_GET['push_id'];
        $result = Model('push')->getAllPush($push_id);
        $this->assign('result', $result);

        $client_id = $result[0]['client_id'];
        $client = Model('client')->getClient($client_id);
        $this->assign('client', $client);
        return view();
    }

}