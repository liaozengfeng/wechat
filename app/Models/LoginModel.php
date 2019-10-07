<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    //指定表名  因laravel框架默认表名比模型名多一个s
   public $table="admin";
    //指定主键id
    public $primaryKey="u_id";
    //模型默认的表主键为int类型,且自增 取消其属性
    public $incrementing=false;
    //取消模型中自动添加的时间
//    public $timestamps=false;
    //自定义时间字段
    const CREATED_AT = "a_time";
    const UPDATED_AT = "u_time";
    //将模型自动添加的时间改为int类型  默认字符串类型
    protected $dateFormat="U";
}
