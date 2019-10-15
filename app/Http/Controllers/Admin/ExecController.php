<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ExecController extends Controller
{
    public function exec(Request $request){
        //接收微信发送的信息
        $info=file_get_contents("php://input");
        //写入log日志
        file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),$info,FILE_APPEND);
        //处理xml的加密
        $xml_obj = simplexml_load_string($info,'SimpleXMLElement',LIBXML_NOCDATA);
        $xml_arr = (array)$xml_obj;
        dd($xml_arr);

    }
}
