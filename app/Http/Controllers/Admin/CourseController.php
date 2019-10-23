<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseModel;
use App\Models\IntegralModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function list(Request $request){
        $url=urlencode(env('APP_URL')."/course/list_do");
        header("location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECHAT_APPID')."&redirect_uri=".$url."&response_type=code&scope=snsapi_userinfo&state=#wechat_redirect");
    }

    public function list_do(Request $request){
        $code=$request->input("code");
        if (\Cache::has('user_openid')){
            $openid = \Cache::get('user_openid');
        }else{
            $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET')."&code=".$code."&grant_type=authorization_code";
            $info=curl_get($url);
            $info=json_decode($info,1);
            \Cache::put('user_openid',$info['openid'], $info['expires_in']);
            $openid=$info['openid'];
        }
        $data=IntegralModel::where("openid",$openid)->first()->toArray();
        $infos=CourseModel::get()->toArray();
        return view("admin.course.list",['info'=>$infos,"openid"=>$openid,"data"=>$data]);
    }
    public function list_add(Request $request){
        $data=$request->input();
        unset($data['_token']);
        $info=IntegralModel::where("openid",$data['openid'])->first()->toArray();
        if ($info['course_count']>3||date("Y-m-d",time())>2019-10-24){
            echo "无法修改";
        }else{
            $res=IntegralModel::where("openid",$data['openid'])->update($data);
            echo "修改成功";
        }
    }


    static public function info_list($openid){
        $info=IntegralModel::where("openid",$openid)->first()->toArray();
        if (!empty($info['one'])){
            $data=CourseModel::get()->toArray();
            $arr['name']=$info['name'];
            foreach($data as $k=>$v){
                if ($info['one']==$v['id']){
                    $arr['one']=$v['name'];
                }else if($info['two']==$v['id']){
                    $arr['two']=$v['name'];
                }else if($info['three']==$v['id']){
                    $arr['three']=$v['name'];
                }else if($info['four']==$v['id']){
                    $arr['four']=$v['name'];
                }
            }
        }else{
            $arr=[];
        }
        return $arr;
    }

}
