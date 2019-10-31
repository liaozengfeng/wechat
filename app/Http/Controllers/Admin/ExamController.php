<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IntegralModel;
use Illuminate\Support\Facades\DB;
use App\Models\CourseModel;
class ExamController extends Controller
{
    public function login(Request $request){
        $url=urlencode(env('APP_URL')."/exam/userinfo");
        header("location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECHAT_APPID')."&redirect_uri=".$url."&response_type=code&scope=snsapi_base&state=#wechat_redirect");
    }
    public function userinfo(Request $request){
        $code=$request->input("code");
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET')."&code=".$code."&grant_type=authorization_code";
        $info=curl_get($url);
        $info=json_decode($info,1);
        $openid=$info['openid'];
        $url="https://api.weixin.qq.com/sns/userinfo?access_token=".$info['access_token']."&openid=".$openid."&lang=zh_CN";
        $re=curl_get($url);
        $res=json_decode($re,1);
        return view("admin.exam.list",['name'=>$res['nickname'],"url"=>$res['headimgurl'],"sex"=>$res["sex"]]);
    }


    static public function tqlist(){
        $url="http://api.k780.com/?app=weather.realtime&weaid=1&ag=today,futureDay,lifeIndex,futureHour&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";
        $res=curl_get($url);
        $res=json_decode($res,1);
        return $res;
    }
}