<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ExecController extends Controller
{
    public function exec(Request $request){
        $info=file_get_contents("php://input");
        dd($info);
        file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),$info,FILE_APPEND);
        $xml_obj = simplexml_load_string($info,'SimpleXMLElement',LIBXML_NOCDATA);
        $xml_arr = (array)$xml_obj;
        dd($xml_arr);

    }
}
