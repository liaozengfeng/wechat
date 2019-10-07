@extends("index.layout.shop")
@section("title")
    首页
@endsection
@section("content")
<!--主体-->
<div class='weui-content'>
    <!--顶部轮播-->
    <div class="swiper-container swiper-banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="pro_info.html"><img src="/upload/ban1.jpg" /></a></div>
            <div class="swiper-slide"><a href="pro_list.html"><img src="/upload/ban2.jpg" /></a></div>
            <div class="swiper-slide"><a href="pro_info.html"><img src="/upload/ban3.jpg" /></a></div>
            <div class="swiper-slide"><a href="pro_list.html"><img src="/upload/ban4.jpg" /></a></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!--图标分类-->
    <div class="weui-flex wy-iconlist-box">
        <div class="weui-flex__item"><a href="/index/brand" class="wy-links-iconlist"><div class="img"><img src="/images/icon-link1.png"></div><p>精选推荐</p></a></div>
        <div class="weui-flex__item"><a href="javascript:;" class="wy-links-iconlist tnp"><div class="img"><img src="/images/icon-link2.png"></div><p>酒水专场</p></a></div>
        <div class="weui-flex__item"><a href="/index/order_list" class="wy-links-iconlist"><div class="img"><img src="/images/icon-link3.png"></div><p>订单管理</p></a></div>
        <div class="weui-flex__item"><a href="javascript:;" class="wy-links-iconlist tnp"><div class="img"><img src="/images/icon-link4.png"></div><p>商家入驻</p></a></div>
    </div>
    <!--新闻切换-->
    <div class="wy-ind-news">
        <i class="news-icon-laba"></i>
        <div class="swiper-container swiper-news">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="news_info.html">热烈祝贺伟义商城成功热烈祝贺伟义商城成功上线热烈祝贺伟义商城成功上线上线</a></div>
                <div class="swiper-slide"><a href="news_info.html">蓝之蓝股份成公司上市</a></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <a href="news_list.html" class="newsmore"><i class="news-icon-more"></i></a>
    </div>
    <!--精选推荐-->
    <div class="wy-Module">
        <div class="wy-Module-tit"><span>精选推荐</span></div>
        <div class="wy-Module-con">
            <div class="swiper-container swiper-jingxuan" style="padding-top:34px;">
                <div class="swiper-wrapper">
                    @foreach($list as $v)
                        <div class="swiper-slide"><a href="/index/shopinfo?id={{ $v->shop_id }}"><img src="
                            @if($v->shop_id>214)
                                    {{ asset('storage/'.$v->shop_img) }}
                                @else
                                    {{ $v->shop_img }}
                                @endif
                      " /></a></div>
                    @endforeach
                </div>
                <div class="swiper-pagination jingxuan-pagination"></div>
            </div>
        </div>
    </div>
    <!--酒水专场-->
    <div class="wy-Module">
        <div class="wy-Module-tit"><span>品牌推荐</span></div>
        <div class="wy-Module-con">
            <div class="swiper-container swiper-jiushui" style="padding-top:34px;">
                <div class="swiper-wrapper">
                    @foreach($info as $v)
                        <div class="swiper-slide"><a href="/index/brand?id={{ $v->brand_id }}"><img src="
                            @if($v->brand_id>50)
                                {{ asset('storage/'.$v->brand_logo) }}
                                @else
                                {{ $v->brand_logo }}
                                @endif
                    " /></a></div>
                    @endforeach
                </div>
                <div class="swiper-pagination jingxuan-pagination"></div>
            </div>
        </div>
    </div>
    <!--猜你喜欢-->
    <div class="wy-Module">
        <div class="wy-Module-tit-line"><span>猜你喜欢</span></div>
        <div class="wy-Module-con">
            <ul class="wy-pro-list clear" sort_id="{{ $f }}">
                @foreach($data as $v)
                    <li>
                        <a href="/index/shopinfo?id={{ $v['shop_id'] }}">
                            <div class="proimg"><img src="
                               @if($v['shop_id']>214)
                                        {{ asset('storage/'.$v['shop_img']) }}
                                    @else
                                        {{ $v['shop_img'] }}
                                    @endif
                        "></div>
                            <div class="protxt">
                                <div class="name">{{ $v['shop_name'] }}</div>
                                <div class="wy-pro-pri">¥<span>{{ $v['shop_price'] }}</span></div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="morelinks"><a href="javascript:;" id="sort_info">查看更多 >></a></div>
        </div>
    </div>
</div>
<script src="/js/jquery-2.1.4.js"></script>
<script>
    //楼层
    $(document).on("click","#sort_info",function () {
        var id=$(this).parent("div").prev("ul[class='wy-pro-list clear']").attr("sort_id");
        var _this=$(this);
        $.get(
            "/index/sortinfo",
            "id="+id,
            function (res) {
               _this.parent("div").before().html(res);
            }
        )
    })

    $(document).on("click",".tnp",function () {
        alert("暂未开放\n Temporarily not prescribing");
    })
</script>
@endsection