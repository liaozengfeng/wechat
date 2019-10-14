@extends('layout.layout')

@section('title')
标签
@endsection

@section('content')

<div class="container">
  <form action="/lable/save" method="post">
  @csrf
    <div class="form-group">
      <label for="sort_name">标签名称:</label>
      <input type="text" class="form-control" placeholder="请输入名称标签" name="l_name" value="{{old('l_name') ?? $data->l_name ?? '' }}">
    </div>


    <button type="submit" class="btn btn-primary">添加</button>
  </form>
</div>

@endsection