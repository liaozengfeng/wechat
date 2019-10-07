<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SortModel extends Model
{
    //指定表名  因laravel框架默认表名比模型名多一个s
    public $table="sort";
    //指定主键id
    public $primaryKey="sort_id";

     protected $fillable = ['sort_name','parent_id','sort_show','sort_nav_show'];
    //模型默认的表主键为int类型,且自增 取消其属性
//     public $incrementing=false;
//     //取消模型中自动添加的时间
// //    public $timestamps=false;
//     //自定义时间字段fo
//     const CREATED_AT = "created_at";
//     const UPDATED_AT = "updated_at";
    //将模型自动添加的时间改为int类型  默认字符串类型
    // protected $dateFormat="U";

    public static function info($data,$parent_id=0){
        $arr=[];
        foreach ($data as $k=>$v) {
            if ($v->parent_id == $parent_id) {
                $son=self::info($data,$v->sort_id);
                $v['son']=$son;
                $arr[$k]=$v;
            }
        }
        return $arr;
    }

    public static function sortinfoattr($data,$parent_id){
        static $arr=[];
        $arr[$parent_id]=$parent_id;
        foreach ($data as $k => $v) {
            if ($parent_id==$v->parent_id) {
                $arr[$v->sort_id]=$v->sort_id;
                self::sortinfoattr($data,$v->sort_id);
            }
        }
        return $arr;
    }
}
