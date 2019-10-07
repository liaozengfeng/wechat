<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoginModel;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\SortModel;
use App\Models\AdminModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class AdminController extends Controller
{

    public function index(Request $request)
    {

        $da= new AdminModel;
        $list= $da->paginate(3);
        

        return view('Admin.admin.index',['list'=>$list]);

    }
    public function save(Request $request){

                if($request->isMethod('POST')){
                        $request->validate(
                            [
                                'admin_account'=>'required|unique:admin|max:10',
                                'admin_pwd'=>'required|max:6',
                                'pwd'=>'required|same:admin_pwd',
                                'admin_email'=>'required',
                            ],
                            [
                                "required"=>":attribute 不能为空",
                                "admin_account.max"=>"不能超过最大值(10位)",
                                "admin_account.unique"=>"管理员已存在",
                                'admin_pwd.required'=>"密码不能为空",
                                "admin_pwd.max"=>"不能超过最大值(6位)",
                                'pwd.required'=>"确认密码不能为空",
                                'pwd.same'=>'密码与确认密码不匹配',
                                'admin_email.required'=>'邮箱不能为空',
                            ],
                            [
                                'admin_account'=>'用户名',
                                'admin_pwd'=>'密码',
                                'pwd'=>'确认密码',
                                'admin_email'=>'邮箱'
                            ]);
                        $data=$request->all();
                        unset($data['pwd']);
                        $data = AdminModel::create($data);
                        if($data){
                            session()->flash('admins',"添加成功,用户id为".$data->admin_id);
                            return redirect('admin/index');
                        }
                    }

                    return view('Admin.admin._save');
    }


    //删除
    public function delete(Request $request,$id){
       $data = AdminModel::findorFail($id);
       $bool = $data->delete();
      
        if($bool){
            session()->flash('admins',"删除成功,id为".$id);
            return redirect('admin/index');
        }
    }

    //修改
     public function edit(Request $request,$id){
        $data = AdminModel::findorFail($id);
        
        return view('Admin.admin._save',['data'=>$data]);
    }

     public function update(Request $request,$id){
                $data = AdminModel::findorFail($id);
                $request->validate(
                    [
                        'admin_account'=>'required|unique:admin|max:10',
                        'admin_pwd'=>'required|max:6',
                        'pwd'=>'required|same:admin_pwd',
                        'admin_email'=>'required',
                    ],
                    [
                        "required"=>":attribute 不能为空",
                        "admin_account.max"=>"不能超过最大值(10位)",
                        "admin_account.unique"=>"管理员已存在",
                        'admin_pwd.required'=>"密码不能为空",
                        "admin_pwd.max"=>"不能超过最大值(6位)",
                        'pwd.required'=>"确认密码不能为空",
                        'pwd.same'=>'密码与确认密码不匹配',
                        'admin_email.required'=>'邮箱不能为空',
                    ],
                    [
                        'admin_account'=>'用户名',
                        'admin_pwd'=>'密码',
                        'pwd'=>'确认密码',
                        'admin_email'=>'邮箱'
                    ]);

                    $data->admin_account = $request->admin_account;
                    $data->admin_pwd = $request->admin_pwd;
                    $data->admin_email = $request->admin_email;

                $bool = $data->save();
                if($bool){
                    session()->flash('admins',"更新成功,用户id为".$id);
                    return redirect('admin/index');
                } 
                 return view('Admin.admin._save');
            }

                   
    }

