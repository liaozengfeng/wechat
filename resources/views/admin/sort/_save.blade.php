@extends('layout.layout')

@section('title')
分类添加
@endsection

@section('content')

<div class="container">
  <form action="" method="post">
  @csrf
    <div class="form-group">
      <label for="sort_name">分类名称:</label>
      <input type="text" class="form-control" id="sort_name" placeholder="请输入分类名称" name="sort_name" value="{{old('sort_name') ?? $data->sort_name ?? '' }}">
    </div>



    <div class="layui-form-item">
      <label class="layui-form-label">分类</label>
      <div class="layui-input-block">
        <select name="parent_id" lay-verify="required">
          @foreach ($sort_info as $v)
            @if(empty($data))
              <option value="{{$v['sort_id']}}">{{$v['sort_name']}}</option>
            @else
              @if($v['sort_id']==$data->parent_id)
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
      <label for="sort_show">是否展示:</label>

      <input type="radio"  id="sort_show" name="sort_show" value="1" checked>是
      <input type="radio"  id="sort_show" name="sort_show" value="2" >否

    </div>

    <div class="form-group">
      <label for="sort_nav_show">是否导航栏展示:</label>

      <input type="radio"  id="sort_nav_show" name="sort_nav_show" value="1" checked>是
      <input type="radio"  id="sort_nav_show" name="sort_nav_show" value="2">否

    </div>

    <button type="submit" class="btn btn-primary">添加</button>
  </form>
</div>

@endsection