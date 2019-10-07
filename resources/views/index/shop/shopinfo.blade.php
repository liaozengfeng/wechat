@extends("index.layout.layout")
@section("title")
    首页
@endsection
@section("content")
    <div class="weui-content">
        <!--产品详情-->
        <div class="weui-tab">
            <div class="weui-navbar" style="position:fixed; top:0; left:0; right:0; height:44px;">
                <a class="weui-navbar__item proinfo-tab-tit weui-bar__item--on" href="#tab1">商品</a>
                <a class="weui-navbar__item proinfo-tab-tit" href="#tab2">详情</a>
                <a class="weui-navbar__item proinfo-tab-tit" href="#tab3">评价</a>
            </div>
            <div class="weui-tab__bd proinfo-tab-con">
                <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
                    <!--主图轮播-->
                    <div class="swiper-container swiper-zhutu">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="
                             @if($list->shop_id>214)
                                {{ asset('storage/'.$list->shop_img) }}
                                @else
                                {{ $list->shop_img }}
                                @endif
                                        " /></div>
                            <div class="swiper-slide"><img src="/images/zhutu02.jpg" /></div>
                            <div class="swiper-slide"><img src="/images/zhutu03.jpg" /></div>
                            <div class="swiper-slide"><img src="/images/zhutu04.jpg" /></div>
                            <div class="swiper-slide"><img src="/images/zhutu05.jpg" /></div>
                        </div>
                        <div class="swiper-pagination swiper-zhutu-pagination"></div>
                    </div>
                    <div class="wy-media-box-nomg weui-media-box_text">
                        <h4 class="wy-media-box__title">{{ $list->shop_name }}</h4>
                        <div class="wy-pro-pri mg-tb-5">¥<em class="num font-20 price">{{ $list->shop_price }}</em></div>
                        <p class="weui-media-box__desc">【2017春季全场2件8】春款薄绒休闲套头纯色印花连帽大码卫衣套装新款上新！！</p>
                    </div>
                    <div class="wy-media-box2 weui-media-box_text">
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">优惠</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-message clear">
                                    <i class="yhq"><span class="label-text">优惠券</span></i>
                                    <span class="promotion-item-text">满197.00减40.00</span>
                                </div>
                                <div class="promotion-message clear">
                                    <i class="yhq"><span class="label-text">优惠券</span></i>
                                    <span class="promotion-item-text">满197.00减40.00</span>
                                </div>
                                <div class="yhq-btn clear"><a href="yhq_list.html">去领券</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="wy-media-box2 weui-media-box_text">
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">尺码</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-sku clear">
                                    <ul>
                                        <li><a href="javascript:;">25</a></li>
                                        <li><a href="javascript:;">30</a></li>
                                        <li><a href="javascript:;">34</a></li>
                                        <li><a href="javascript:;">40</a></li>
                                        <li><a href="javascript:;">45</a></li>
                                        <li><a href="javascript:;">50</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">颜色</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-sku clear">
                                    <ul>
                                        <li><a href="javascript:;">黑色</a></li>
                                        <li><a href="javascript:;">红色</a></li>
                                        <li><a href="javascript:;">白色</a></li>
                                        <li><a href="javascript:;">蓝色</a></li>
                                        <li><a href="javascript:;">橘黄色</a></li>
                                        <li><a href="javascript:;">绿色</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wy-media-box2 txtpd weui-media-box_text">
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">送至</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-message clear">
                                    <span class="promotion-item-text">江苏</span>
                                    <span class="promotion-item-text">宿迁</span>
                                    <span class="promotion-item-text">洋河新区</span>
                                </div>
                            </div>
                        </div>
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">运费</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-message clear">
                                    <span class="promotion-item-text">免运费<!--<div class="wy-pro-pri">¥<span class="num">11.00</span></div>--></span>
                                </div>
                            </div>
                        </div>
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">商家</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-message clear">
                                    <span class="promotion-item-text">蓝之蓝股份有限公司</span>
                                </div>
                            </div>
                        </div>
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">提示</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-message clear">
                                    <span class="promotion-item-text"><p class="txt-color-ml">支持7天无理由退换货</p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="weui-tab__bd-item ">
                    <div class="pro-detail">
                        {!! $list->goods_desc !!}
                    </div>
                </div>
                <div id="tab3" class="weui-tab__bd-item">
                    <!--评价-->
                    <div class="weui-panel__bd">
                        <div class="wy-media-box weui-media-box_text">
                            <div class="weui-cell nopd weui-cell_access">
                                <div class="weui-cell__hd"><img src="/images/headimg.jpg" alt="" style="width:20px;margin-right:5px;display:block"></div>
                                <div class="weui-cell__bd weui-cell_primary"><p>飞翔的小土豆</p></div>
                                <span class="weui-cell__time">2017-02-06</span>
                            </div>
                            <div class="comment-item-star"><span class="real-star comment-stars-width5"></span></div>
                            <p class="weui-media-box__desc">面料不错，码数也正常  男朋友穿的很合适。</p>
                            <ul class="weui-uploader__files clear mg-com-img">
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="weui-panel__bd">
                        <div class="wy-media-box weui-media-box_text">
                            <div class="weui-cell nopd weui-cell_access">
                                <div class="weui-cell__hd"><img src="/images/headimg.jpg" alt="" style="width:20px;margin-right:5px;display:block"></div>
                                <div class="weui-cell__bd weui-cell_primary"><p>爱情海的事故</p></div>
                                <span class="weui-cell__time">2017-02-06</span>
                            </div>
                            <div class="comment-item-star"><span class="real-star comment-stars-width3"></span></div>
                            <p class="weui-media-box__desc">面料不错，码数也正常  男朋友面料不错，码数也正常  男朋友穿的面料不错，码数也正常  男朋友穿的穿的很合适。</p>
                            <ul class="weui-uploader__files clear mg-com-img">
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="weui-panel__bd">
                        <div class="wy-media-box weui-media-box_text">
                            <div class="weui-cell nopd weui-cell_access">
                                <div class="weui-cell__hd"><img src="/images/headimg.jpg" alt="" style="width:20px;margin-right:5px;display:block"></div>
                                <div class="weui-cell__bd weui-cell_primary"><p>爱情海的事故</p></div>
                                <span class="weui-cell__time">2017-02-06</span>
                            </div>
                            <div class="comment-item-star"><span class="real-star comment-stars-width3"></span></div>
                            <p class="weui-media-box__desc">面料不错，码数也正常  男朋友面料不错，码数也正常  男朋友穿的面料不错，码数也正常  男朋友穿的穿的很合适。</p>
                            <ul class="weui-uploader__files clear mg-com-img">
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="weui-panel__bd">
                        <div class="wy-media-box weui-media-box_text">
                            <div class="weui-cell nopd weui-cell_access">
                                <div class="weui-cell__hd"><img src="/images/headimg.jpg" alt="" style="width:20px;margin-right:5px;display:block"></div>
                                <div class="weui-cell__bd weui-cell_primary"><p>爱情海的事故</p></div>
                                <span class="weui-cell__time">2017-02-06</span>
                            </div>
                            <div class="comment-item-star"><span class="real-star comment-stars-width3"></span></div>
                            <p class="weui-media-box__desc">面料不错，码数也正常  男朋友面料不错，码数也正常  男朋友穿的面料不错，码数也正常  男朋友穿的穿的很合适。</p>
                            <ul class="weui-uploader__files clear mg-com-img">
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)" onclick="window.location.reload('gallery.html')"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/ban2.jpg)" onclick="window.location.reload('gallery.html')"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)" onclick="window.location.reload('gallery.html')"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="weui-panel__bd">
                        <div class="wy-media-box weui-media-box_text">
                            <div class="weui-cell nopd weui-cell_access">
                                <div class="weui-cell__hd"><img src="/images/headimg.jpg" alt="" style="width:20px;margin-right:5px;display:block"></div>
                                <div class="weui-cell__bd weui-cell_primary"><p>爱情海的事故</p></div>
                                <span class="weui-cell__time">2017-02-06</span>
                            </div>
                            <div class="comment-item-star"><span class="real-star comment-stars-width3"></span></div>
                            <p class="weui-media-box__desc">面料不错，码数也正常  男朋友面料不错，码数也正常  男朋友穿的面料不错，码数也正常  男朋友穿的穿的很合适。</p>
                            <ul class="weui-uploader__files clear mg-com-img">
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                                <li class="weui-uploader__file" style="background-image:url(.//images/pro3.jpg)"></li>
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="weui-cell weui-cell_access weui-cell_link list-more">
                        <div class="weui-cell__bd">查看更多</div>
                        <span class="weui-cell__ft"></span>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <span id="tophovertree" title="返回顶部"></span>
    <!--底部导航-->
    <div class="foot-black"></div>
    <div class="weui-tabbar wy-foot-menu">
        <a href="javascript:;" class="promotion-foot-menu-items">
            <div class="weui-tabbar__icon promotion-foot-menu-kefu"></div>
            <p class="weui-tabbar__label">客服</p>
        </a>
        <a href="javascript:;" id='show-toast' class="promotion-foot-menu-items" shop_id="{{$list->shop_id}}">
            <div class="weui-tabbar__icon promotion-foot-menu-collection"></div>
            <p class="weui-tabbar__label ">收藏</p>
        </a>
        <a href="/index/shopcart" class="promotion-foot-menu-items">
            <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>
            <div class="weui-tabbar__icon promotion-foot-menu-cart"></div>
            <p class="weui-tabbar__label">购物车</p>
        </a>
        <a href="javascript:;" class="weui-tabbar__item yellow-color open-popup" data-target="#join_cart">
            <p class="promotion-foot-menu-label" id="button" shop_id="{{ $list->shop_id }}">加入购物车</p>
        </a>
        <a href="javascript:;" class="weui-tabbar__item red-color open-popup" data-target="#selcet_sku">
            <p class="promotion-foot-menu-label" >立即购买</p>
        </a>
    </div>

    <div id="selcet_sku" class='weui-popup__container popup-bottom' style="z-index:600;">
        <div class="weui-popup__overlay" style="opacity:1;"></div>
        <div class="weui-popup__modal">
            <div class="toolbar">
                <div class="toolbar-inner">
                    <a href="javascript:;" class="picker-button close-popup">关闭</a>
                    <h1 class="title">商品属性</h1>
                </div>
            </div>
            <div class="modal-content">
                <div class="weui-msg" style="padding-top:0;">
                    <div class="wy-media-box2 weui-media-box_text" style="margin:0;">
                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">尺码</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-sku clear">
                                    <ul>
                                        <li><a href="javascript:;">25</a></li>
                                        <li><a href="javascript:;">30</a></li>
                                        <li><a href="javascript:;">34</a></li>
                                        <li><a href="javascript:;">40</a></li>
                                        <li><a href="javascript:;">45</a></li>
                                        <li><a href="javascript:;">50</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="weui-media-box_appmsg">
                            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">颜色</span></div>
                            <div class="weui-media-box__bd">
                                <div class="promotion-sku clear">
                                    <ul>
                                        <li><a href="javascript:;">黑色</a></li>
                                        <li><a href="javascript:;">红色</a></li>
                                        <li><a href="javascript:;">白色</a></li>
                                        <li><a href="javascript:;">蓝色</a></li>
                                        <li><a href="javascript:;">橘黄色</a></li>
                                        <li><a href="javascript:;">绿色</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="weui-msg__opr-area">
                        <p class="weui-btn-area">
                            <a href="/index/order?id={{ $list->shop_id }}" class="weui-btn weui-btn_primary">立即购买</a>
                            <a href="javascript:;" class="weui-btn weui-btn_default close-popup">不，我再看看</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script>
//收藏
$(document).on('click','#show-toast',function(){

    _this = $(this);
     var shop_id = _this.attr('shop_id');
     $.get(
            "/index/shoucang",
            {shop_id:shop_id},
            function(res){
                if (res==1) {
                    location.href="/index/user/usercollect";
                }
            }
        );
})
//加入购物车
$(document).on('click','#button',function(){
    var shop_id=$(this).attr('shop_id');
    var shop_price=$('.price').text();
    $.ajax({
        url:"/index/shopsave",
        type:"get",
        dataType:'json',
        data:{shop_id:shop_id,shop_price:shop_price},
        success:function(res){
            if(res.code==1){
                alert(res.fout);
                location.href="/index/shopcart";
            }else if(res.code==2){
                alert(res.fout);
            }
        }
    });
})
</script>
@endsection