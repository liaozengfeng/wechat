<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressModels extends Model
{
    //
    public $table = "address";
    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $primaryKey = 'address_id';
    protected $guarded = [];
}
