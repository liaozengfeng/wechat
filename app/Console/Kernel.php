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
                        if ($va['one'] == $v['id']) {
                            $arr['one'] = $v['name'];
                        } else if ($va['two'] == $v['id']) {
                            $arr['two'] = $v['name'];
                        } else if ($va['three'] == $v['id']) {
                            $arr['three'] = $v['name'];
                        } else if ($va['four'] == $v['id']) {
                            $arr['four'] = $v['name'];
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
                    file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
                    file_put_contents(storage_path('logs/shop/'.date('Y-m-d').'.log'),$re,FILE_APPEND);
                }
            }
        })->cron('20:00');
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
