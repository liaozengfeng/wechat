<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IntegralModel;
use Illuminate\Support\Facades\DB;
use App\Models\CourseModel;
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
//        dd($data);
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

        }

}