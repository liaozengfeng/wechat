<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\IntegralController;
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
        if ($xml_arr['MsgType']=='event'&&$xml_arr['Event']=="unsubscribe"){
            //当用户取关 调用IntegralController控制器中的user_del方法 删除数据库中的该用户数据
            $re=IntegralController::user_del($xml_arr['FromUserName']);
            //删除成功
            if ($re){
                $content='去你的吧!!!';
            }
            //判断xml数据中的MsgType值为event 并且  Event subscribe  说明用户关注了次公众号
        }else if ($xml_arr['MsgType']=='event'&&$xml_arr['Event']=="subscribe"){
            //当用户管制公众号时 调用IntegralController控制器中的user_save方法 根据用户openid添加用户信息
            $re=IntegralController::user_save($xml_arr['FromUserName']);
            if ($re) {
                $content = "欢迎关注:廖神支付!\n廖神支付,\n支付无忧;\n平台保证:\n无售后!!\n无服务!!\n无态度!!";
            }
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="图片"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId>"."OvCzfxlDJZOhzl4EjwA1L2n60OIWxD1LEEOQHDH_2rM"."</MediaId></Image></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="音乐"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId>"."OvCzfxlDJZOhzl4EjwA1L1LmD3idN1e4IphMDLj-Hg0"."</MediaId></Voice></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="视频"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId>"."OvCzfxlDJZOhzl4EjwA1L9aVUZbdwbXCX3vFxylm0PY"."</MediaId><Title>"."今日俺バンド - 男の勲章"."</Title><Description>"."什么 这怎么可能嘛 就那种 就她 就理子那种可笑的名字啊 还嚣张的要命 一副高高在上的样子 那什么 她跑来挑衅的时候 眼睛都在闪闪发光啊 真的闪闪发光哦 真的是闪闪发光哦 那什么 真的是 那什么 是星星吗 满天的星空吗 满天的星星 那什么 都在她的眼睛里"."</Description></Video></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="支付"){
            $content="支付提醒:\n本平台不提供任何售后服务哦!!!!";
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="你好"){
            $content="会说话吗?\n叫爹!!";
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="滚"){
            $content="傻逼";
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="爹"){
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
        }else if($xml_arr['MsgType']=='text'){
            $content = "廖神支付!欢迎你!!";
        }
        echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$content."]]></Content></xml>";
    }
}