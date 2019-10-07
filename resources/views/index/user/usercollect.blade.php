@extends("index.layout.shop")
@section("title")
    首页
@endsection
@section("content")
@foreach($shopinfo as $k=>$v)
<div class="weui-content">
    <div class='proListWrap'>
        <div class="pro-items">
            <div class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd"><a href="/index/shopinfo?id={{ $v['shop_id'] }}"><img class="weui-media-box__thumb" src="{{$v['shop_img']}}" alt=""></a></div>
                <div class="weui-media-box__bd">
                    <h1 class="weui-media-box__desc"><a href="/index/shopinfo?id={{ $v['shop_id'] }}" class="ord-pro-link">{{$v['shop_name']}}</a></h1>
                    <div class="wy-pro-pri">¥<em class="num font-15">{{$v['shop_price']}}</em></div>
                    <ul class="weui-media-box__info prolist-ul">
                        <li class="weui-media-box__info__meta"><a href="/index/user/userdelete?id={{ $v['shop_id']}}" shop_id="{{$v['shop_id']}}" class="wy-dele"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection