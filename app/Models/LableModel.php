<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LableModel extends Model
{
    //
    public $table = "lable";
//    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $primaryKey = 'l_id';
    protected $guarded = [];
}
