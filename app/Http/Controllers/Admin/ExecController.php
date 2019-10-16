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
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="积分"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId>"."4WKzuMmwi4JMTrU-Mw7oIQcsTzYYTQb_fEhKKtV6pX-gE3m76PKdXJbTQtJkR0wW"."</MediaId></Image></xml>";exit;
        }else if($xml_arr['MsgType']=='text'&&$xml_arr['Content']=="兑换"){
            echo "<xml><ToUserName><![CDATA[".$xml_arr['FromUserName']."]]></ToUserName><FromUserName><![CDATA[".$xml_arr['ToUserName']."]]></FromUserName><CreateTime>".time()."</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId>'oA0YvEnRdTEaUgvQTB-RtFtsQ5EJMU_uF8dw7tnZEXJdeE_A3BX4vWDixzVvqlSS'</MediaId></Voice></xml>";exit;
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
