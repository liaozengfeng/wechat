<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginSuccess;
use App\Models\LoginModel;
use App\Models\ShopModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class UserController extends Controller
{

    protected $subject = "这是测试";


    public function logout(Request $request){
    	//退出登录
    	Auth::guard()->logout();
    	//跳转到首页
    	return redirect('/');
    }

    //发送邮件
    public function send(Request $request){
    	// Mail::to($request->user())->send(new LoginSuccess(Auth::user()->name));
        // $this->dispatch(new SendEmail($request->user(),"这是测试","谢谢参与"));
 
        Mail::to($request->user())->queue(new LoginSuccess($request->user()->name,"这是测试,谢谢参与"));

        return "发送成功";
    }
}
