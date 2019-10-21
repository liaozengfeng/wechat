<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
	public $primaryKey="id";
    public $table="menu";
    public $timestamps=false;
     //指定表名  因laravel框架默认表名比模型名多一个s
    //指定主键id
    //模型默认的表主键为int类型,且自增 取消其属性
//    public $incrementing=false;
    //取消模型中自动添加的时间
//    public $timestamps=false;
    protected $guarded = [];
    
}
