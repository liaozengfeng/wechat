@extends('layout.layout')

@section('title')
商品首页
@endsection

@section('content')


  <table class="table table-bordered">
    <tdead>
      <tr align="center">
        <td>id</td>
        <td>图片</td>
        <td>库存</td>
        <td>名称</td>
        <td>价格</td>
        <td>分类</td>
        <td>品牌</td>
        <td>新品</td>
        <td>精品</td>
        <td>热销</td>
        <td>上架</td>
        <td>操作</td>
      </tr>
    </tdead>

    <tbody>
      @foreach($list as $article)
      <tr align="center">
        <td>{{$article->shop_id}}</td>
        <td>
          <img src="
            @if($article->shop_id>214)
                {{ asset('storage/'.$article->shop_img) }}
            @else
                {{ $article->shop_img }}
            @endif
        " style="max-width:50px;">
        </td>
        <td>{{$article->shop_nums}}</td>
        <td>{{$article->shop_name}}</td>
        <td>{{$article->shop_price}}</td>
        <td>{{$article->sort_name}}</td>
        <td>{{$article->brand_name}}</td>
        <td>
          @if($article->is_new==1)
            是
          @else
            否
          @endif
        </td>
        <td>
          @if($article->is_besc==1)
            是
          @else
            否
          @endif
        </td>
        <td>
          @if($article->is_hot==1)
            是
          @else
            否
          @endif
        </td>
        <td>
          @if($article->is_up==1)
              是
          @else
              否
          @endif
        </td>
      
        
        <td>
      
            <a href="/shop/delete/{{$article->shop_id}}" class="btn btn-small btn-primary" onclick="return confirm('确认删除id为'+{{$article->shop_id}} + '的记录吗？');">删除</a>
          <a href="/shop/edit/{{$article->shop_id}}" class="btn btn-danger btn-small">修改</a>
        </td>
      </tr>
      @endforeach
    </tbody>


  </table>
 {{$list->links()}}
@endsection