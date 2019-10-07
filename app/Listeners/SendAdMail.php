<?php

namespace App\Listeners;

use App\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;


class SendAdMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Register  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // 从事件中拿到参数
        $this->user = $event->user;
        Mail::send('email.loginsuccess',['username'=>$this->user->name,'content'=>'嘿嘿嘿'],function($message){
            $message->to($this->user->email);
            $message->subject("恭喜您，登录成功!");
        });
        // $this->dispatch(new SendEmail($this->user,'恭喜你登录成功',"欢迎来到我的博客，资源大大的有，请放开你的胆量和流量，尽情享受成人的世界吧!温馨提示：看的同时注意身体! 种子地址: http://www.baidu.com/seed?id=232423427482744"));

    }
}
