<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MenuModel;


class MenuController extends Controller
{
    public function menu(Request $request){
//        $info=self::menu_list();
//        dd($info);
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
               ],[
                   "type"=>"view",
                   "name"=>"课程管理",
                   "url"=>"http://47.93.25.230/course/list",
               ],[
                   "type"=>"click",
                   "name"=>"查看课程",
                   "key"=>"See_the_course"
               ],
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

    public function menu_save(Request $request){
        if ($request->isMethod("POST")){
            if ($request->input("next")==1){
                $info=["first_name"=>$request->input("first_name"),"type"=>1];
            }else{
                $info=["first_name"=>$request->input("first_name"),"type"=>1,"event"=>$request->input("event"),"event_key"=>$request->input("event_key"),"type"=>2];
            }
            $res=MenuModel::create($info);
            if ($res){
                return redirect("/admin/menu_next");
            }
        }
        return view("admin.menu.save");
    }

    public function menu_next(Request $request){
        if($request->isMethod("POST")){
            MenuModel::where("id",$request->input("parent_id"))->update(['event'=>"","event_key"=>""]);
            if (MenuModel::where("parent_id",$request->input("parent_id"))->count()<5){
                $data=MenuModel::where("event_key",$request->input("event_key"))->first();
                if (empty($data)) {
                    $info=$request->all();
                    $info['type']=2;
                    $res = MenuModel::create($info);
                }
            }else{
                echo "超过数量限制";exit;
            }
        }
        $data=MenuModel::where("type",1)->get()->toArray();
        return view("admin.menu.menu_save",['data'=>$data]);
    }

    public function menu_list(){
       $data=MenuModel::where("parent_id",0)->get()->toArray();
       foreach($data as $k=>$v){
           $data[$k]['next']=MenuModel::where("parent_id",$v['id'])->get()->toArray();
       }
       $info['button']=[];
       foreach($data as $k=>$v){
           if($v['type']==1) {
               $arr['name'] = $v["first_name"];
               $arr['sub_button'] = [];
               foreach ($v['next'] as $ke => $va) {
                   if ($v['id']==$va['parent_id']) {
                       if ($va['event'] == "click") {
                           $arr["sub_button"][] = [
                               "type" => $va['event'],
                               "name" => $va['first_name'],
                               "key" => $va['event_key']
                           ];
                       } else {
                           $arr["sub_button"][] = [
                               "type" => $va['event'],
                               "name" => $va['first_name'],
                               "url" => $va['event_key']
                           ];
                       }
                   }
               }
           }else if($v['type']==3){
               if($v['event']=="click"){
               $arr=[
                    "type"=>"click",
                    "name"=>$v['first_name'],
                    "key"=>$v['event_key']
               ];
               }else{
                   $arr=[
                       "type"=>"view",
                       "name"=>$v['first_name'],
                       "url"=>"https://baidu/"
                   ];
               }
           }
            $info['button'][]=$arr;
        }
        return $info;
    }
}
