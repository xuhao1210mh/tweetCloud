<?php

namespace app\api\controller;

use \app\api\controller\Base;
use \think\Request;

class UploadImage extends Base{

    public function upload(Request $request){
        //print_r($_SERVER);
        // $token = $this->checkToken();
        // $redis = $this->redisConnect();
        // $uid = $redis->get($token);
        $file_path = '/files/user/head/';
        $file = $request->file();

        foreach($file as $v){
            $file_info = $v;
        }

        $image = \think\Image::open($file_info);
        $ext =  $image->type();
        $img_path = $file_path . time() . '.' .$ext;
        $info = $image->thumb(150, 150)->save('.' . $img_path);

        if($info){
            $img_path = 'http://' . $_SERVER['HTTP_HOST'] . $img_path;
            $this->returnJson(0, '上传成功', $img_path);
        }
        $this->returnJson(0, '上传失败');
    }

}