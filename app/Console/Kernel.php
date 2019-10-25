<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\CourseModel;
use App\Models\IntegralModel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $user_info=IntegralModel::get()->toArray();
            $data=CourseModel::get()->toArray();
            $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".access_token();
            foreach ($user_info as $ke=>$va){
                if (!empty($va['one'])){
                    $arr['name']=$va['name'];
                    $arr['openid']=$va['openid'];
                    foreach($data as $k=>$v) {
                        foreach ($va as $key=>$val){
                            if($val==$v['id']){
                                $arr[$key]=$v['name'];
                            }
                        }
                    }
                    $aaa=[
                        "touser"=>$arr['openid'],
                        "template_id"=>"eeVIhUFGCbe9w-tQ3r-W7w-dX9T5Qfjv2OXwr-WOjZk",
                        "data"=>[
                            "name"=>[
                                "value"=>$arr['name'],
                                "color"=>"red",
                            ],"one"=>[
                                "value"=>$arr['one'],
                                "color"=>"red",
                            ],"two"=>[
                                "value"=>$arr['two'],
                                "color"=>"red",
                            ],"three"=>[
                                "value"=>$arr['three'],
                                "color"=>"red",
                            ],"four"=>[
                                "value"=>$arr['four'],
                                "color"=>"red",
                            ],
                        ]
                    ];
                    $aaa=json_encode($aaa,JSON_UNESCAPED_UNICODE);
                    $re=curl_post($url,$aaa);
                    $re=json_decode($re,1);
                    file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),"\n\n<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
                    file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),$re,FILE_APPEND);
                }
            }
        })->everyMinute();

        $schedule->call(function () {
            $url="http://apis.juhe.cn/cnoil/oil_city?key=038f96a552851a4aa8e93945d71e57ff";
            $aaa=curl_get($url);
            $aaa=json_decode($aaa,true,JSON_UNESCAPED_UNICODE);
            $open=$oll=\Cache::get("oll");
            if ($aaa['result']==$open) {
                $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".access_token()."&next_openid=";
                $openid=curl_get($url);
                $openid=json_decode($openid,1);
                $openid=$openid['data']['openid'];
                $data = [
                    "touser" => $openid,
                    "msgtype" => "text",
                    "text" => [
                        "content" => "油价变动通知".time(),
                    ]
                ];
                $url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".access_token();
                $data=json_encode($data,JSON_UNESCAPED_UNICODE);
                $res=curl_post($url,$data);
                $res=json_decode($res,1);
                file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),"\n\n<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
                file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),$res,FILE_APPEND);
            }
            \Cache::forget('oll');
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
