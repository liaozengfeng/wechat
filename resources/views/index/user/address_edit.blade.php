@extends("index.layout.layout")
@section("title")
    收货地址
@endsection
@section("content")
<header class="wy-header">
    <div class="wy-header-icon-back"><span></span></div>
    <div class="wy-header-title">编辑地址</div>
</header>
<div class="weui-content">
    <div class="weui-cells weui-cells_form wy-address-edit">
        <div class="weui-cell">
        <form action="/index/addAddress" method="post" id="form">
        @csrf
            <div class="weui-cell__hd"><label class="weui-label wy-lab">收货人</label></div>
            <div class="weui-cell__bd"><input class="weui-input" name="consignee" type="text" pattern="[0-9]*" placeholder="收货人名称"></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
            <div class="weui-cell__bd"><input class="weui-input" name="mobile" type="tel" pattern="[0-9]*" placeholder="手机号"></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="name" class="weui-label wy-lab">地区</label></div>
                <!-- <div class="weui-cell__bd">
                <input class="weui-input" id="address" type="text" value="湖北省 武汉市 武昌区" readonly="" data-code="420106" data-codes="420000,420100,420106">
                </div> -->
                <select name="province" width="50px">
                    <option value="">请选择</option>
                    @foreach($top as $v)
                    <option value="{!!$v->id!!}">{!! $v->name !!}</option>
                    @endforeach
                </select>
                &nbsp&nbsp
                <select name="city" width="50px">
                    <option value="">请选择</option>
                </select>
                &nbsp&nbsp
                <select name="district" width="50px">
                    <option value="">请选择</option>
                </select>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label wy-lab">详细地址</label></div>
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" name="address" placeholder="请输入详情地址"></textarea>
            </div>
        </div>
    </div>
    <div class="weui-btn-area">
        <!-- <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">保存此地址</a> -->
        <input type="button" value="保存此地址" class="weui-btn weui-btn_primary" id="bnt">

        </form>
    </div>

</div>
<!-- 三级联动 -->
<script src="/js/jquery-1.8.2.min.js"></script>
<script>
    $('select').change(function(){
        var id = $(this).val();
        var _this = $(this);
        $.get(
            "/index/getArea",
            {id:id},
            function(msg){
               var str='<option value="">请选择</option>';
               $.each(msg,function(key,val){
                str+='<option value='+val.id+'>'+val.name+'</option>';
               });
                _this.next().html(str);               
            },'json'
        );
    })
</script>
<!-- ajax添加 -->
<script>
    $(document).on('click','#bnt',function(){
        var form = $('#form').serialize();// 序列化serialize
        $.ajax({
            url:"/index/addAddress",
            data:form,
            type:"POST",
             dataType:'json',
             success:function(res){
             // alert(res);
              if(res.ret==1){
              alert(res.msg);
             location.href="/index/address_list";
         }else{
          alert(res.msg);
             }
         }
        })
    })
</script>
@endsection