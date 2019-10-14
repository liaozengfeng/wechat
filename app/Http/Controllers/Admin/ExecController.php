<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ExecController extends Controller
{
    public function exec(Request $request){
        echo $_GET['echostr'];
    }
}
