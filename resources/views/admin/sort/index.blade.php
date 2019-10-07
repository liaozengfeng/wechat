@extends('layout.layout')

@section('title')
分类首页
@endsection

@section('content')


  <table class="table table-bordered">
    <tdead>
      <tr align="center">
        <td>id</td>
        <td>分类名称</td>
        <td>是否展示</td>
        <td>是否导航栏展示</td>
        <td>操作</td>
      </tr>
    </tdead>

    <tbody>
      @foreach($list as $article)
      <tr align="center">
        <td>{{$article->sort_id}}</td>
        <td>{{$article->sort_name}}</td>
        <td>
          @if($article->sort_show==1)
            是
          @else
            否
          @endif
        </td>
        <td>
          @if($article->sort_nav_show==1)
            是
          @else
            否
          @endif
        </td>
        
        <td>
            <a href="/sort/delete/{{$article->sort_id}}" class="btn btn-small btn-primary" onclick="return confirm('确认删除id为'+{{$article->sort_id}} + '的记录吗？');">删除</a>
            <a href="/sort/edit/{{$article->sort_id}}" class="btn btn-danger btn-small">修改</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
      {{$list->links()}}
@endsection










