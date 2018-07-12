<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;

class Product extends Base{

    public function category(){
        $result = Model('category')->getCategory();
        if($result){
            $this->assign('result', $result);
        }
        return view();
    }

}