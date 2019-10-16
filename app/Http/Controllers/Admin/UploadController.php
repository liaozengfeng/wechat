<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UploadModel;
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
            if ($request->input("video")){
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
                if (!isset($res['errcode'])){
                    $info=["medie_id"=>$res['media_id'],"type"=>$type,"path"=>"/storage/app/upload/".$type.$file_name,"addtime"=>time()];
                    $ress=UploadModel::create($info);
                    if ($ress){
                        $request->session()->put("media_id", $res['media_id']);
                        dd(session("media_id"));
                        return redirect("/admin/upload");
                    }
                }
            }else{
                $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".access_token()."&type=".$type;
                $re = curl_File($url,$data);
                $res = json_decode($re, 1);
                dd($res);
            }
        }
        return view("admin.upload.save");
    }

    public function upload_list(Request $request){
        $url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".access_token();
        $data=json_encode(["type"=>"voice","offset"=>"0","count"=>"2"],JSON_UNESCAPED_UNICODE);
        $re = curl_post($url,$data);
        $res=json_decode($re,1);
        dd($res);
    }

}
