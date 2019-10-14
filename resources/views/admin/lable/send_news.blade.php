@extends('layout.layout')

@section('title')
    标签
@endsection

@section('content')

    <div class="container">
        <form action="/lable/send_news" method="post">
            <input type="hidden" value="{{ $l_id }}" name="l_id">
            <label for="sort_name">内容:</label>
            <textarea class="form-control" name="content"></textarea>
            <button type="submit" class="btn btn-primary">添加</button>
        </form>
    </div>
@endsection