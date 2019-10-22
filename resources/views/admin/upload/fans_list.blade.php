@extends('layout.layout')

@section('title')
    素材展示
@endsection

@section('content')
    <table border="1">
        <tr>
            <td>名称</td>
            <td>拥有积分</td>
            <td>二维码</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{ $v['name'] }}</td>
                <td>{{ $v['integral'] }}</td>
                <td><img src="{{ $v['qrcode'] }}" alt="" width="50px"></td>
                <td>
                    <a href="
                    @if(!empty($v['qrcode']))
                            javascript:;
                    @else
                            /admin/qrcode?openid={{ $v['openid'] }}
                       @endif
                  ">生成二维码</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection