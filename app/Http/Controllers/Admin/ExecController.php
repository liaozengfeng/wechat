<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\IntegralController;
use App\Http\Controllers\Admin\OllController;
class ExecController extends Controller
{
    public function exec(Request $request){
        //接收微信发送的信息
        $info=file_get_contents("php://input");
        //写入log日志
        file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),$info,FILE_APPEND);
        //处理xml的加密
        $xml_obj = simplexml_load_string($info,'SimpleXMLElement',LIBXML_NOCDATA);
        $xml_arr = (array)$xml_obj;
        //判断xml数据中的MsgType值为event 并且  Event值为 unsubscribe  说明用户取关了次公众号
        if (isset($xml_arr['Content'])){
            $str = mb_substr($xml_arr['Content'], -2, 2, "utf-8");
            $val=mb_substr($xml_arr['Content'],0,-2,"utf-8");
        }
        if ($xml_arr['MsgType']=='event'&&$xml_arr['Event']=="unsubscribe"){
            //当用户取关 调用IntegralController控制器中的user_del方法 删除数据库中的该用户数据
            $re=IntegralController::user_del($xml_arr['FromUserName']);
            //删除成功
            if ($re){
                $content='去你的吧!!!';
            }
            //判断xml数据中的MsgType值为event 并且  Event subscribe  说明用户关注了次公众号
        }else if ($xml_arr['MsgType']=='event'&&$xml_arr['Event']=="subscribe"){
            if (isset($xml_arr['Ticket'])){
                $res=IntegralController::user_add($xml_arr['FromUserName'],$xml_arr['EventKey']);
            }else {
                //当用户管制公众号时 调用IntegralController控制器中的user_save方法 根据用户openid添加用户信息
                $res = IntegralController::user_save($xml_arr['FromUserName']);
            }
//            $content = "欢迎关注:".$res."廖神支付!\n廖神支付,\n支付无忧;\n平台保证:\n无售后!!\n无服务!!\n无态度!!";
            $content="您好,".$res."帅哥\n欢迎关注本工作号,\n发送1 回复本班讲师名称\n发送2 回复本班讲师帅帅照";
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="图片"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId>"."OvCzfxlDJZOhzl4EjwA1L2n60OIWxD1LEEOQHDH_2rM"."</MediaId></Image></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$str=="油价"){
            $arr=OllController::info($val);
//            dd($arr);
            if(!empty($arr)){
                $aaa=[
                    "touser"=>$xml_arr['FromUserName'],
                    "template_id"=>"JDgWBqTNZsMS-iZYOwvWuM4gU9bUo0o0fQo53eP0nvM",
                    "data"=>[
                        "name"=>[
                            "value"=>$arr['city'],
                            "color"=>"red",
                        ],"92h"=>[
                            "value"=>$arr['92h'],
                            "color"=>"red",
                        ],"95h"=>[
                            "value"=>$arr['95h'],
                            "color"=>"red",
                        ],"98h"=>[
                            "value"=>$arr['98h'],
                            "color"=>"red",
                        ],"0h"=>[
                            "value"=>$arr['0h'],
                            "color"=>"red",
                        ],
                    ]
                ];
                $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".access_token();
                $aaa=json_encode($aaa,JSON_UNESCAPED_UNICODE);
                $re=curl_post($url,$aaa);exit;
            }else{
                $content="暂无数据";
            }
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="音乐"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId>"."OvCzfxlDJZOhzl4EjwA1L1LmD3idN1e4IphMDLj-Hg0"."</MediaId></Voice></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="视频"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId>"."OvCzfxlDJZOhzl4EjwA1L9aVUZbdwbXCX3vFxylm0PY"."</MediaId><Title>"."今日俺バンド - 男の勲章"."</Title><Description>"."什么 这怎么可能嘛 就那种 就她 就理子那种可笑的名字啊 还嚣张的要命 一副高高在上的样子 那什么 她跑来挑衅的时候 眼睛都在闪闪发光啊 真的闪闪发光哦 真的是闪闪发光哦 那什么 真的是 那什么 是星星吗 满天的星空吗 满天的星星 那什么 都在她的眼睛里"."</Description></Video></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="支付"){
            $content="支付提醒:\n本平台不提供任何售后服务哦!!!!";
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="你好"){
            $content="会说话吗?\n叫爹!!";
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="1"){
            $content="本班讲师:白伟";
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="2"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId>"."OvCzfxlDJZOhzl4EjwA1L2n60OIWxD1LEEOQHDH_2rM"."</MediaId></Image></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="滚"){
            $content="傻逼";
        }else if($xml_arr['MsgType']=='text'&&isset($xml_arr['Content'])&&$xml_arr['Content']=="爹"){
            $content="真乖!!";
            //判断xml数据中的MsgType值为event 并且  EventKey键值为V1001_TODAY_MUSIC  说明用户点击了签到
        }else if($xml_arr['MsgType']=='event'&&$xml_arr['EventKey']=="V1001_TODAY_MUSIC"){
            //用户点击签到 调用IntegralController控制器中的integral_save方法 根据openid修改数据库
            //$xml_arr['FromUserName'] 用户的openid
            $re=IntegralController::integral_save($xml_arr['FromUserName']);
            if ($re['res']) {
                //修改成功
                $content = "签到成功!";
            }else{
                //修改失败
                $content="今日已签到";
            }
            //判断xml数据中的MsgType值为event 并且 EventKey键值为V1002_TODAY_MUSIC  说明用户点击了查询积分
        }else if ($xml_arr['MsgType']=='event'&&$xml_arr['EventKey']=="V1002_TODAY_MUSIC"){
            //用户点击查看积分时 调用IntegralController控制器中的integral_select方法 根据用户openid查询数据库 返回积分
            $re=IntegralController::integral_select($xml_arr['FromUserName']);
            //拼接回复数据
            $content = "已有积分:".$re;
        }else if ($xml_arr['MsgType']=='event'&&$xml_arr['EventKey']=="exam_weather"){
            $res=ExamController::tqlist();
            $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".access_token();
            $aaa=[
                "touser"=>$xml_arr['FromUserName'],
                "template_id"=>"hnzldZw0vdtYLNr5J8wyOtcbMK-jtq78xp9NDwLxr1s",
                "data"=>[
                    "date"=>[
                        "value"=>date("Y:m:d",time()),
                        "color"=>"red",
                    ],"week"=>[
                        "value"=>$res['result']['realTime']['week'],
                        "color"=>"red",
                    ],"temperature"=>[
                        "value"=>$res['result']['realTime']['wtTemp'],
                        "color"=>"red",
                    ],"weather"=>[
                        "value"=>$res['result']['realTime']['wtNm'],
                        "color"=>"red",
                    ]
                ]
            ];
            $data=json_encode($aaa,JSON_UNESCAPED_UNICODE);
            $res=curl_post($url,$data);
            dd($res);
        }else if($xml_arr['MsgType']=='event'&&$xml_arr['EventKey']=="See_the_course"){
            //查看课程
            $info=CourseController::info_list($xml_arr['FromUserName']);
            if(empty($info)){
                $content="您暂未选择课程,请选择课程!";
            }else{
                $content="你好!".$info['name']."同学,你的课程安排如下\n第一节课:".$info['one']."\n第二节课:".$info['two']."\n第三节课:".$info['three']."\n第四节课:".$info['four'];
            }
        }else if($xml_arr['MsgType']=='text'){
            $content = "廖神支付!欢迎你!!";
        }
        echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$content."]]></Content></xml>";
    }
}


   