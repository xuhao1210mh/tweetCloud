<?php

namespace app\common\model;

use \think\Model;

class Client extends Model{

    protected $table = 'client';

    //$id为订单编号
    public function getClient($client_id){
        $result = $this->where("client_id='$client_id'")->find();
        return $result;
    }

    public function postClient($data){
        $result = $this->save($data);
        $client['client_id'] = $data['client_id'];
        $client['name'] = $data['name'];
        if($result){
            return $client;
        }
        return 0;
    }

}