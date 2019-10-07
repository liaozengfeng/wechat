<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShopModel;
use App\Models\TrolleyModel;
use App\Models\HistoryModel;
use App\Models\CollectsModel;

class shopController extends Controller
{
    public function shopinfo(Request $request){
        $shop_id=$request->id;
        $data=ShopModel::where("shop_id",$shop_id)->first();

        //浏览记录 ---存
        if(checkLogin()){
            $history=self::saveHistoryDb($shop_id);
        }else{
            $history= self::saveHistoryCookie($shop_id);

        }
        return view("index.shop.shopinfo",['list'=>$data]);
    }
    /** 存储浏览历史记录  ---数据库 */
    static public function saveHistoryDb($shop_id){
        $u_id=session('userinfo');
        $u_id=$u_id['uid'];
        $data=['shop_id'=>$shop_id,'h_time'=>time(),'u_id'=>$u_id];
        $res=HistoryModel::create($data);
    }
    /** 存储浏览历史记录 ---cookie */
    static public function saveHistoryCookie($shop_id){
//        //把cookie的值取出来
//        $data=cookie('data');
//
//        if(!empty($data)){
//            $data= json_decode($data);
//            $data[]=['shop_id'=>$shop_id,'h_time'=>time()];
//        }else{
//            $data= json_decode($data);
//            $data[]=['shop_id'=>$shop_id,'h_time'=>time()];
//        }
////        var_dump($data);exit;
//        \Cookie::make('data',$data);
    }


    /** 浏览历史 */
    public function history(){
        //获取浏览历史记录信息
        if(checkLogin()){
            $historyInfo=self::getHistoryInfoDb();
        }else{
            $historyInfo=self::getHistoryInfoCookie();
        }

        return view('index.user.history',['historyInfo'=>$historyInfo]);
    }
    /** 获取浏览历史记录信息----数据库 */
    public function getHistoryInfoDb(){
        $u_id=session('userinfo');
        $u_id=$u_id['uid'];
        $history=HistoryModel::where("u_id",$u_id)->get()->toArray();
        if(count($history)<=0){
            return false;
        }
        $where=[
            ['u_id','=',$u_id]
        ];
        $shop_id=HistoryModel::where($where)->orderBy('h_time','desc')->get()->toArray();
        foreach ($shop_id as $k=>$v){
            $shopid[]=$v['shop_id'];
        }
        //去重
        $shop_id=array_unique($shopid);
        if(!empty($shop_id)){
            $shop=array_slice($shop_id,0,5);

            //在商品表中 根据商品id查询商品数据
            $historyInfo=self::getHistoryInfo($shop);
            return $historyInfo;
        }
    }
    /**获取浏览历史记录信息 ---cookie */
    public function getHistoryInfoCookie(){

    }
    /** 获取浏览的商品数据 */
    static public function getHistoryInfo($shop_id){
        $shop_id=implode(',',$shop_id);
//        dump($shop_id);exit;
//        $shop_id=substr($shop_id,1,strlen($shop_id)-1);


        $historyInfo=ShopModel::whereRaw("shop_id in ($shop_id)")->get()->toArray();
        if(!empty($historyInfo)){
            return $historyInfo;
        }else{
            return false;
        }
    }
    public function delete(Request $request){
        $u_id=session('userinfo');
        $u_id=$u_id['uid'];
        $shop_id=$request->shop_id;
        $res=HistoryModel::whereRaw("shop_id in ($shop_id) and u_id=$u_id")->delete();

        if($res){
            return redirect('/index/history');
        }else{
            return "<script>alert(删除失败)</script>";
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


    public function shopcart(Request $request){
        if(empty($request->session()->get("userinfo"))){
            //qucookie
            return redirect("/index/login");
        }else{
            //qu数据库
            $cartInfo=$this->cartlist();
        }

        return view("index.shop.shopcart", ["list" => $cartInfo]);
    }
    //加入购物车
    public function shopsave(Request $request){
        $shop_price= $request->input('shop_price');
        $shop_id= $request->input('shop_id');

        if(empty($request->session()->get("userinfo"))){
            //存cookie
            echo 111;die;
        }else{
            //存数据库
            return $result=$this->savecart($shop_price,$shop_id);
        }

        echo json_encode($result);

    }
    //存数据库
    public function savecart($shop_price,$shop_id){
        // dd($shop_price);
        // dd($shop_id);
        $user_id=session()->get("userinfo");
        $data=[
            'u_id'=>$user_id->uid,
            'shop_id'=>$shop_id,
            'shop_price'=>$shop_price
        ];
        //添加
        // dd($data);
        $res=TrolleyModel::create($data);
        if($res){
            return['fout'=>'成功加入购物车','code'=>1];
        }else{
            return['fout'=>'加入购物车失败','code'=>2];
        }
    }
    //从数据库中取
    public function cartlist(){
        $user_id=session()->get("userinfo");
        // $where=[
        //     ['u_id','=',$user_id],
        //         ];
        $user_id=$user_id['uid'];
        $ShopModel=new ShopModel;
        $TrolleyModel=new TrolleyModel;
        $cartInfo=$TrolleyModel
            ->Join('shop','trolley.shop_id',"=",'shop.shop_id')
            ->where('u_id',$user_id)
            ->get();

        if(!empty($cartInfo)){
            return $cartInfo;
        }else{
            return false;
        }
    }
    public function getTotal(Request $request){
        $shop_id= $request->input('shop_id');
        if(empty($shop_id)){
            echo 0;exit;
        }
        if(empty($request->session()->get("userinfo"))){
            //从cookie获取
            echo 22;die;

        }else{
            //从数据库获取
            $tatol=$this->getTotalDB($shop_id);
        }
        echo $tatol;
    }
    //从数据库获取总价
    public function getTotalDB($shop_id){
        $user_id=session()->get("userinfo");
        $ShopModel=new ShopModel;
        $TrolleyModel=new TrolleyModel;
        $cartInfo=$TrolleyModel->select('shop_price')->whereRaw("shop_id in ($shop_id)")->get()->toArray();
        $tatol=0;
        foreach ($cartInfo as $k => $v) {
            $tatol+=$v['shop_price'];
        }
        return $tatol;
    }
    public function cart_delete(Request $request){
        $shop_id= $request->input('shop_id');
        $TrolleyModel=new TrolleyModel;
        $res=$TrolleyModel->whereRaw("shop_id in ($shop_id)")->delete();
        if($res){
            return['fout'=>'删除成功','code'=>1];
        }else{
            return['fout'=>'删除失败','code'=>2];
        }
        echo json_encode($res);
    }
}
