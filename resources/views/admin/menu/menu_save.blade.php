@extends('layout.layout')

@section('title')
    素材添加
@endsection

@section('content')
    <form action="/admin/menu_next" method="post">
        @csrf
        <div class="layui-form-item aa">
            <label class="layui-form-label">菜单:</label>
            <div class="layui-input-block">
                <select name="parent_id" lay-verify="required" id="type">
                    @foreach($data as $v)
                        <option value="{{ $v['id'] }}">{{ $v['first_name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="shop_img">菜单名:</label>
            <input type="text" class="form-control" name="first_name" id="uploadField">
        </div>
        <div id="title" class="form-group aa">
            <label for="shop_name">事件值::</label>
            <input type="text" class="form-control" placeholder="请输入名称" name="event_key">
        </div>
        <div class="layui-form-item aa">
            <label class="layui-form-label">事件:</label>
            <div class="layui-input-block">
                <select name="event" lay-verify="required" id="type">
                    <option>click</option>
                    <option>view</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
    </script>
@endsection