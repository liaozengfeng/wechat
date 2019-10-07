@extends("index.layout.shop")
@section("title")
    品牌
@endsection
@section("content")
    <header class='weui-header fixed-top'>
        <div class="weui-search-bar" id="searchBar">
            <form class="weui-search-bar__form">
                <input type="hidden" name="cate_id" value="{{ $sort_id }}">
                <input type="hidden" class="shop_id">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search"></i>
                    <input type="search" class="weui-search-bar__input" id="search" placeholder="搜索您想要的商品" required>
                    <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                </div>
                <label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
                    <i class="weui-icon-search"></i>
                    <span>搜索您想要的商品</span>
                </label>
            </form>
            <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
        </div>
        <div class="pro-sort">
            <div class="weui-flex">
                <div class="weui-flex__item"><div class="placeholder NormalCss sum" field="shop_id">综合</div></div>

                <div class="weui-flex__item">
                    <div class="placeholder NormalCss snum" type="2" field="shop_nums" is_sell='1'>
                        <span>销量</span>
                        <span class="upDown">↑</span>
                    </div>
                </div>

                <div class="weui-flex__item">
                    <div class="placeholder NormalCss price" type="2" field="shop_price" is_sell='1'>
                        <span>价格</span>
                        <span class="upDown">↑</span>
                    </div>
                </div>

            </div>
        </div>
    </header>
<div id="aaa" class="weui-content" style="padding-top:85px;">
    <div id="list" class='demos-content-padded proListWrap'>
        @foreach($list as $v)
            <div class="pro-items">
                <a href="/index/shopinfo?id={{ $v->shop_id }}" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__hd"><img class="weui-media-box__thumb" src="
                       @if($v->shop_id>214)
                        {{ asset('storage/'.$v->shop_img) }}
                        @else
                        {{ $v->shop_img }}
                        @endif
                                " alt=""></div>
                    <div class="weui-media-box__bd">
                        <h1 class="weui-media-box__desc">{{ $v->shop_name }}</h1>
                        <div class="wy-pro-pri">¥<em class="num font-15">{{ $v->shop_price }}</em></div>
                        <ul class="weui-media-box__info prolist-ul">
                            <li class="weui-media-box__info__meta"><em class="num">0</em>条评价</li>
                            <li class="weui-media-box__info__meta"><em class="num">100%</em>好评</li>
                        </ul>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="weui-loadmore">
        <i class="weui-loading"></i>
        <span class="weui-loadmore__tips">正在加载</span>
    </div>
</div>
    <script src="/js/jquery-1.8.2.min.js"></script>
    <script>
        $(function () {
            //给搜索框绑定键盘抬起事件
            $(document).on("keyup","#search",function () {
                var _this=$(this);
                //调用like方法处理
                like();
            })
            function like(_this=$(".shop_id"),order="asc") {
                var field = _this.attr("field");
                var _val=$("#search").val();
                var sort_id = $('input[name="cate_id"]').attr('value');
                $.get(
                    "/index/shop_where",
                    {field:field,order:order,sort_id:sort_id,val:_val},
                    function (res) {
                        $("#aaa").empty();
                        $("#aaa").html(res);
                    }
                )
            }
            //综合
            $(document).on("click",".sum",function () {
                var _this=$(this);
                like();
            })
            // 库存
            $(document).on('click','.snum',function(){
                var _this = $(this);
                var order=getinfo(_this);
                like(_this,order);
            })
            // 价格
            $(document).on('click','.price',function(){
                var _this = $(this);
                var order=getinfo(_this);
                like(_this,order);
            })

            // 排序箭头
            function getinfo(_this)
            {
                // 2 如果 得到排序 变化 箭头
                var field = _this.attr('field');
                var type = _this.attr('type');
                // alert(is_sell);
                if (type == 2) {
                    var _text = _this.find('span[class="upDown"]').text();
                    // alert(_text);return;
                    if(_text == '↑'){
                        var new_text = '↓';
                        var order = 'desc';
                    }else{
                        var new_text = '↑';
                        var order = 'asc';
                    }
                    _this.find('span[class="upDown"]').text(new_text);
                    return order;
                }
            }
        })
    </script>
@endsection