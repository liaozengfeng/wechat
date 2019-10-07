@extends('layout.layout')

@section('title')
管理员添加
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)  
            <li>
              {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
  <form action="" method="post" enctype="multipart/form-data">
  @csrf
    <div class="form-group">
      <label for="shop_nums">商品库存:</label>
      <input type="text" class="form-control" id="shop_nums" placeholder="请输入商品库存" name="shop_nums" value="{{old('shop_nums') ?? $data->shop_nums ?? ''}}">
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">品牌</label>
      <div class="layui-input-block">
        <select name="brand_id" lay-verify="required">
          @foreach ($brand_info as $v)
            @if(empty($data))
               <option value="{{$v['brand_id']}}">{{$v['brand_name']}}</option>
            @else
              @if($v['brand_id']==$data->brand_id)
                  <option value="{{$v['brand_id']}}" selected>{{$v['brand_name']}}</option>
              @else
                <option value="{{$v['brand_id']}}">{{$v['brand_name']}}</option>
              @endif
            @endif
          @endforeach

        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">分类</label>
      <div class="layui-input-block">
        <select name="sort_id" lay-verify="required">
          @foreach ($sort_info as $v)
            @if(empty($data))
              <option value="{{$v['sort_id']}}">{{$v['sort_name']}}</option>
            @else
              @if($v['sort_id']==$data->sort_id)
                <option value="{{$v['sort_id']}}" selected>
                  {{str_repeat("  ",$v['level']*5)}}
                  {{$v['sort_name']}}
                </option>
              @else
                <option value="{{$v['sort_id']}}">
                  {{str_repeat("  ",$v['level']*5)}}
                  {{$v['sort_name']}}
                </option>
              @endif
            @endif
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="shop_name">商品名称:</label>
      <input type="text" class="form-control" id="shop_name" placeholder="请输入商品名称" name="shop_name" value="{{old('shop_name') ?? $data->shop_name ?? ''}}">
    </div>
    <div class="form-group">
      <label for="shop_price">商品价格:</label>
      <input type="text" class="form-control" id="shop_price" placeholder="请输入商品价格" name="shop_price" value="{{old('shop_price') ?? $data->shop_price ?? ''}}">
    </div>

    <div class="form-group">
      <label for="shop_img">缩略图:</label>
      <input type="file" class="form-control" name="shop_img" style="display:none;" id="uploadField">
      <button class="btn btn-warning" id="img" type="button">上传缩略图</button>
      <div class="row" style="padding:10px;">
          <img src="{{ asset('images/image_file.jpg')}}" alt="缩略图" class="img-thumbnail" width="400px">
      </div>
    </div>

    
    <div class="form-group">
      <label for="shop_imgs">缩略图:</label>
      <input type="file" class="form-control" name="shop_imgs[]" multiple  id="uploadFields">
    </div>


    <div class="form-group">
      <label for="shop_desc">描述:</label>
      <script id="shop_desc" name="goods_desc" type="text/plain"></script>
    </div> 


    <div class="form-group">
      <label for="is_up">是否上架:</label>


      <input type="radio"  id="is_up" name="is_up" value="1"  checked="">是
       <input type="radio"  id="is_up" name="is_up" value="2">否


    </div>

    <div class="form-group">
      <label for="is_new">是否新品:</label>


      <input type="radio"  id="is_new" name="is_new" value="1" checked="">是
      <input type="radio"  id="is_new" name="is_new" value="2">否


    </div>

    <div class="form-group">
      <label for="is_besc">是否精品:</label>


      <input type="radio"  id="is_besc" name="is_besc" value="1" checked="">是
      <input type="radio"  id="is_besc" name="is_besc" value="2">否

    </div>

        <div class="form-group">
      <label for="is_hot">是否热卖:</label>

      <input type="radio"  id="is_hot" name="is_hot" value="1" checked>是
      <input type="radio"  id="is_hot" name="is_hot" value="2">否


    </div>

    <button type="submit" class="btn btn-primary">保存</button>
  </form>

<script  src="{{asset('js/ueditor/ueditor.config.js')}}"></script>
  
<script type="text/javascript" src="{{asset('js/ueditor/ueditor.all.min.js')}}"></script>

<script type="text/javascript">
      var ue = UE.getEditor('shop_desc');
      var content = "{!! old('shop_desc') ?? $data->shop_desc ?? '' !!}"

      ue.ready(function(){
          ue.setContent(content);
      });
</script>
</div>

@endsection