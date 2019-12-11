<?php

namespace App\Http\Controllers\Port;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PortController extends Controller
{
    public function index(Request $request){
        echo 111;exit;
        var_dump($request->all());exit;
        $redis = new \Redis();
        $redis->connect('127.0.0.1');
    }
}
