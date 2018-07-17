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
            $this->assign('qrcode', $qrcode['code']);
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
            $file_path = '/files/setting/pic/';
            $file = $request->file();

            foreach($file as $v){
                $file_info = $v;
            }

            $image = \think\Image::open($file_info);
            $ext =  $image->type();
            $img_path = $file_path . time() . '.' .$ext;
            $info = $image->thumb(400, 400)->save('.' . $img_path);

            $img_path = $_SERVER['HTTP_ORIGIN'] . $img_path;

            //$this->success($img_path);

            $setting = [
                'name' => $_POST['name'],
                'wechat' => $_POST['wechat']
            ];
            $qrcode = [
                'qrcode' => $img_path
            ];

            Model('setting')->setSetting($setting);
            Model('qrcode')->setQrcode($qrcode);
        }
        return view();
    }

}