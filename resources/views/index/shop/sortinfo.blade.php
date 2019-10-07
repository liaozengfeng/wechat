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