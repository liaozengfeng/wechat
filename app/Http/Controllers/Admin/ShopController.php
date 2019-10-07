<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginModel;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\SortModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        $obj=new ShopModel();
        $data=$obj->join("sort","shop.sort_id","=","sort.sort_id")->join("brand","shop.brand_id","=","brand.brand_id")->paginate(3);
        if (count($data)==0){
            $data=false;
        }
    	return view("Admin.shop.index",["list"=>$data]);
    }
    public function save(Request $request){

        if($request->isMethod('POST')){

            //上传文件

            $path = $request->file('shop_img')->store('imgs');
            $data= $request->all();

            $data['shop_img']=$path;

                //多图
                $arr = request()->file('shop_imgs');
                // dd($arr);exit;
                foreach($arr as $k => $v)
                {
                    $data['shop_imgss'][] = $v->store('shop_imgs');
                }
                $data['shop_imgs']=implode("|",$data['shop_imgss']);
    
                unset($data['shop_imgss']);

                //dd($data);exit;
                $article = ShopModel::create($data);
                //dd($article);exit;
                if($article){
                  session()->flash('shop',"添加成功,用户id为".$article->shop_id);
                  return redirect('shop/index');
                }
             }
                    $brand_model=new BrandModel();
                    $sort_model=new SortModel();
                    $brand_info=$brand_model->all()->toArray();
                    $sort_info=$sort_model->all()->toArray();
                    $sort_info=self::info($sort_info);
                    return view("admin.shop._save",["sort_info"=>$sort_info,"brand_info"=>$brand_info]);
    }
    public function info($data,$parent_id=0,$level=1){
        static $arr=[];
        foreach ($data as $k=>$v){
            if ($parent_id==$v['parent_id']){
                $v['level']=$level;
                $arr[]=$v;
                $this->info($data,$v['sort_id'],$level+1);
            }
        }
        return $arr;
    }


    

    public function delete(Request $request,$id){
        $data = ShopModel::findorFail($id);
        // dd($data);exit;
        $bool = $data->delete();
        // dd($bool);exit;
        if($bool){
            session()->flash('shop',"删除成功,id为".$id);
            return redirect('shop/index');
        }
   }


    public function edit(Request $request,$id){
        $data = ShopModel::findorFail($id);
        $brand_model=new BrandModel();
        $sort_model=new SortModel();
        $brand_info=$brand_model->all()->toArray();
        $sort_info=$sort_model->all()->toArray();
        $sort_info=self::info($sort_info);
        return view("admin.shop._save",['data'=>$data,"sort_info"=>$sort_info,"brand_info"=>$brand_info]);
   }

  public function update(Request $request,$id){
        $data = ShopModel::findorFail($id);
                $data->shop_name = $request->shop_name;
                $data->shop_price = $request->shop_price;
                $data->is_new = $request->is_new;
               $data->is_up = $request->is_up;
               $data->is_hot = $request->is_hot;
               $data->is_besc = $request->is_besc;
                $data->goods_desc = $request->goods_desc;
                $data->brand_id = $request->brand_id;
                $data->sort_id = $request->sort_id;
            $bool = $data->save();
            if($bool){
                session()->flash('shop',"更新成功,用户id为".$id);
                return redirect('shop/index');
            }

            return redirect()->back();
  }


}
