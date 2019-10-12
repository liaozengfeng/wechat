@extends('layout.layout')

@section('title')
分类首页
@endsection

@section('content')


  <table class="table table-bordered">
    <tdead>
      <tr align="center">
        <td>id</td>
        <td>标签名称</td>
        <td>数量</td>
        <td>操作</td>
      </tr>
    </tdead>

    <tbody>
      @foreach($data['tags'] as $article)
      <tr align="center">
        <td>{{$article['id']}}</td>
        <td>{{$article['name']}}</td>
        <td>{{ $article['count'] }}</td>
        <td>
            <a href="/lable/dele?l_id={{ $article['id'] }}" class="btn btn-small btn-primary" onclick="return confirm('确认删除id为'+{{$article['id']}} + '的记录吗？');">删除</a>
            <a href="/lable/edit?l_id={{$article['id']}}" class="btn btn-danger btn-small">修改</a>
            <a href="/lable/fans?l_id={{ $article['id'] }}" class="btn btn-danger btn-small">为粉丝编辑标签</a>
            <a href="/lable/fans_list?l_id={{ $article['id'] }}" class="btn btn-danger btn-small">查看</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection










