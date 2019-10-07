<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModels extends Model
{
    //
    public $table = "user";
    protected $dateFormat = 'U';
    //public $timestamps = false;
    protected $primaryKey = 'uid';
    protected $guarded = [];
}
