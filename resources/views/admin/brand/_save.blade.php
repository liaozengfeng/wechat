@extends('layout.layout')

@section('title')
品牌添加
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
      <label for="brand_name">品牌名称:</label>
      <input type="text" class="form-control" id="brand_name" placeholder="请输入品牌名称" name="brand_name" value="{{old('brand_name') ?? $data->brand_name ?? ''}}">
    </div>
    <div class="form-group">
      <label for="brand_url">品牌地址:</label>
      <input type="text" class="form-control" id="brand_url" placeholder="请输入品牌地址" name="brand_url" value="{{old('brand_url') ?? $data->brand_url ?? ''}}">
    </div>

    <div class="form-group">
      <label for="brand_logo">缩略图:</label>
      <input type="file" class="form-control" name="brand_logo" style="display:none;" id="uploadField">
      <button class="btn btn-warning" id="img" type="button">上传缩略图</button>
      <div class="row" style="padding:10px;">
          <img src="{{asset('images/image_file.jpg')}}" alt="缩略图" class="img-thumbnail" width="400px">
      </div>
    </div>


    <div class="form-group">
      <label for="brand_show">是否展示:</label>

      <input type="radio"  id="brand_show" name="brand_show" value="是" checked>是
      <input type="radio"  id="brand_show" name="brand_show" value="否">否

    </div>

    <button type="submit" class="btn btn-primary">保存</button>
  </form>
</div>

@endsection