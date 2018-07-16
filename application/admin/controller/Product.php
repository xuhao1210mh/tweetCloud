<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;
use \think\Request;

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

    //产品列表
    public function product(){
        $name = $_GET['name'];
        if(empty($name)){
            $result = Model('product')->getProductList($name);
            $this->assign('result', $result);
        }else{
            $result = Model('product')->getProductList();
            $this->assign('result', $result);
        }
        return view();
    }

    //添加产品
    public function productAdd(Request $request){
        if($request->isAjax()){
            $file_path = '/files/product/pic/';
            $file = $request->file();
            foreach($file as $v){
                $file_info = $v;
            }
            $info = $file_info->move('./' . $file_path);
            if($info){
                $data['pic'] = $file_path . $info->getSaveName();
                $data['name'] = $_POST['name'];
                $data['cate_id'] = $_POST['cate_id'];
                $data['url'] = $_POST['url'];
                $data['create_time'] = date("Y:m:d H:i:s");
                $reult = Model('product')->createProduct($data);
            }else{
                $this->error($file->getError());
            }
        }
        return view();
    }

}