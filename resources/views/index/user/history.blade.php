
@extends("index.layout.shop")
@section("title")
    首页
@endsection
@section("content")
    <!--主体-->

    <div class="weui-content">
        <div id="list" class='demos-content-padded proListWrap'>
            <div class="weui-media-box__hd" style="padding:15px"><input type="checkbox" id="allbox"><span>全选</span></div>
            @foreach($historyInfo as $history)
                <div class="weui-panel__hd"><span>江苏蓝之蓝旗舰店</span><a href="javascript:;" class="wy-dele del"></a></div>
                <div class="pro-items" shop_id="{{ $history['shop_id'] }}">
                <a href="/index/shopinfo?id={{ $history['shop_id'] }}" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box_appmsg pd-10">
                        <input type="checkbox" class="box">
                    </div>
                    <div class="weui-media-box__hd">
                        <img class="weui-media-box__thumb" src="{{ $history['shop_img'] }}" alt="">
                    </div>
                    <div class="weui-media-box__bd">
                        <h1 class="weui-media-box__desc">{{ $history['shop_name'] }}</h1>
                        <div class="wy-pro-pri">¥<em class="num font-15">{{ $history['shop_price'] }}</em></div>
                        <ul class="weui-media-box__info prolist-ul">
                            <li class="weui-media-box__info__meta"><em class="num">0</em>条评价</li>
                            <li class="weui-media-box__info__meta"><em class="num">100%</em>好评</li>
                        </ul>
                    </div>
                </a>
            </div>
                @endforeach
        </div>
        <br>
        &nbsp; &nbsp; &nbsp; <input type="button" value="批量删除"  id="delMany">
        <div class="weui-loadmore">
            <i class="weui-loading"></i>
            <span class="weui-loadmore__tips">正在加载</span>
        </div>

    </div>
    <script>
        $(function(){
            //全选
            $(document).on('click','#allbox',function(){
               $('.box').prop('checked',$(this).prop('checked'));
            })
            //单删
           $(document).on('click','.del',function(){
               var _this=$(this);
               var shop_id=_this.parent("div[class='weui-panel__hd']").next("div[class='pro-items']").attr('shop_id');
               var check=_this.parents("div").find("input[type='checkbox']").prop("checked");
              if(window.confirm("是否确认删除")){
                  location.href="/index/delete?shop_id="+shop_id;
              }
           })
            //批删
            $(document).on('click','#delMany',function(){
                var box=$('.box:checked');
                var shop_id="";
                box.each(function(index){
                    shop_id+=$(this).parents("div[class='pro-items']").attr('shop_id')+',';
                });
                //alert(shop_id);
                shop_id=shop_id.substr(0,shop_id.length-1);
                if(shop_id==''){
                    alert("请至少选择一个浏览历史记录");
                }else{
                    if(window.confirm("是否确认删除")){
                        location.href="/index/delete?shop_id="+shop_id;
                    }
                }
            })
        })
    </script>
@endsection

