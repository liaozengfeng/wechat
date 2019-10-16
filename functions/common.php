<?php
function checkLogin(){
    return !empty(session("userinfo")['uid']);
}
function curl_post($url,$data)
{
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function curl_get($url)
{
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function access_token(){
//        \Cache::forget('access_token');
//        exit;
    if (\Cache::has('access_token')){
        $url = \Cache::get('access_token');
    }else{
        $url=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxde5ec157a4c4a706&secret=bdf8c3440327b44932d6c6c79215372e");
        $url=json_decode($url);
        \Cache::set('access_token',$url->access_token, $url->expires_in);
        $url=$url->access_token;
    }
    return $url;
}

function curl_File($url,$poth)
{
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($curl,CURLOPT_POST,true);
    $data['media']=new \CURLFile(realpath($poth));
    curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

//清空公众号调用接口
function aaa(){
    $url="https://api.weixin.qq.com/cgi-bin/clear_quota?access_token=".access_token();
    $data=json_encode(['appid'=>env("WECHAT_APPID")]);
    $res=curl_post($url,$data);
    $res=json_decode($res);
    return $res;
}
