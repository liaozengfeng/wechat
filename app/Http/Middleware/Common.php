<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Common extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    static public function infinite($data,$parent_id=0,$level=1)
    {
        static $arr=[];
        foreach ($data as $k=>$v){
            if ($v->parent_id==$parent_id){
                $v['level']=$level;
                $arr[]=$v;
                Common::infinite($data,$v->sort_id,$level+1);
            }
        }
    }
}
