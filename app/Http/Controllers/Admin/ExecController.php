<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

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
        if ($xml_arr['MsgType']=='event'&&$xml_arr['Event']=="unsubscribe"){
            $content='去你的吧!!!';
        }else if ($xml_arr['MsgType']=='event'&&$xml_arr['Event']=="subscribe"){
            $content="欢迎关注:廖神支付!\n廖神支付,\n支付无忧;\n平台保证:\n无售后!!\n无服务!!\n无态度!!";
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="图片"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId>"."4WKzuMmwi4JMTrU-Mw7oIQcsTzYYTQb_fEhKKtV6pX-gE3m76PKdXJbTQtJkR0wW"."</MediaId></Image></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="音乐"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId>"."QqpDN4vzCAPFIRZ2vOd2YANSvR4qMqERGzg6fF-Fp4anc2_Eq_YM6q1QZX0qqoa9"."</MediaId></Voice></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="视频"){
            echo "<xml>
  <ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName>
  <FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName>
  <CreateTime>".time()."</CreateTime>
  <MsgType><![CDATA[video]]></MsgType>
  <Video>
    <MediaId>"."CkP8yaVLM1jc4fJ1OLCIRFzXIkBo_CnqYMiSBEr2ifSB0TcTImtadya25W8QQHF1"."</MediaId>
    <Title>"."今日俺バンド - 男の勲章"."</Title>
    <Description>"."什么 这怎么可能嘛 就那种 就她 就理子那种可笑的名字啊 还嚣张的要命 一副高高在上的样子 那什么 她跑来挑衅的时候 眼睛都在闪闪发光啊 真的闪闪发光哦 真的是闪闪发光哦 那什么 真的是 那什么 是星星吗 满天的星空吗 满天的星星 那什么 都在她的眼睛里"."</Description>
  </Video>
</xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="支付"){
            $content="支付提醒:\n本平台不提供任何售后服务哦!!!!";
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="你好"){
            $content="会说话吗?\n叫爹!!";
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="滚"){
            $content="傻逼";
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="爹"){
            $content="真乖!!";
        }else if($xml_arr['MsgType']=='text'){
            $content = "廖神支付!欢迎你!!";
        }
        echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$content."]]></Content></xml>";

    }
}
