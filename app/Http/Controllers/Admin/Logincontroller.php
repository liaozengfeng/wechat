<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginModel;
use App\Models\ShopModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class Logincontroller extends Controller
{
    
    public function login(Request $request)
    {
    	if ($request->isMethod("POST")) {
    		$obj=new LoginModel();
    		$where=[
    			["admin_account","=",$request->account],
    			["admin_pwd","=",md5($request->pwd)]
    		];
    		$arr=$obj->where($where)->first();
            if ($arr) {
                $info=["admin_account"=>$arr->admin_account,"admin_pwd"=>$arr->admin_id];
                session(['user'=>$info]);
                session()->save();
                echo 1;exit;
   			 }else{
   			 	echo "账号或密码错误";exit;
   			 } 		
       	}
       return view("Admin.login");
    }
}
