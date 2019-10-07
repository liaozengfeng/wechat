<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\SortModel;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Common;

class CartController extends Controller
{
    public function sort(Request $request){
        $sort_model=new SortModel();
        $data=$sort_model->get();
        $arr=$sort_model::info($data);
        return view("index.cart.cart",["list"=>$arr]);
    }

}
