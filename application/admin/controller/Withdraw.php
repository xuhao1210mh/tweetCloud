<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\Request;

class Withdraw extends Base{

    public function withdrawList(Request $request){
        //id为单号id
        $id = $_POST['id'];
        if(!empty($id)){
            $result = Model('withdraw')->getAllWithdraw($id);
            $this->assign('result', $result);
        }else{
            $result = Model('withdraw')->getAllWithdraw();
            $this->assign('result', $result);
        }
        return view();
    }

}