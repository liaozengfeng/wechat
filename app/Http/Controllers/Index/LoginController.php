<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\UserModels;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
        //注册
    public function regist()
    {
        return view("index/login/regist");
    }
    //执行注册
    public function regist_do(Request $request)
    {
        if($request->isMethod('POST')){
            $all = $request->except('_token');
            //判断不为空
            if(empty($all['phone']&&$all['pwd']&&$all['conpwd'])){
                echo json_encode(['code'=>0,'font'=>'不可为空']);die;
            }
            //判断输入正确手机号格式
            if(strlen($all['phone'])<11){
                echo json_encode(['code'=>0,'font'=>'请输入正确的手机号格式']);die;
            }
            //判断手机号的合法性
            $check = '/^(1(([35789][0-9])|(47)))\d{8}$/';
            if(!preg_match($check,$all['phone'])){
                echo json_encode(['code'=>0,'font'=>'请输入合法的手机号']);die;
            }
            //判断用户是否存在
            $arr=UserModels::where("phone",$all['phone'])->first();
            if(!empty($arr)){
                echo json_encode(['code'=>0,'font'=>'用户名已存在']);die;
            }
            //判断协议是否勾选
            //判断两次输入的密码是否一致
            if($all['pwd']!=$all['conpwd']){
                echo json_encode(['code'=>0,'font'=>'两次密码输入不一致']);die;
            }
            $pwd = base64_encode($all['pwd']);
            $conpwd = base64_encode($all['conpwd']);
            $all['pwd'] = $pwd;
            $all['conpwd'] = $conpwd;
            $res=  UserModels::create($all);
            // dd($res);   
            if($res){
                echo json_encode(['code'=>1,'font'=>'注册成功']);
                // return redirect('admin/Userlist');
            }else{
                echo json_encode(['code'=>0,'font'=>'注册失败']);
            }
        }
    }
    //跳到登录页面
    public function login()
    {
        return view('index/login/login');
    }

    public function login_do(Request $request){
        if ($request->isMethod("POST")){
            $data = $request->except("_token");
            $where[] = [
                'phone','=',$data['phone'],
            ];
            //实例化model类
            $UserModels = new UserModels;
            //查询一条
            $userinfo = $UserModels->where($where)->first();
            //判断用户名是否存在
            if(empty($userinfo)){
                return "<script>alert('用户名错误或不存在');parent.location.href='/index/login';</script>";die;
            }else{
                //判断密码
                if($userinfo['pwd']==base64_encode($data['pwd'])){
                    $request->session()->put('userinfo', $userinfo);
                    return "<script>alert('登录成功');parent.location.href='/index/shop';</script>";die;
                }
            }
        }else {
            return "<script>alert('密码错误');parent.location.href='/index/login';</script>";die;
        }
    }
     //注销登录
     public function logout(Request $request){
        //退出登录
        session(['userinfo'=>null]);
        //跳转到登录页面
        return redirect('/index/shop');
    }
     //取用户名
     public function session(Request $request)
     {
         $data = $request->session()->get('userinfo');
        //   dd(session('userinfo')['phone']);
         return view('index/user/index');
     }
}
