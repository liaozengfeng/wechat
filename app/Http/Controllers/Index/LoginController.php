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

     //微信登录
    //得到code
    public function wechat_code(Request $request){
        $url=urlencode(env('APP_URL')."/index/wechat_token");
        header("location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WECHAT_APPID')."&redirect_uri=$url&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
    }
    public function wechat_token(Request $request){
        $code=$request->input("code");
        $http="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET')."&code=$code&grant_type=authorization_code";
        $res=file_get_contents($http);
        $info=json_decode($res,1);
        $access_token=$info['access_token'];
        $openid=$info['openid'];
        $where[] = [
            'openid','=',$openid,
        ];
        $user_info=UserModels::where($where)->first();
        if (empty($user_info)){
            $arr=file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
            $users_info=json_decode($arr,1);
            $user_info=[
              "openid"=>$openid,
              "phone"=>$users_info['nickname'],
            ];
            $res=\DB::table('user')->insertGetId($user_info);
            $user_info=UserModels::where("uid",$res)->first()->toArray();
            if (!empty($user_info)){
                $request->session()->put('userinfo', $user_info);
                return redirect("/index/user");
            }
        }else{
            $request->session()->put('userinfo', $user_info);
            return redirect("/index/user");
        }
    }

    //get
    public function get(Request $request){
        $url='http://www.baidu.com/';
        $curl=curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($curl);
        echo $result;
        curl_close($curl);
    }

    public function post(Request $request){
        $url='http://www.baidu.com/';
        $curl=curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        
        curl_setopt($curl,CURLOPT_POST,true);
        $post_data = [
          "name"=>222
        ];
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,$post_data);

        $result=curl_exec($curl);
        var_dump($result);
        curl_close($curl);
    }
}
