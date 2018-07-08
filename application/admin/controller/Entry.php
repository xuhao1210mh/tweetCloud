<?php

namespace app\admin\controller;

use \think\Controller;
use \think\Request;

class Entry extends Controller{
    public function login(Request $request){

        if($request->isAjax()){

        }

        return view();
    }
}