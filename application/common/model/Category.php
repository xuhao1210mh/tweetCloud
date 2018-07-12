<?php

namespace app\common\model;

use \think\Model;

class Category extends Model{

    protected $table = 'category';

    public function getCategory(){
        $result = $this->select();
        if($result){
            return $result;
        }else{
            return 0;
        }
    }

}