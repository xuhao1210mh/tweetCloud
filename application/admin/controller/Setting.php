<?php

namespace app\admin\controller;

use \app\admin\controller\Base;
use \think\facade\Session;
use \think\Request;

class Setting extends Base{

    //设置列表
    public function setting(){
        $result = Model('setting')->getSetting();
        $qrcode = Model('qrcode')->getCustomerService();
        if($result){
            $this->assign('result', $result);
            $this->assign('qrcode', $qrcode);
        }
        return view();
    }

    //设置修改
    public function settingEdit(Request $request){
        $result = Model('setting')->getSetting();
        if($result){
            $this->assign('result', $result);
        }
        if($request->isAjax()){
            //上传并生成缩略图
            $file_path = 'files/setting/pic/';
            $file = $request->file();

            foreach($file as $v){
                $file_info = $v;
            }

            $image = \think\Image::open($file_info);
            $ext =  $image->type();
            $img_path = $file_path . time() . '.' .$ext;
            $info = $image->thumb(400, 400)->save($img_path);

            $img_path = 'http://' . $_SERVER['HTTP_HOST'] .'/'. $img_path;

            //$this->success($img_path);

            $setting = [
                'name' => $_POST['name'],
                'wechat' => $_POST['wechat']
            ];
            $qrcode = [
                'qrcode' => $img_path
            ];

            $setting = Model('setting')->setSetting($setting);
            $qrcode = Model('qrcode')->setQrcode($qrcode);
            if($setting && $qrcode){
                $this->success('修改成功');
            }
            $this->error('修改失败');
        }
        return view();
    }

    //支付宝/微信收款码
    public function paycode(){
        $result = Model('paycode')->getCode();
        $this->assign('paycode', $result);
        $times = Model('setting')->getTimes();
        $this->assign('times', $times);
        return view();
    }

    //修改支付宝/微信收款码页面
    public function paycodeEdit(Request $request){
        $result = Model('paycode')->getCode();
        $this->assign('paycode', $result);

        if($request->isAjax()){
            //上传并生成缩略图
            $file_path = 'files/setting/pic/';
            $file = $request->file();

            foreach($file as $v){
                $file_info = $v;

                $image = \think\Image::open($file_info);
                $ext =  $image->type();
                $img_path = $file_path . uniqid('paycode') . '.' .$ext;
                $info = $image->thumb(313, 313)->save($img_path);
    
                $img_paths[] = 'http://' . $_SERVER['HTTP_HOST'] .'/'. $img_path;
            }
            
            //print_r($img_paths);exit;
            $result = Model('paycode')->setCode($img_paths);
            if($result){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            };
        }
        return view();
    }

    //修改提现次数
    public function timesEdit(Request $request){
        $times = Model('setting')->getTimes();
        $this->assign('times', $times);
        if($request->isAjax()){
            $times = $_POST['times'];
            $result = Model('setting')->setTimes($times);
            if($result == 1){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }
        return view();
    }

    //上传头像
    public function uploadHeads(Request $request){
        $file_path = 'files/user/heads';

        if(!is_dir($file_path)){
            mkdir($file_path, 0777, true);
        }

        $file = $request->file();

        foreach($file as $v){
            $file_info = $v;
        }

        $image = \think\Image::open($file_info);
        $ext =  $image->type();
        $img_path = $file_path . '/' . uniqid('Usr') . '.' .$ext;
        $info = $image->thumb(200, 200)->save($img_path);

        if($info){
            $img_path = 'http://' . $_SERVER['HTTP_HOST'] .'/'. $img_path;
            $data['head'] = $img_path;
            $result = Model('heads')->setHeads($data);
            if($result){
                echo json_encode(['code' => 1, 'msg' => '上传成功', 'data' => $img_path]);
                exit;
            }
            echo json_encode(['code' => 1, 'msg' => '上传失败']);
            exit;
        }
        echo json_encode(['code' => 1, 'msg' => '上传失败']);
        exit;
    }

}