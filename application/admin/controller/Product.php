<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;

class Product extends Base{

    //分类列表
    public function category(){
        $result = Model('category')->getCategory();
        if($result){
            $this->assign('result', $result);
        }
        return view();
    }

    //增加分类
    public function categoryAdd(){
        
        return view();
    }

}