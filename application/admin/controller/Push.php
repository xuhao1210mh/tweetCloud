<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;
use \think\Request;

class Push extends Base{
    
    //申请单列表
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

    //审核通过申请单
    public function pushAccess(Request $request){
        $push_id = $_GET['push_id'];
        if($push_id == ''){
            $result = Model('push')->getAccessPush();
            $this->assign('result', $result);
        }else{
            $result = Model('push')->getAccessPush($push_id);
            $this->assign('result', $result);
        }
        return view();
    }

    //审核不通过
    public function delPush(Request $request){
        $push_id = $_POST['push_id'];
        $result = Model('push')->deletePush($push_id);
        if($result){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    //申请人信息
    public function pushCheck(){
        $push_id = $_GET['push_id'];
        $result = Model('push')->getAllPush($push_id);
        $this->assign('result', $result);

        $client_id = $result[0]['client_id'];
        $client = Model('client')->getClient($client_id);
        $this->assign('client', $client);
        return view();
    }

    //申请单审核页面
    public function pushYes(){
        $push_id = $_GET['push_id'];
        $this->assign('push_id', $push_id);
        $uid = Model('push')->getUid($push_id);
        $user_info = Model('user')->getUserInfo($uid);
        $this->assign('result', $user_info);
        return view();
    }

    //代理人所获佣金
    public function money(){
        $push_id = $_POST['push_id'];
        $uid = $_POST['uid'];
        $money = $_POST['money'];
        $result = Model('user')->setMoney($uid, $money);
        if($result){
            $result = Model('push')->setSuccess($push_id, $money);
            if($result){
                $this->success('审核通过');
            }else{
                $this->error('操作失败');
            }
        }else{
            $this->error('操作失败');
        }
    }

    //驳回原因页面
    public function pushNo(){
        $push_id = $_GET['push_id'];
        $this->assign('push_id', $push_id);
        $uid = Model('push')->getUid($push_id);
        $user_info = Model('user')->getUserInfo($uid);
        $this->assign('result', $user_info);
        return view();
    }

    //填写驳回原因
    public function reason(){
        $push_id = $_POST['push_id'];
        $uid = $_POST['uid'];
        $reason = $_POST['reason'];
        $result = Model('push')->setFail($push_id, $reason);
        if($result){
            if($result){
                $this->success('已驳回');
            }else{
                $this->error('操作失败');
            }
        }else{
            $this->error('操作失败');
        }
    }

}