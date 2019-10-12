<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\LoginSuccess;
use App\Models\LoginModel;
use App\Models\AdminModel;
use App\Models\ShopModel;
use App\Models\LableModel;
class LableController extends Controller
{

    //添加标签
    public function save(Request $request){
        if ($request->isMethod("POST")) {
            $data = $request->input();
            $url="https://api.weixin.qq.com/cgi-bin/tags/create?access_token=".access_token();
            $data=json_encode(["tag"=>['name'=>$data['l_name']]],JSON_UNESCAPED_UNICODE);
            $res=curl_post($url,$data);
            $res=json_decode($res,true,JSON_UNESCAPED_UNICODE);
            $res=LableModel::create(["l_id"=>$res['tag']['id'],"l_name"=>$res['tag']['name']]);
            if ($res){
                return redirect("/lable/index");
            }
        }else{
            return view("admin.lable.save");
        }

    }

    //标签展示
    public function index(Request $request){
        $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".access_token();
        $data=curl_get($url);
        $data=json_decode($data,true,JSON_UNESCAPED_UNICODE);
        return view("admin.lable.index",['data'=>$data]);
    }

    public function fans(Request $request){
        $id=$request->input("l_id");
        $token=access_token();
        $user_Info=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token&next_openid=");
        $user_Info=json_decode($user_Info,1);
        $user_info=[];
        foreach ($user_Info['data']['openid'] as $k=>$v){
            $arr=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$v&lang=zh_CN");
            $user_info[]=json_decode($arr,1);
        }
        $user_info=LableController::info($user_info);
        return view("admin.lable.fans",['info'=>$user_info,"id"=>$id]);
    }
    public function fans_save(Request $request){
        $openid=$request->input("openid");
        $openid=explode(",",$openid);
        $id=$request->input("id");
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=".access_token();
        $data=json_encode(['openid_list'=>$openid,"tagid"=>$id]);
        $res=curl_post($url,$data);
        $res=json_decode($res);
        if ($res->errmsg=="ok"){
            return redirect("/lable/index");
        }
    }

    public function fans_list(Request $request){
        $id=$request->input("l_id");
        $url="https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=".access_token();
        $data=json_encode(["tagid"=>$id,"next_openid"=>""]);
        $res=curl_post($url,$data);
        $res=json_decode($res);
        if (!empty($res->data)){
            $fans_info=[];
            foreach ($res->data->openid as $k=>$v){
                $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".access_token()."&openid=".$v."&lang=zh_CN";
                $datas=curl_get($url);
                $fans_info[]=json_decode($datas,1);
            }
        }
        $fans_info=self::info($fans_info);
        return view("admin.lable.fans",['info'=>$fans_info]);
    }

    public function delete(Request $request){
        $l_id=$request->input("l_id");
        $url="https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=".access_token();
        $data=json_encode(["tag"=>['id'=>$l_id]]);
        $res=curl_post($url,$data);
        $res=json_decode($res);
        if ($res->errmsg=="ok"){
            return redirect("/lable/index");
        }
    }

    public function fans_del(Request $request){
        $openid=$request->input("openid");
        $id=$request->input("id");
        $openid=explode(",",$openid);
        $data=json_encode(["openid_list"=>$openid,"tagid"=>$id]);
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=".access_token();
        $res=curl_post($url,$data);
        $res=json_decode($res);
        dd($res);
    }


    public function info($data){
        $url_get_lable_all="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".access_token();
        $url_get_lable_all=curl_get($url_get_lable_all);
        $url_get_lable_all=json_decode($url_get_lable_all,1);
        foreach ($data as $k=>$v){
            $url_info="https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=".access_token();
            $openid=json_encode(["openid"=>$v['openid']]);
            $res=curl_post($url_info,$openid);
            $res=json_decode($res,1);
            foreach ($res['tagid_list'] as $ks=>$vs){
                if (!empty($url_get_lable_all['tags'])) {
                    foreach ($url_get_lable_all['tags'] as $key => $val) {
                        if ($val['id'] == $vs) {
                            $data[$k]['tagname'][] = $val['name'];
                        }
                    }
                }
            }
        }
        return $data;
    }
}
