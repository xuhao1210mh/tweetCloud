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
            //$file = $_FILES['file'];
            //print_r($_FILES);
            //exit;
            $file = $request->file('file');
            $info = $file->move($_SERVER['DOCUMENT_ROOT'] . '/files/product/pic');
            if($info){
                $this->success($info);
            }else{
                $this->error($file->getError());
            }

            // $filename = $_FILES['file1']['name'];
            // $tmpname = $_FILES['file1']['tmp_name'];

            // $dir_name = $_SERVER['DOCUMENT_ROOT'] . '/public/files/pic' . $filename;
            // if(!move_uploaded_file($tmpname, $dir_name)){
            //     $this->error('图片上传失败');
            // }
        }
        return view();
    }

}