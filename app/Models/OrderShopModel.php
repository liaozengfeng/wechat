<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderShopModel extends Model
{
    //
    public $table = "order_shop";
//    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $primaryKey = 'order_shop_id';
    protected $guarded = [];
}
