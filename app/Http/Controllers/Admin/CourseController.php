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
        header("location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECHAT_APPID')."&redirect_uri=".$url."&response_type=code&scope=snsapi_base&state=#wechat_redirect");
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
        if ($info['course_count']>3||date("Y-m-d",time())>"2019-10-24"){
            echo "无法修改";
        }else{
            $data['course_count']=$info['course_count']+1;
            $res=IntegralModel::where("openid",$data['openid'])->update($data);
            echo "修改成功";
        }
    }


    static public function info_list($openid){
        $info=IntegralModel::where("openid",$openid)->first()->toArray();
        if (!empty($info['one'])){
            $arr['name']=$info['name'];
            $data=CourseModel::get()->toArray();
            foreach($data as $k=>$v) {
                foreach ($info as $ke=>$va){
                    if($va==$v['id']){
                        $arr[$ke]=$v['name'];
                    }
                }
            }
        }else{
            $arr=[];
        }
        return $arr;
    }


    public function aaa(){
        $user_info=IntegralModel::get()->toArray();
        $data=CourseModel::get()->toArray();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".access_token();
        foreach ($user_info as $ke=>$va){
            if (!empty($va['one'])){
                $arr['name']=$va['name'];
                $arr['openid']=$va['openid'];
                foreach($data as $k=>$v) {
                    foreach ($va as $key=>$val){
                        if($val==$v['id']){
                            $arr[$key]=$v['name'];
                        }
                    }
                }
                $aaa=[
                    "touser"=>$arr['openid'],
                    "template_id"=>"eeVIhUFGCbe9w-tQ3r-W7w-dX9T5Qfjv2OXwr-WOjZk",
                    "data"=>[
                        "name"=>[
                            "value"=>$arr['name'],
                            "color"=>"red",
                        ],"one"=>[
                            "value"=>$arr['one'],
                            "color"=>"red",
                        ],"two"=>[
                            "value"=>$arr['two'],
                            "color"=>"red",
                        ],"three"=>[
                            "value"=>$arr['three'],
                            "color"=>"red",
                        ],"four"=>[
                            "value"=>$arr['four'],
                            "color"=>"red",
                        ],
                    ]
                ];
                $aaa=json_encode($aaa,JSON_UNESCAPED_UNICODE);
                $re=curl_post($url,$aaa);
                $re=json_decode($re,1);

                file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
                file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),$re,FILE_APPEND);
            }
        }
    }
}
