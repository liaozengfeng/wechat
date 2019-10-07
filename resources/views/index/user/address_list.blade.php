@extends("index.layout.shop")
@section("title")
    首页
@endsection
@section("content")
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">地址管理</div>
</header>
<div class="weui-content">
    <div class="weui-panel address-box">
        <div class="weui-panel__bd">
        @foreach($all as $v)
            <div class="weui-media-box weui-media-box_text address-list-box">
                <a href="/index/address_update?address_id=<?php echo $v->address_id?>" class="address-edit"></a>
                <h4 class="weui-media-box__title"><span>{{ $v->consignee }}</span> <span>{{ $v->mobile }}</span></h4>
                <p class="weui-media-box__desc address-txt">{{ $v->province }} {{ $v->city }} {{ $v->district }} </p>
                <p class="weui-media-box__desc address-txt">{{ $v->address }}</p>
                @if($v->is_checked==2)
                    <a href="JavaScript:;"><span class="default-add">默认地址</span></a>
                @else
                    <a href="/index/address_checked?id={{ $v->address_id }}" class="default-add">未默认</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" href="/index/area" id="showTooltips">添加收货地址</a>
    </div>
</div>
@endsection