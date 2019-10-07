<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\SortModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index(Request $request){
        $p=$request->input("page") ?? 1 ;
        $list=Cache::get("list-".$p);
        //此判断为 redis 缓存
        if (empty($list)){
            $shop_model=new ShopModel();
            $brand_model=new BrandModel();
            $sort_model=new SortModel();
            $sort_id=$sort_model->all();
            $sortid=$sort_model->where("parent_id",0)->get()->toArray();
            $sort_id=$sort_model::sortinfoattr($sort_id,$sortid[0]['sort_id']);
            $sort_id=implode(",",$sort_id);
            $data=$shop_model->whereRaw("sort_id in ($sort_id)")->paginate(6);
            $f=$sortid[0]['sort_id'];
            $list=$shop_model->paginate(6);
            $info=$brand_model->paginate(9);
            Cache::set("list-".$p,$list,now()->addSecond(60*5));
            Cache::set("data-".$p,$data,now()->addSecond(60*5));
            Cache::set("info-".$p,$info,now()->addSecond(60*5));
            Cache::set("f-".$p,$f,now()->addSecond(60*5));
        }else{
            $list=Cache::get("list-".$p);
            $data=Cache::get("data-".$p);
            $info=Cache::get("info-".$p);
            $f=Cache::get("f-".$p);
        }
        return view("index.shop.index",['data'=>$data,"list"=>$list,"info"=>$info,"f"=>$f]);
    }

    //楼层
    public function sortinfo(Request $request){
        $sort_model=new SortModel();
        $shop_model=new ShopModel();
        $sort_id=$sort_model->all();
        $sort_id=$sort_model::sortinfoattr($sort_id,$request->input('id')+1);
        $sort_id=implode(",",$sort_id);
        $data=$shop_model->whereRaw("sort_id in ($sort_id)")->paginate(6);
        $f=$request->input('id')+1;
        return view("index.shop.sortinfo",['data'=>$data,"f"=>$f]);
    }
}
