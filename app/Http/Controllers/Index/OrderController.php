<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Models\ShopModel;
use App\Models\BrandModel;
use App\Models\UserModels;
use App\Models\SortModel;
use App\Models\TrolleyModel;
use App\Models\OrderInfoModel;
use App\Models\OrderShopModel;
use App\Models\AddressModels;
use App\Models\AreaModels;
use App\Http\Controllers\Controller;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;

class OrderController extends Controller
{
    public function order(Request $request){
        //得到用户id
        $uid=session("userinfo")['uid'];
        //接收商品id
        $id=$request->input("id");
        //查询商品
        $data=ShopModel::whereRaw("shop_id in ($id)")->get()->toArray();
        //调用方法计算总价
        $shop_price_sum=$this->shop_price_sum($data);
        //查询收货地址
        $address=AddressModels::whereRaw("u_id=$uid and is_checked=1")->first();
        //得到精确的地址
        $province=$address->province;
        $city=$address->city;
        $district=$address->district;
        $area_info=AreaModels::whereRaw("id=$province")->first();
        $address->province=$area_info->name;
        $area_info=AreaModels::whereRaw("id=$city")->first();
        $address->city=$area_info->name;
        $area_info=AreaModels::whereRaw("id=$district")->first();
        $address->district=$area_info->name;

        //返回视图
        return view("index.order.order",['shop_info'=>$data,"address"=>$address,"shop_price_sum"=>$shop_price_sum]);
    }
    //生成订单
    public function order_info(Request $request){
        //得到用户id
        $uid=session("userinfo")['uid'];
        //接收商品id
        $shop_id=$request->input("shop_id");
        $address_id=$request->input("address_id");
        $data=ShopModel::whereRaw("shop_id in ($shop_id)")->get()->toArray();
        $order_info['shop_amount']=$order_info['order_amount']=$this->shop_price_sum($data);
        $address=AddressModels::whereRaw("address_id",$address_id)->first()->toArray();
        $order_info["add_time"]=$order_info['pay_time']=time();
        $order_info['pay_id']=1;
        $order_info['u_id']=$uid;
        $order_info['pay_name']="支付宝";
        $order_info['tel']=$order_info['mobile']=session("userinfo")['phone'];
        $order_info['email']="916592834@qq.com";
        $order_info['zipcode']=610000;
        $order_info['consignee']=$address['consignee'];
        $order_info['order_sn']=date("YmdGHis",time()).rand(10,99);
        $order_id=\DB::table('order_info')->insertGetId($order_info);
        if ($order_id){
            $order_shop['order_id']=$order_id;
            $order_shop['user_id']=$uid;
            foreach ($data as $k=>$v){
                $order_shop['shop_id']=$v['shop_id'];
                $shop_id_info=ShopModel::where("shop_id",$v['shop_id'])->first()->toArray();
                ShopModel::where("shop_id",$v['shop_id'])->update(["shop_nums"=>$shop_id_info['shop_nums']-1]);
                $shop_ids=$v['shop_id'];
                TrolleyModel::whereRaw("u_id=$uid and shop_id=$shop_ids")->delete();
                $order_shop['add_price']=$v['shop_price'];
                $order_shop['buy_number']=1;
                $res=OrderShopModel::create($order_shop);
            }
            $order_Info=OrderInfoModel::where("order_id",$order_id)->first();
            if ($res){
                var_dump($order_Info->order_sn);exit;
            }else{
                echo "添加失败";exit;
            }
        }
    }

    //计算总价
    public function shop_price_sum($data){
        $str=0;
        foreach($data as $k=>$v){
            $str+=$v['shop_price'];
        }
        return $str;
    }

    public function pay(Request $request){
        //接收订单号
        $order_sn=$request->input("order_sn");
        //接收金额
        $order_price=$request->input("order_price");
        //函数调用 pay配置
        $config=config("pay");
        //调用pay 发生支付宝请求
        return Pay::alipay($config)->web([
            'out_trade_no' => $order_sn,
            'total_amount' => $order_price,
            'subject' => '电子商务',
        ]);
    }

    //展示订单
    public function order_list(Request $request){
        $uid=session("userinfo")['uid'];
        $pay_status=$request->input("pay_static");
        if (empty($pay_status)){
            $where="";
        }else {
            $where = "and pay_status=" . $pay_status;
        }
        $order_info=OrderInfoModel::whereRaw("u_id=$uid $where")->orderByRaw("pay_time asc")->get(['order_id',"order_sn","shop_amount","pay_status"])->toArray();
        $info=[];
        foreach ($order_info as $k=>$v){
            $id=$v['order_id'];
            $info[]=OrderShopModel::whereRaw("user_id=$uid and order_id=$id")->get(['shop_id'])->toArray();
        }
        foreach ($info as $k=>$v){
            $shop_id="";
            foreach($v as $kk=>$vv){
                $shop_id.=$vv['shop_id'].",";
            }
            $shop_id=substr($shop_id,0,strlen($shop_id)-1);
            $info[$k]['shop_info']=ShopModel::whereRaw("shop_id in ($shop_id)")->get(['shop_img',"shop_price","shop_name","shop_id"])->toArray();
            $info[$k]['price']=self::shop_price_sum($info[$k]["shop_info"]);
            $info[$k]['count']=count($info[$k]["shop_info"]);
            $info[$k]['order_sn']=$order_info[$k]['order_sn'];
            $info[$k]['pay_status']=$order_info[$k]['pay_status'];
            $info[$k]['order_id']=$order_info[$k]['order_id'];
        }
        return view("index.order.order_list",['info'=>$info]);
    }


    //同步回调
    public function alipayreturn(Request $request)
    {
        return view("index.order.confirm");
    }

    // 服务器端回调 异步回调
    public function alipaynotify()
    {
        $config=config("pay");
        $data = Pay::alipay($config)->verify();
        return $data;
    }
}
