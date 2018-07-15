<?php

namespace app\common\model;

use \think\Model;

class Category extends Model{

    protected $table = 'category';

    //获取分类信息
    public function getCategory(){
        $result = $this->select();
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

}