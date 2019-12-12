<?php

namespace App\Http\Controllers\Port;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PortController extends Controller
{
    public function index(Request $request){
        $info=$request->all();
        $redis = new \Redis();
        $redis->connect('127.0.0.1');
        if(empty($redis->get('shopinfo'))){
            $data[]=$info;
            $redis->set("shopinfo",json_encode($data,1),60*20);
        }else{
            $data=json_decode($redis->get('shopinfo'),1);
            $data[]=$info;
            $redis->set("shopinfo",json_encode($data,1),60*20);
        }
        return 1;
    }

    public function list(Request $request){
        $redis = new \Redis();
        echo 121;exit;
        $redis->connect('127.0.0.1');
        echo 232;exit;
        return $redis->get("shopinfo");
    }
}
