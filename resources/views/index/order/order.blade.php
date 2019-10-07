@extends("index.layout.shop")
@section("title")
    首页
@endsection
@section("content")
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">订单详情</div>
</header>
<div class="weui-content">
    <div class="wy-media-box weui-media-box_text address-select" address_id="{{ $address->address_id }}">
        <div class="weui-media-box_appmsg">
            <div class="weui-media-box__hd proinfo-txt-l" style="width:20px;"><span class="promotion-label-tit"><img src="/images/icon_nav_city.png" /></span></div>
            <div class="weui-media-box__bd">
                <a href="address_list.html" class="weui-cell_access">
                    <h4 class="address-name"><span>{{ $address->consignee }}</span><span>{{ $address->mobile }}</span></h4>
                    <div class="address-txt">{{ $address->province }} {{ $address->city }} {{ $address->district }}  {{ $address->address }}</div>
                </a>
            </div>
            <div class="weui-media-box__hd proinfo-txt-l" style="width:16px;">
                <a href="/index/address_list"><div class="weui-cell_access"><span class="weui-cell__ft"></span></a></div>
            </div>
        </div>
    </div>
    <div class="wy-media-box weui-media-box_text">
        @foreach($shop_info as $v)
            <div class="weui-media-box__bd shop_id" shop_id="{{ $v['shop_id'] }}">
            <div class="weui-media-box_appmsg ord-pro-list">
                <div class="weui-media-box__hd"><a href="/index/shopinfo?id={{ $v['shop_id'] }}"><img class="weui-media-box__thumb" src="
                     @if($v['shop_id']>214)
                            {{ asset('storage/'.$v['shop_img']) }}
                        @else
                            {{ $v['shop_img'] }}
                        @endif
                " alt=""></a></div>
                <div class="weui-media-box__bd">
                    <h1 class="weui-media-box__desc"><a href="pro_info.html" class="ord-pro-link">{{ $v['shop_name'] }}</a></h1>
                    <p class="weui-media-box__desc">规格：<span>红色</span>，<span>23</span></p>
                    <div class="clear mg-t-10">
                        <div class="wy-pro-pri fl">¥<em class="num font-15">{{ $v['shop_price'] }}</em></div>
                        <div class="pro-amount fr"><span class="font-13">数量×<em class="name">1</em></span></div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="weui-panel">
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_small-appmsg">
                <div class="weui-cells">
                    <div class="weui-cell weui-cell_access">
                        <div class="weui-cell__bd weui-cell_primary">
                            <p class="font-14"><span class="mg-r-10">配送方式</span><span class="fr">快递</span></p>
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_access" href="javascript:;">
                        <div class="weui-cell__bd weui-cell_primary">
                            <p class="font-14"><span class="mg-r-10">运费</span><span class="fr txt-color-red">￥<em class="num">10.00</em></span></p>
                        </div>
                    </div>
                    <a class="weui-cell weui-cell_access" href="money.html">
                        <div class="weui-cell__bd weui-cell_primary">
                            <p class="font-14"><span class="mg-r-10">可用蓝豆</span><span class="sitem-tip"><em class="num">1235</em>个</span></p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    <a class="weui-cell weui-cell_access" href="coupon.html">
                        <div class="weui-cell__bd weui-cell_primary">
                            <p class="font-14"><span class="mg-r-10">优惠券</span><span class="sitem-tip"><em class="num">0</em>张可用</span></p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="wy-media-box weui-media-box_text">
        <div class="mg10-0 t-c">总金额：<span class="wy-pro-pri mg-tb-5">¥<em class="num font-20" id="price">{{ $shop_price_sum }}</em></span></div>
        <div class="mg10-0"><a href="javascript:;" id="pay" class="weui-btn weui-btn_primary">支付宝付款</a></div>
    </div>
    <script>
        $(function () {
            $(document).on("click","#pay",function () {
                var address_id=$(".address-select").attr("address_id");
                var shopid=$(".shop_id");
                var shop_id="";
                var price=$("#price").text();
                shopid.each(function (index) {
                    shop_id+=$(this).attr("shop_id")+",";
                })
                shop_id=shop_id.substr(0,shop_id.length-1);
                $.get(
                    "/index/order_info",
                    "shop_id="+shop_id+"&address_id="+address_id,
                    function (res) {
                        if(res=="添加失败"){
                            alert("添加失败");
                        }else{
                            location.href="/index/pay?order_price="+price+"&order_sn="+res;
                        }
                    }
                )
            })
        })
    </script>
@endsection