<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginModel;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\SortModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use function Symfony\Component\Console\Tests\Command\createClosure;

class BrandController extends Controller
{

    public function index(Request $request)
    {

        $da= new BrandModel;
        $list= $da->paginate(3);
        return view('Admin.brand.index',['list'=>$list]);

    }

    public function save(Request $request){


        if($request->isMethod('POST')){
            
             $request->validate(
                    [
                        'brand_name'=>'required',
                        'brand_url'=>'required',
                    ],
                    [
                        "required"=>":attribute 不能为空",
                    ],
                    [
                        'brand_name'=>'品牌名称',
                        'brand_url'=>'品牌路径',
                    ]);



            $path = $request->file('brand_logo')->store('image');

            $data= $request->all(); 

            $data['brand_logo']=$path;
            
            $data = BrandModel::create($data);
            
            if($data){
                session()->flash('brand',"添加成功,用户id为".$data->brand_id);
                return redirect('brand/index');
            }
        }
         return view('Admin.brand._save');
    }


     public function delete(Request $request,$id){
        $data = BrandModel::findorFail($id);
        // dd($data);exit;
        $bool = $data->delete();
        //dd($bool);exit;
        if($bool){
            session()->flash('brand',"删除成功,id为".$id);
            return redirect('brand/index');
        }
   }


    public function edit(Request $request,$id){
        $data = BrandModel::findorFail($id);
        
        return view('Admin.brand._save',['data'=>$data]);
    }

    public function update(Request $request,$id){
            $data = BrandModel::findorFail($id);
        
            $request->validate(
                    [
                        'brand_name'=>'required',
                        'brand_url'=>'required',
                    ],
                    [
                        "required"=>":attribute 不能为空",
                    ],
                    [
                        'brand_name'=>'品牌名称',
                        'brand_url'=>'品牌路径',
                    ]);

            $data->brand_name = $request->brand_name;
            $data->brand_url = $request->brand_url;
            $data->brand_show = $request->brand_show; 

            $bool = $data->save();
            if($bool){
                session()->flash('brand',"更新成功,用户id为".$id);
                return redirect('brand/index');
            } 
             return view('Admin.brand._save');
    }
}
