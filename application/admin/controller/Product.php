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

            $image = \think\Image::open($file_info);
            $ext =  $image->type();
            $img_path = $file_path . time() . '.' .$ext;
            $info = $image->thumb(400, 400)->save('.' . $img_path);

            $img_path = $_SERVER['HTTP_HOST'] . $img_path;

            if($info){
                $data = [
                    'pic' => $img_path,
                    'name' => $_POST['name'],
                    'cate_id' => $_POST['cate_id'],
                    'summary' => $_POST['summary'],
                    'method' => $_POST['method'],
                    'rate' => $_POST['rate'],
                    'payment_method' => $_POST['payment_method'],
                    'limit' => $_POST['limit'],
                    'deadline' => $_POST['deadline'],
                    'content' => $_POST['content'],
                    'condition' => $_POST['condition'],
                    'note' => $_POST['note'],
                    'url' => $_POST['url'],
                    'create_time' => date("Y-m-d H:i:s"),
                    'status' => 1,
                ];
                $result = Model('product')->createProduct($data);
                if($result){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($file->getError());
            }
        }
        return view();
    }

    //编辑产品信息页面
    public function productEdit(Request $request){
        $product_id = $_GET['product_id'];
        $result = Model('product')->getProductMoreInfo($product_id);
        if($result){
            $this->assign('result', $result);
        }
        return view();
    }

    //编辑产品信息
    public function productInfoEdit(Request $request){
        if($request->isAjax()){
            $product_id = $_POST['product_id'];
            $file_path = '/files/product/pic/';
            $file = $request->file();

            foreach($file as $v){
                $file_info = $v;
            }

            $image = \think\Image::open($file_info);
            $ext =  $image->type();
            $img_path = $file_path . time() . '.' .$ext;
            $info = $image->thumb(400, 400)->save('.' . $img_path);

            $img_path = $_SERVER['HTTP_HOST'] . $img_path;

            if($info){
                $data = [
                    'pic' => $img_path,
                    'name' => $_POST['name'],
                    'cate_id' => $_POST['cate_id'],
                    'summary' => $_POST['summary'],
                    'method' => $_POST['method'],
                    'rate' => $_POST['rate'],
                    'payment_method' => $_POST['payment_method'],
                    'limit' => $_POST['limit'],
                    'deadline' => $_POST['deadline'],
                    'content' => $_POST['content'],
                    'condition' => $_POST['condition'],
                    'note' => $_POST['note'],
                    'url' => $_POST['url'],
                    'create_time' => date("Y-m-d H:i:s"),
                    'status' => 1,
                ];
                $result = Model('product')->createProduct($product_id, $data);
                if($result){
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error($file->getError());
            }
        }
    }

}