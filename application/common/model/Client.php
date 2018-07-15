<?php

namespace app\common\model;

use \think\Model;

class Client extends Model{

    protected $table = 'client';

    //$id为订单编号
    public function getClient($id){

    }

    public function postClient($data){
        $result = $this->save($data);
        if($result){
            return $data['client_id'];
        }
        return 0;
    }

}