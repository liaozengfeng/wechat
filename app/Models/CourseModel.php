<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    public $table = "course";
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
