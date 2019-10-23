<?php

namespace App\Http\Controllers\Admin;
use GuzzleHttp\Psr7\Request;
use Illuminate\Routing\Controller;
class JssdkController extends Controller
{

    public function jssdk(){
        $ticket=jssdk_ticket();
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $rand_str=rand(10000,99999)."jssdk".time();
        $time=time();
        $sign_str = 'jsapi_ticket='.$ticket.'&noncestr='.$rand_str.'&timestamp='.$time.'&url='.$url;
        $signature = sha1($sign_str);
        return view("admin.jssdk.list",['rand_str'=>$rand_str,'time'=>$time,"signature"=>$signature]);
    }

//    public function jssdk()
//    {
//        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//        $_now_ = time();
//        $rand_str = rand(1000,9999).'jssdk'.time();
//        $jsapi_ticket = jssdk_ticket();
//        $sign_str = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$rand_str.'&timestamp='.$_now_.'&url='.$url;
//        $signature = sha1($sign_str);
//        return view('admin.jssdk.list',['signature'=>$signature,'time'=>$_now_,'rand_str'=>$rand_str]);
//    }
}
