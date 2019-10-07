@extends("index.layout.shop")
@section("title")
    订单列表
@endsection
@section("content")
    <header class="wy-header" style="position:fixed; top:0; left:0; right:0; z-index:200;">
        <div class="wy-header-icon-back"><span></span></div>
        <div class="wy-header-title">订单管理</div>
    </header>
    <div class='weui-content'>
        <div class="weui-tab">
            <div class="weui-navbar" style="position:fixed; top:44px; left:0; right:0; height:44px; background:#fff;">
                <a class="weui-navbar__item proinfo-tab-tit font-14 weui-bar__item--on" href="#tab1">全部</a>
                <a class="weui-navbar__item proinfo-tab-tit font-14" href="#tab2">待付款</a>
                <a class="weui-navbar__item proinfo-tab-tit font-14" href="#tab3">待发货</a>
                <a class="weui-navbar__item proinfo-tab-tit font-14" href="#tab4">待收货</a>
                <a class="weui-navbar__item proinfo-tab-tit font-14" href="#tab5">待评价</a>
            </div>
            <div class="weui-tab__bd proinfo-tab-con" style="padding-top:87px;">
                <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
                    @foreach($info as $k=>$v)
                        <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__hd">
                            <span>单号：<a href="javascript:;" class="order_sn" style="color: red">{{ $v['order_sn'] }}</a></span>
                            <span class="ord-status-txt-ts fr">
                                @if($v['pay_status']==1)
                                    已提交订单
                                @elseif($v['pay_status']==2)
                                    已付款
                                @else
                                    已完成
                                @endif
                            </span>
                        </div>
                        <div class="weui-media-box__bd  pd-10">
                            @foreach($info[$k]['shop_info'] as $key=>$val)
                                <div class="weui-media-box_appmsg ord-pro-list">
                                <div class="weui-media-box__hd"><a href="/index/shopinfo?id={{ $val['shop_id'] }}">
                                        <img class="weui-media-box__thumb" src="
                                       @if($val['shop_id']>214)
                                                {{ asset('storage/'.$val['shop_img']) }}
                                            @else
                                                {{ $val['shop_img'] }}
                                            @endif
                                        " alt="">
                                    </a>
                                </div>
                                <div class="weui-media-box__bd">
                                    <h1 class="weui-media-box__desc"><a href="/index/shopinfo?id={{ $val['shop_id'] }}" class="ord-pro-link">{{ $val['shop_name'] }}</a></h1>
                                    <p class="weui-media-box__desc">规格：<span>红色</span>，<span>23</span></p>
                                    <div class="clear mg-t-10">
                                        <div class="wy-pro-pri fl">¥<em class="num font-15">{{ $val['shop_price'] }}</em></div>
                                        <div class="pro-amount fr"><span class="font-13">数量×<em class="name">1</em></span></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="ord-statistics">
                            <span>共<em class="num">{{ $v['count'] }}</em>件商品，</span>
                            <span class="wy-pro-pri">总金额：¥<em class="num font-15"><a href="javascript:;" class="price" style="color: red">{{ $v['price'] }}</a></em></span>
                            <span>(含运费<b>￥0.00</b>)</span>
                        </div>
                        <div class="weui-panel__ft">
                            <div class="weui-cell weui-cell_access weui-cell_link oder-opt-btnbox">
                                @if($v['pay_status']==1)
                                    <a href="javascript:;" class="ords-btn-com amount">去付款</a>
                                @elseif($v['pay_status']==2)
                                    <a href="javascript:;" class="ords-btn-com">待发货</a>
                                @else
                                    <a href="javascript:;" class="ords-btn-com">评价</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
    <script src="/js/jquery-2.1.4.js"></script>
    <script>
        $(function () {
            $(document).on("click",".amount",function () {
                var order_sn=$(this).parents("div").prevAll("div[class='weui-panel__hd']").find("a[class='order_sn']").text();
                var order_price=$(this).parents("div[class='weui-panel__ft']").prev("div[class='ord-statistics']").find("a[class='price']").text();
                location.href="/index/pay?oredr_sn="+order_sn+"&order_price="+order_price;
            })
        })
    </script>
@endsection