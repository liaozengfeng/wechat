<div id="list" class='demos-content-padded proListWrap'>
    @foreach($data as $k=>$v)
        <div class="pro-items">
            <a href="/index/shopinfo?id={{ $v['shop_id'] }}" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd"><img class="weui-media-box__thumb" src="
                       @if($v['shop_id']>214)
                        {{ asset('storage/'.$v['shop_img']) }}
                    @else
                        {{ $v['shop_img'] }}
                    @endif
                            " alt=""></div>
                <div class="weui-media-box__bd">
                    <h1 class="weui-media-box__desc">{{ $v['shop_name'] }}</h1>
                    <div class="wy-pro-pri">¥<em class="num font-15">{{ $v['shop_price'] }}</em></div>
                    <ul class="weui-media-box__info prolist-ul">
                        <li class="weui-media-box__info__meta"><em class="num">0</em>条评价</li>
                        <li class="weui-media-box__info__meta"><em class="num">100%</em>好评</li>
                    </ul>
                </div>
            </a>
        </div>
    @endforeach
</div>