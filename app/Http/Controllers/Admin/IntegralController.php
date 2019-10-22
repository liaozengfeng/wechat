<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IntegralModel;
use Illuminate\Support\Facades\DB;
class IntegralController extends Controller
{
    //用户添加
    static public function user_save($openid){
        //根据openid查询公众粉丝个人信息
        $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".access_token()."&openid=".$openid."&lang=zh_CN";
        $data=curl_get($url);
        //json_decode解密数据
        $data=json_decode($data,1);
        //将个人信息拼成一维数组添加进数据库
        $info=['openid'=>$data['openid'],"name"=>$data['nickname'],"add_time"=>time(),"up_time"=>0];
        $res=IntegralModel::create($info);
        //返回添加结果
        return $res;
    }
    static public function integral_save($openid){
        //根据$openid查询数据库
        $data=IntegralModel::where("openid",$openid)->first();
        //判断该用户上次签到与本次签到相差是否一天 并且相差小于两天
        if (time() - $data->up_time > 24*60*60 && time() - $data->up_time < 24*60*60*2){
            //连续签到次数
            $count=$data->count+1;
            //总积分  连续签到次数*5加上已有积分
            $integral=$count*5+$data->integral;
            //拼数组 用于修改数据库
            $info=["count"=>$count,"up_time"=>time(),"integral"=>$integral];
            $res=Db::table("wechat_integral")->where("openid",$openid)->update($info);
            //判断本次签到时间和上次签到时间相差是否有两天或者签到次数已满
        }else if (time() - $data->up_time > 24*60*60*2 || $data->count > 5){
            //若满足条件
            //本次签到积分增加为5
            $integral=$data->integral+5;
            //拼一维数组
            $info=["count"=>1,"up_time"=>time(),"integral"=>$integral];
            //执行修改
            $res=Db::table("wechat_integral")->where("openid",$openid)->update($info);
        }else{
            //若今日已签到 返回false表示已签到
            $res=false;
        }
        return ["res"=>$res];
    }

    static public function integral_select($openid){
        //根据openid查询数据库
        $data=IntegralModel::where("openid",$openid)->first()->toArray();
        //返回该用户已有积分
        return $data['integral'];
    }

    static public function user_del($openid){
        //用户取关 删除数据库数据
        $res=IntegralModel::where("openid",$openid)->update(['attention'=>0]);
        return $res;
    }
}