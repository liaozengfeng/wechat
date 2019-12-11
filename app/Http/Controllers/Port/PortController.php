<?php

namespace App\Http\Controllers\Port;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PortController extends Controller
{
    public function save(Request $request){
        $redis = new \Redis();
        $redis->connect('127.0.0.1');
    }
}
