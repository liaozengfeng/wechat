<?php

namespace App\Http\Controllers\Index;
use Cookie;
use Illuminate\Http\Request;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\SortModel;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function brand(Request $request){
        $id=$request->cart_id;
        $where=[];
        if (!empty($id)){
            $where[]=["sort_id","=",$id];
        }
        if (!empty($request->id)){
            $where[]=["brand_id","=",$request->id];
        }
        $shop_model=new ShopModel();
        $data=$shop_model->where($where)->get();
        return view("index.brand.brand",["list"=>$data,"sort_id"=>$id]);
    }

    //列表页ajax条件搜索
    public function shop_where(Request $request){
        $like=$request->input("val");
        $field = $request->input('field')??'shop_id';
        $order = $request->input('order')??'asc';
        $sort_id = $request->input('sort_id')??"";
        $where=[];
        $shop_where="1=1";
        $Sort_model=new SortModel();
        if (!empty($sort_id)){
            $sortinfo=$Sort_model->all();
            $sort_id=$Sort_model::sortinfoattr($sortinfo,$sort_id);
        }
        if (!empty($like)){
            $where["shop"]=[["shop_name","like","%".$like."%"]];
            $where["sort"]=[["sort_name","like","%".$like."%"]];
            $where["brand"]=[["brand_name","like","%".$like."%"]];
            //搜索 分类
            $sort_id=$Sort_model->orwhere($where['sort'])->get()->toArray();
            $sortinfo=$Sort_model->all();
            //判断分类 是否有数据
            if (count($sort_id)>0){
                $sort_id=$Sort_model::sortinfoattr($sortinfo,$sort_id[0]['sort_id']);
                $sort_id=array_unique($sort_id);
            }
            //搜索 品牌
            $brandModel=new BrandModel;
            $brand_id=$brandModel->orwhere($where["brand"])->get()->toArray();
            //判断品牌 是否有数据
            if (count($brand_id)>0){
                $brandinfo=$brandModel->all();
                $brand_id=$Sort_model::sortinfoattr($brandinfo,$brand_id[0]['brand_id']);
            }
            //拼接条件查询商品
            if (count($brand_id)>0){
                $brand_id=implode(",",$brand_id);
                $shop_where.="brand_id in ($brand_id)";
            }

            $shop_where.=" and shop_name like '%$like%'";
        }
        if (!empty($sort_id)>0){
            $sort_id=implode(",",$sort_id);
            $shop_where.=" and sort_id in ($sort_id)";
        }
        $shop_order=$field." ".$order;
        $shop_model=new ShopModel();
        $shop_info=$shop_model->whereRaw($shop_where)->orderByRaw($shop_order)->get()->toArray();
        return view("index.brand.shopwhere",['data'=>$shop_info]);
    }

    public function progoods(Request $request)
    {
        if(!empty($cids)){
            $goods = ShopModel::whereIn('sort_id',$cids)->orderBy($field,$order)->get();
        }
        $is_sell = $request->input('is_sell');
        if(!empty($is_sell)){
            $goods = Csgoods::where(['is_sell'=>$is_sell])->orderBy($field,$order)->get();
        }
        return view('index/pro/div',['good'=>$goods]);
    }

    static public function cookie(Request $request){
        $data=Cookie::get("info");
        $data=json_decode($data);
        var_dump($data);exit;
        if (!empty($data)){
            $date[]=["info","aaa","eee"];
//            $date[]=$data;
        }else{
            $date[]=["asdc","fsdf","safs"];
        }
        $arr=json_encode($date);
        Cookie::queue("info",$arr,9000);exit;
    }
}
