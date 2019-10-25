<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IntegralModel;
use Illuminate\Support\Facades\DB;
class OllController extends Controller
{
    static public function info($val){
        //清除redis
//        \Cache::forget('oll');
        if (\Cache::has('oll')){
            $oll=\Cache::get("oll");
        }else{
            $url="http://apis.juhe.cn/cnoil/oil_city?key=038f96a552851a4aa8e93945d71e57ff";
            $data=curl_get($url);
            $data=json_decode($data,true,JSON_UNESCAPED_UNICODE);
            \Cache::put("oll",$data['result']);
            $oll=$data['result'];
        }
        $value=md5($val);
        $count=md5($val)."count";
        $res=empty(\Cache::get($count))?0:\Cache::get($count);
        if ($res>=10){
//            dd($res);
            if (\Cache::has($value)){
                $arr=\Cache::get($value);
            }else{
                foreach ($oll as $k=>$v){
                    if(in_array($val,$v)){
                        $arr=$v;
                        \Cache::put($value,$arr);
                    }
                }
            }
        }else{
//            dd($res);
            foreach ($oll as $k=>$v){
                if(in_array($val,$v)){
                    $arr=$v;
                    \Cache::put($count,$res+1,3600);
                    \Cache::put($value,$arr,3600);
                }else{
                    $arr=[];
                }
            }
        }
        return $arr;
    }

    public function aaa(){
        $url="http://apis.juhe.cn/cnoil/oil_city?key=038f96a552851a4aa8e93945d71e57ff";
        $aaa=curl_get($url);
        $aaa=json_decode($aaa,true,JSON_UNESCAPED_UNICODE);
        $open=$oll=\Cache::get("oll");
        if ($aaa['result']==$open) {
            $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".access_token()."&next_openid=";
            $openid=curl_get($url);
            $openid=json_decode($openid,1);
            $openid=$openid['data']['openid'];
            $data = [
                "touser" => $openid,
                "msgtype" => "text",
                "text" => [
                    "content" => "油价变动通知",
                ]
            ];
            $url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".access_token();
            $data=json_encode($data,JSON_UNESCAPED_UNICODE);
            $res=curl_post($url,$data);
            $res=json_decode($res,1);
            dd($res);
        }
    }
}