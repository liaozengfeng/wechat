<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IntegralModel;
use Illuminate\Support\Facades\DB;
class IntegralController extends Controller
{
    //用户添加
    static public function user_save($openid){
        $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".access_token()."&openid=".$openid."&lang=zh_CN";
        $data=curl_get($url);
        $data=json_decode($data,1);
        $info=['openid'=>$data['openid'],"name"=>$data['nickname'],"add_time"=>time(),"up_time"=>0];
        $res=IntegralModel::create($info);
        return $res;
    }

    static public function integral_save($openid){
        $data=IntegralModel::where("openid",$openid)->first();
        if (time() - $data->up_time > 24*60*60 && time() - $data->up_time < 24*60*60*2){
            dd($data->count);
            $count=$data->count+1;
            $integral=$count*5;
            $info=["count"=>$count,"up_time"=>time(),"integral"=>$integral];
            $res=Db::table("wechat_integral")->where("openid",$openid)->update($info);
        }else if (time() - $data->up_time > 24*60*60*2 || $data->count > 5){
            $integral=$data->integral+5;
            $info=["count"=>1,"up_time"=>time(),"integral"=>$integral];
            $res=Db::table("wechat_integral")->where("openid",$openid)->update($info);
        }else{
            $res=false;
        }
        return ["res"=>$res];
    }

    static public function integral_select($openid){
        $data=IntegralModel::where("openid",$openid)->first()->toArray();
        return $data['integral'];
    }

    static public function user_del($openid){
        $res=IntegralModel::where("openid",$openid)->delete();
        return $res;
    }
}
