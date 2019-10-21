@extends('layout.layout')

@section('title')
    素材添加
@endsection

@section('content')
    <form action="/admin/menu_save" method="post">
        @csrf
        <div class="form-group">
            <label for="shop_img">菜单名:</label>
            <input type="text" class="form-control" name="first_name" id="uploadField">
        </div>
        <div class="form-group">
            <label for="is_hot">是否有子类:</label>
            <input type="radio" name="next" class="next" value="1" checked>有子类
            <input type="radio" name="next" class="next" value="2">无子类
        </div>
        <div id="title" class="form-group aa" style="display: none;">
            <label for="shop_name">事件值::</label>
            <input type="text" class="form-control" placeholder="请输入名称" name="event_key">
        </div>
        <div class="layui-form-item aa" style="display: none;">
            <label class="layui-form-label">事件:</label>
            <div class="layui-input-block">
                <select name="event" lay-verify="required" id="type">
                    <option value="">--请选择--</option>
                    <option>click</option>
                    <option>view</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
    <script>
        $(function () {
            $(document).on("click",".next",function () {
                if ($(this).val()==1){
                    $(".aa").hide();
                }else{
                    $(".aa").show();
                }
            })
        })
    </script>
@endsection