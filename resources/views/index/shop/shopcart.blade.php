@extends("index.layout.layout")
@section("title")
  购物车
@endsection
@section("content")
  <!--主体-->
  <header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">购物车</div>
  </header>
  @foreach($list as $v)
  <div class="weui-content">
    <div class="weui-panel weui-panel_access">
      <div class="weui-panel__bd">
        <div class="weui-media-box_appmsg pd-10">
          <div class="weui-media-box__hd check-w weui-cells_checkbox">
             <input type="checkbox" shop_id="{{ $v->shop_id }}" class="shopId">
          </div>
          <div class="weui-media-box__hd"><a href="pro_info.html"><img class="weui-media-box__thumb" src="{{ $v->shop_img }}" alt=""></a></div>
          <div class="weui-media-box__bd">
            <h1 class="weui-media-box__desc"><a href="pro_info.html" class="ord-pro-link">{{ $v->shop_name }}</a></h1>
            <p class="weui-media-box__desc">规格：<span>红色</span>，<span>23</span></p>
            <div class="clear mg-t-10">
              <div class="wy-pro-pri fl">¥<em class="num font-15">{{ $v->shop_price }}</em></div>
              <div class="pro-amount fr"><div class="Spinner"></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  <!--底部导航-->
  <div class="foot-black"></div>
  <div class="weui-tabbar wy-foot-menu">
    <div class="npd cart-foot-check-item weui-cells_checkbox allselect">   
        <div class="weui-cell__bd" >
          <p class="font-14" > <input type="checkbox" id="allcheckbox">全选 </p>

        </div>  
    </div>
    <div class="npd cart-foot-check-item weui-cells_checkbox allselect">   
        <div class="weui-cell__bd" >
          <p class="font-14" id="del"> <input type="button" >删除 </p>

        </div>  
    </div>

    <div class="weui-tabbar__item  npd">
      <span><p class="cart-total-txt yy" >合计：￥0</p></span>
    </div>
    <a href="javascript:;" class="red-color npd w-90 t-c" id="buy">
      <p class="promotion-foot-menu-label">去结算</p>
    </a>
  </div>
   <script src="/js/jquery.min.js"></script>
   <script>

    //点击全选
    $(document).on('click','#allcheckbox',function(){
      //复选框全部选中
      var status=$(this).prop('checked');
      $(".shopId").prop('checked',status);
      //获取总价
      price_num();
    })
        //获取复选框
      $(".shopId").on('click',function(){
           //获取选中复选框的Id
        price_num();
      })

      //获取总价
      function price_num(){
        var shop_ids="";
        var shopId=$(".shopId:checked");
        shopId.each(function(index){
          shop_ids+=$(this).attr('shop_id')+',';
        });
        shop_ids=shop_ids.substr(0,shop_ids.length-1);
        //通过Ajax传送
         $.ajax({
              method:"get",
              url:"/index/getTotal",
              data:{shop_id:shop_ids},
            }).done(function(res){
             $('.yy').text('￥'+res);
            });
      }


      //点击删除
    $(document).on('click','#del',function(){
        var shop_ids="";
        var shopId=$(".shopId:checked");
        shopId.each(function(index){
          shop_ids+=$(this).attr('shop_id')+',';
        });
        shop_ids=shop_ids.substr(0,shop_ids.length-1);
    
      //通过ajax把商品id传给控制器
      $.ajax({
                url:"/index/cart_delete",
                type:"get",
                dataType:'json',
                data:{shop_id:shop_ids},
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
            $(document).on("click","#buy",function () {
                var shop_ids="";
                var shopId=$(".shopId:checked");
                shopId.each(function(index){
                    shop_ids+=$(this).attr('shop_id')+',';
                });
                shop_ids=shop_ids.substr(0,shop_ids.length-1);
                location.href="/index/order?id="+shop_ids;

            })

     
   </script>
@endsection