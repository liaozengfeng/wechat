@extends('layout.layout')

@section('title')
用户首页
@endsection

@section('content')


    @if(session()->has('admins'))
        <div class="alert alert-success">
            {{ session('admins') }}
        </div>
    @endif



    <table class="table table-bordered">
        <thead>
            <tr align="center">
                <td><input type="checkbox" name="id" id="checkall"></td>
                <td>id</td>
                <td>用户名</td>
                <td>邮箱</td>
                <td>添加时间</td>
                <td>操作</td>
            </tr>
        </thead>
         <tbody>
            @foreach($list as $data)
            <tr align="center">
                <td><input type="checkbox" name="id[]" value="{{ $data->admin_id }}"></td>
                <td>{{$data->admin_id}}</td>
                <td>{{$data->admin_account}}</td>
                <td>{{$data->admin_email}}</td>
                <td>{{$data->created_at}}</td>
                <td>

                    <a href="/admin/delete/{{ $data->admin_id }}" class="btn btn-small btn-primary" onclick="return confirm('确认删除id为'+{{ $data->admin_id }} + '的记录吗？');">删除</a>
                    <a href="/admin/edit/{{$data->admin_id}}" class="btn btn-danger btn-small">修改</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> 

    <div class="pull-left">
        <button href="" class="btn btn-default" id="checkorno">全选/反选</button>
        <button class="btn btn-danger" id="delall">删除</button>
    </div>

    <div class="pull-right">
        {{$list}}  
    </div>
    
@endsection