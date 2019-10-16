@extends('layout.layout')

@section('title')
    素材添加
@endsection

@section('content')
    <form action="/admin/upload" method="post" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">文件类型</label>
            <div class="layui-input-block">
                <select name="type" lay-verify="required">
                    <option value="image">图片</option>
                    <option value="voice">音频</option>
                    <option value="video">视频</option>
                    <option value="thumb">缩略图</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="shop_img">文件:</label>
            <input type="file" class="form-control" name="upload_file" style="display:none;" id="uploadField">
            <button class="btn btn-warning" id="img" type="button">上传文件</button>
        </div>
        <div class="form-group">
            <label for="is_hot">方式:</label>

            <input type="radio" name="store" value="1" checked>缓存
            <input type="radio" name="store" value="2">永久


        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection