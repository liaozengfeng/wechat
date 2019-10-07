<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaModels extends Model
{
    //
    public $table = "area";
    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
