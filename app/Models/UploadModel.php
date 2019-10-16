<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadModel extends Model
{
    //指定表名  因laravel框架默认表名比模型名多一个s
    public $table="upload";
    //指定主键id
    public $primaryKey="id";
    // //模型默认的表主键为int类型,且自增 取消其属性
    // public $incrementing=false;
    public $fillable=["medie_id","addtime","type","path"];
    //取消模型中自动添加的时间
    public $timestamps=false;
    //自定义时间字段
    // const CREATED_AT = "created_at";
    // const UPDATED_AT = "updated_at";
    //将模型自动添加的时间改为int类型  默认字符串类型
    // protected $dateFormat="U";
}
