<?php

namespace App\Http\Controllers\Admin;
use App\models\IntegralModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UploadModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class UploadController extends Controller
{
    public function upload(Request $request){
        if ($request->isMethod("POST")){
            $title=$request->input("title");
            $title="标题";
            $content=$request->input("content");
            $content="内人";
            if (!$request->hasFile("upload_file")) {
                dd("没有文件被上传");
            }
            if ($request->input("type")=="video"){
                $data['description']=[
                    "title"=>$title,
                    "introduction"=>$content,
                ];
            }
            $type = $request->input("type");
            $file_obj = $request->file("upload_file");
            $file_ext = $file_obj->getClientOriginalExtension();
            $file_name = time() . rand(1000, 9999) . "." . $file_ext;
            $path = $request->file('upload_file')->storeAs('upload/' . $type . "/", $file_name);
            $data['media']=new \CURLFile(storage_path("app/public/upload/".$type."/".$file_name));
            if ($request->input("store")==1) {
                $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".access_token()."&type=" . $type;
                $re = curl_File($url,$data);
                $res = json_decode($re, 1);
                        return redirect("/admin/upload");
            }else{
                $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".access_token()."&type=".$type;
                if($type=="video") {
                    $data['description'] = json_encode($data['description'], JSON_UNESCAPED_UNICODE);
                }
//                dd($data);
                $re = curl_File($url,$data);
                $res = json_decode($re, 1);
                if (!isset($res['url'])) {
                    $path = "/storage/app/upload/" . $type . $file_name;
                }else{
                    $path=$res['url'];
                }
                $info=["medie_id"=>$res['media_id'],"type"=>$type,"path"=>$path,"addtime"=>time()];
                $ress=UploadModel::create($info);
                if ($ress){
                    return redirect("/admin/upload");
                }
            }
        }
        return view("admin.upload.save");
    }

    public function upload_list(Request $request){
        if (!empty($request->input("type"))){
            $type=$request->input('type');
            $data=Db::table('upload')->where("type",$type)->get()->toArray();
            return view("admin.upload.show",['info'=>$data]);
        }
        $info=UploadModel::all()->toArray();
        return view("admin.upload.upload_list",['info'=>$info]);
    }

    public function download(Request $request){
        $type=$request->input("type");
        $file_name = time() . rand(1000, 9999) ;
        $url="https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".access_token();
        $data=json_encode(['media_id'=>$request->input("media_id")]);
        $re=curl_post($url,$data);
        if ($type=="video"){
            $res=json_decode($re,1);
            $opts=[
                "http"=>[
                    "method"=>"GET",
                    "timeout"=>2
                ],
            ];
            $context=stream_context_create($opts);
            $re=file_get_contents($res['down_url'],false,$context);
            $file_name.=".mp4";
        }else if($type=="image"){
            $file_name.=".jpg";
        }else if($type=="voice"){
            $file_name.=".mp3";
        }
        $res=Storage::put("/upload/".$type."/".$file_name,$re);
        if ($res){
            return redirect("/admin/upload_list");
        }
    }

    public function qrcode_list(Request $request){
        $info=IntegralModel::get()->toArray();
        return view("admin.upload.fans_list",['data'=>$info]);
    }

    public function qrcode(Request $request){
        $openid=$request->input("openid");
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".access_token();
        $data=[
            "action_name"=>"QR_LIMIT_STR_SCENE",
            "action_info"=>[
                'scene'=>[
                    "scene_str"=>$openid
                ]
            ]
        ];
        $data=json_encode($data);
        $re=curl_post($url,$data);
        $re=json_decode($re,1);
        $get_curl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$re['ticket'];
        $res=curl_get($get_curl);
        $res=Storage::put("/upload/qrcode/".$openid.".jpg",$res);
        $info=['qrcode'=>"/storage/upload/qrcode/".$openid.".jpg"];
        $resl=IntegralModel::where("openid",$openid)->update($info);
        if ($resl){
            return redirect("/admin/qrcode_list");
        }
    }

}

