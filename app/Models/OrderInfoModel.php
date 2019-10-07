<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfoModel extends Model
{
    //
    public $table = "order_info";
    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $primaryKey = 'order_id';
    protected $guarded = [];
}
