<?php

namespace app\api\controller;

use \app\api\controller\Base;

class UploadImage extends Base{

    //图片上传
    public function upload(){
        $file_path = '/files/user/head/';
        $file = $request->file();

        foreach($file as $v){
            $file_info = $v;
        }

        $image = \think\Image::open($file_info);
        $ext =  $image->type();
        $img_path = $file_path . time() . '.' .$ext;
        $info = $image->thumb(400, 400)->save('.' . $img_path);

        if($info){
            $img_path = $_SERVER['HTTP_ORIGIN'] . $img_path;
            $this->returnJson(1, '上传成功', $img_path);
        }
        $this->returnJson(0, '上传失败');
    }

}