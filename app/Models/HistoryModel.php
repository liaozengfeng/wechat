<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryModel extends Model
{
    //
    public $table = "history";
    public $timestamps = false;
    protected $primaryKey = 'h_id';
    protected $guarded = [];

}
