<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginModel;
use App\Models\ShopModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class MenuController extends Controller
{
    public function menu(Request $request){
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".access_token();
        $info=[
            "button"=>[
     [
         "type"=>"click",
          "name"=>"积分查询",
          "key"=>"V1002_TODAY_MUSIC"
      ],
[
          "name"=>"菜单",
           "sub_button"=>[
           [
               "type"=>"view",
               "name"=>"搜索",
               "url"=>"http://www.baidu.com/"
            ],[
                "type"=>"view",
                "name"=>"网易云音乐",
                "url"=>"https://music.163.com/"
               ]
           ]
       ],
     [
         "type"=>"click",
          "name"=>"签到",
          "key"=>"V1001_TODAY_MUSIC"
      ],
            ]
 ];
        $info=json_encode($info,JSON_UNESCAPED_UNICODE);
        $re=curl_post($url,$info);
        $res=json_decode($re,1);
        dd($res);
    }
}
