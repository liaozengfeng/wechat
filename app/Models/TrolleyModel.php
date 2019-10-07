<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TrolleyModel extends Model
{
    protected $table = 'trolley';// 表
    protected $primaryKey = 't_id';// 主键
    // 定义常量时间
    const CREATED_AT = 'add_time';
    const UPDATED_AT = 'update_time';
    //  int类型 时间
    protected $dateFormat = 'U'; // U表示时间戳类型/
    protected $guarded = [];// 不可批量赋值的属性。 不加字段 可以通过
    // protected $fillable = ['name','sex','age','desc','add_time','update_time'];
    // // 可批量赋值的属性。 要加字段  可以通过
    // 取消自动维护
    // public $timestamps = false;
}
