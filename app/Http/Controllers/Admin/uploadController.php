<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class uploadController extends Controller
{
    public function upload(Request $request){
        if ($request->isMethod("POST")){
            if ($request->hasFile("upload_file")) {
                dd("没有文件被上传");
            }
            $type = $request->input("type");
            $file_obj = $request->file("upload_file");
            $file_ext = $file_obj->getClientOriginalExtension();
            $file_name = time() . rand(1000, 9999) . "." . $file_ext;
            $path = $request->file('upload_file')->storeAs('upload/' . $type . "/", $file_name);
            $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=" . access_token() . "&type=" . $type;
            $re = curl_File($url, storage_path("app/public/upload/" . $type . "/" . $file_name));
            $res = json_decode($re, 1);
            session("media_id",$res['media_id']);
            dd($res);
        }
        return view("admin.upload.save");
    }

    public function upload_list(Request $request){
        $url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".access_token();
        $data=json_encode(["type"=>"voice","offset"=>0,"count"=>2]);
        $re = curl_File($url,$data);
        $res=json_decode($re,1);
        dd($res);
    }

}

