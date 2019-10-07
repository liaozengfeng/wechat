@extends('layout.layout')

@section('title')
品牌首页
@endsection

@section('content')

	<table class="table table-bordered">
		<thead>
			<tr align="center">
				<td>id</td>
				<td>品牌名称</td>
				<td>品牌地址</td>
				<td>品牌logo</td>
				<td>是否显示</td>
				<td>添加时间</td>
				<td>操作</td>
			</tr>
		</thead>
		<tbody>
			@foreach($list as $data)
			<tr align="center">
				<td>{{$data->brand_id}}</td>
				<td>{{$data->brand_name}}</td>
				<td>{{$data->brand_url}}</td>
				<td>
					<img src="
						 @if($data->brand_id>50)
							{{ asset('storage/'.$data->brand_logo) }}
						@else
							{{ $data->brand_logo }}
						@endif
					" style="max-width:50px;">
				</td>
				<td>{{$data->brand_show}}</td>
				<td>{{$data->created_at}}</td>
				<td>

					<a href="/brand/delete/{{ $data->brand_id }}" class="btn btn-small btn-primary" onclick="return confirm('确认删除id为'+{{ $data->brand_id }} + '的记录吗？');">删除</a>
					<a href="/brand/edit/{{ $data->brand_id }}" class="btn btn-danger btn-small">修改</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$list->links()}}
@endsection











