<?php

namespace App\Http\Controllers\Index;
use Db;
use App\models\CollectsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\AreaModels;
use  App\Models\AddressModels;
use App\Models\ShopModel;



class UserController extends Controller
{
    public function index(Request $request){
       return view("index.user.index");
    }

    public function area(Request $request)
    {
        //获取省级
        $area = new AreaModels;
        $top = $area->where('pid',0)->get();
        return view('index.user.address_edit',['top'=>$top]);
    }

    public function getArea(Request $request)
    {
        $area = new AreaModels;
        $id = $request->get('id');
        if(!$id)
        {
            return;
        }
        $data = $area->where('pid',$id)->get()->tojson();
        echo $data;
    }
    //添加收货人
    public function addAddress(Request $request)
    {
        if($request->isMethod("POST")){
            $all = $request->except('_token');
            //获取登录用户的id
                $userinfo = session('userinfo');
                $uid = $userinfo['uid'];
                // dd($uid);
                $all['u_id'] = $uid;
            $res = AddressModels::create($all);
            if($res)
            {
                echo json_encode(['ret'=>1,'msg'=>'添加成功']);
            }else{
                echo json_encode(['ret'=>2,'msg'=>'添加失败']);

            }
        }
    }

    //收货人展示
    public function address_list(Request $request)
    {
        $AddressModels = new AddressModels();
        $area = new AreaModels;
        $all = $AddressModels->get();
        foreach($all as $k=>$v){
            $city = $v->city;
            $arr=$area->where('id',$city)->first();
            $all[$k]->city=$arr['name'];
            $province = $v->province;
            $arr=$area->where('id',$province)->first();
            $all[$k]->province=$arr['name'];
            $district = $v->district;
            $arr=$area->where('id',$district)->first();
            $all[$k]->district=$arr['name'];
        }

        return view('index.user.address_list',['all'=>$all]);

    }
    //收货人修改
    public function address_update(Request $request)
    {
        $area = new AreaModels;
        $top = $area->where('pid',0)->get();
        $address_id = $request->get('address_id');
        $res = \DB::table('address')->where('address_id',$address_id)->first();
        // dd($res);
        return view('index/user/address_update',['res'=>$res,'top'=>$top]);
    }
    //执行修改
    public function address_update_do(Request $request)
    {
        if($request->isMethod("POST")){
            $all = $request->except('_token');
            // dd($all);
            //获取登录用户的id
                $userinfo = session('userinfo');
                $uid = $userinfo['uid'];
                // dd($uid);
                $all['uid'] = $uid;
                $AddressModels = new AddressModels;
                 $res =$AddressModels->where('address_id',$all['address_id'])->update($all);
                //  dd($res);
            if($res)
            {
                echo json_encode(['ret'=>1,'msg'=>'更改成功']);
            }else{
                echo json_encode(['ret'=>2,'msg'=>'更改失败']);

            }
        }
    }
    //收件人删除
    public function brand_del(Request $request)
    {
        $hid = $request->input('hid');
        $AddressModels = new AddressModels;
        $res = AddressModels::destroy($hid);
        if($res)
        {
                 echo json_encode(['ret'=>1,'msg'=>'删除成功']);
            }else{
                echo json_encode(['ret'=>2,'msg'=>'删除失败']);

        }
    }

    //收件人修改默认
    public function address_checked(Request $request){
        //接收修改id
        $id=$request->input("id");
        //获取登录用户的id
        $userinfo = session('userinfo');
        $uid = $userinfo['uid'];
        $address_info=AddressModels::where(["is_checked"=>2,"u_id"=>$uid])->first()->toArray();
        $res=AddressModels::where("address_id",$address_info['address_id'])->update(["is_checked"=>1]);
        if ($res){
            $abc=AddressModels::where("address_id",$id)->update(["is_checked"=>2]);
            return redirect("/index/address_list");
        }
    }

    /*收藏*/
    public function shoucang(Request $request)
    {
        $Collects=new CollectsModel;
        $shop_id = $request->input('shop_id');
        // dd($shop_id);
        if (empty($request->session()->get('userinfo'))) {
            echo "请先登陆";die;
        }else{
            $u_id = $request->session()->get('userinfo');
            $u_id=$u_id['uid'];
            $data = $Collects->whereRaw("u_id = $u_id and shop_id = $shop_id")->first();
            // dd($data);
            if (!$data == "") {
                echo "商品只能收藏一件";die;
            }

            $arr = $Collects->u_id=session("userinfo")['uid'];
            $where = [
                'u_id'=>$arr,
                'shop_id'=>$shop_id,
                'is_del'=>1,
            ];
            // dd($where);
            $data = $Collects->insert($where);
            if ($data) {
                echo 1;exit;
            }
        }
    }
    /*收藏详情页*/
    public function usercollect(Request $request)
    {
        $Collects= new CollectsModel;

        $u_id = $request->session()->get('userinfo');
        $u_id=$u_id['uid'];
        // dd($u_id);
        $where[] = ['u_id','=',$u_id];
        $list = $Collects->where($where)->get()->toArray();
        $id="";
        foreach($list as $k=>$v){
            $id.=$v['shop_id'].",";
        }
        $id=substr($id,0,strlen($id)-1);
        $shop_model=new ShopModel;
        $shopinfo=$shop_model->whereRaw("shop_id in ($id)")->get()->toArray();
        if ($shopinfo) {
            return view("index.user.usercollect",['shopinfo'=>$shopinfo]);
        }else{
            return false;
        }

    }
    /*收藏删除*/
    public function userdelete(Request $request)
    {
        $id = $_GET['id'];
        // dd($id);
        $Collects=new CollectsModel;
        $u_id = $request->session()->get('userinfo');
        $u_id = $u_id['uid'];
        $data = $Collects->whereRaw("u_id = $u_id and shop_id = $id")->delete();
        if ($data) {
            return redirect('/index/user/usercollect');
        }
    }
}
