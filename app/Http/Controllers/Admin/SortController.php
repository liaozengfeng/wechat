<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginModel;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\SortModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class SortController extends Controller
{
    public function index(Request $request){
        $info=SortModel::paginate(5);
        if (count($info)==0){
            $data=false;
        }
        return view("admin.sort.index",['list'=>$info]);
    }

    public function save(Request $request){

        if($request->isMethod('POST')){
            $data = SortModel::create($request->all());
            
            if($data){
                session()->flash('sort',"添加成功,id为".$data->sort_id);
                return redirect('sort/index');
            }
            
        }
        $sort_model=new SortModel();
        $sort_info=$sort_model->all()->toArray();
        $sort_info=self::info($sort_info);
        return view("admin.sort._save",['sort_info'=>$sort_info]);
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

        //删除
    public function delete(Request $request,$id){
       $data = SortModel::findorFail($id);
       $bool = $data->delete();
      
        if($bool){
            session()->flash('sort',"删除成功,id为".$id);
            return redirect('sort/index');
        }
    }

    //修改
     public function edit(Request $request,$id){
        $data = SortModel::findorFail($id);
         $sort_model=new SortModel();
         $sort_info=$sort_model->all()->toArray();
         $sort_info=self::info($sort_info);
         return view("admin.sort._save",['sort_info'=>$sort_info,'data'=>$data]);
    }

     public function update(Request $request,$id){
                $data = SortModel::findorFail($id);
        
                    $data->sort_name = $request->sort_name;
                    // $data->parent_id = $request->parent_id;
                    $data->sort_show= $request->sort_show;
                    $data->sort_nav_show = $request->sort_nav_show;

                $bool = $data->save();
                if($bool){
                    session()->flash('sort',"更新成功,用户id为".$id);
                    return redirect('sort/index');
                } 
                 return view('Admin.sort._save');
            }
}
