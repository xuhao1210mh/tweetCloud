<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\Request;

class Withdraw extends Base{

    public function withdrawList(Request $request){
        //id为单号id
        $id = $_GET['id'];
        if(!empty($id)){
            $result = Model('withdraw')->getAllWithdraw($id);
            $this->assign('result', $result);
        }else{
            $result = Model('withdraw')->getAllWithdraw();
            $this->assign('result', $result);
        }
        return view();
    }

    public function withdrawInfo(){
        $id = $_GET['id'];
        $uid = $_GET['uid'];
        $user_info = Model('user')->getUserInfo($uid);
        $this->assign('user_info', $user_info);

        $withdraw_info = Model('withdraw')->getInfoById($id);
        if($withdraw_info){
            if($withdraw_info['type'] == '支付宝'){
                $alipay_info = Model('alipay')->getInfo($uid);
                $this->assign('info', $alipay_info);
            }else if($withdraw_info['type'] == '微信'){
                $wechat_info = Model('wechat')->getInfo($uid);
                $this->assign('info', $wechat_info);
            }else{
                $cardpay_info = Model('cardpay')->getInfoByUid($uid);
                $this->assign('info', $cardpay_info);
            }
        }
        return view();
    }

    public function withdrawFinish(){
        $id = $_POST['id'];
        $result = Model('withdraw')->finishThisOrder($id);
        if($result){
            $this->success('已完成');
        }
        $this->error('未知错误');
    }

    public function withdrawFinishList(){
        //id为单号id
        $id = $_GET['id'];
        if(!empty($id)){
            $result = Model('withdraw')->getAllFinishWithdraw($id);
            $this->assign('result', $result);
        }else{
            $result = Model('withdraw')->getAllFinishWithdraw();
            $this->assign('result', $result);
        }
        return view();
    }

    //删除提现申请单
    public function withdrawDelete(){
        $id = $_POST['id'];
        $result = Model('withdraw')->delThisOrder($id);
        if($result){
            $this->success('删除成功');
        }
        $this->error('删除失败');
    }

}