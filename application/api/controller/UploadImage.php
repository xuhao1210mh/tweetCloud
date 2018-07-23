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
        $file_path = 'files/user/heads';// . $uid;

        if(!is_dir($file_path)){
            mkdir($file_path, 0777, true);
        }

        $file = $request->file();

        if(empty($file)){
            $this->returnJson(2, '未接收到图片');
            exit;
        }

        foreach($file as $v){
            $file_info = $v;
        }

        $image = \think\Image::open($file_info);

        $ext =  $image->type();
        $img_path = $file_path . '/' . uniqid('Usr') . '.' .$ext;
        $info = $image->thumb(200, 200)->save($img_path);

        if($info){
            $img_path = 'http://' . $_SERVER['HTTP_HOST'] .'/'. $img_path;
            $this->returnJson(1, '上传成功', $img_path);
        }
        $this->returnJson(0, '上传失败');
    }

    public function returnData($status=0, $info="", $src=""){
        echo '{"status":"'.$status.'","info":"'.$info.'","src":"'.$src.'"}';exit;
    }

}