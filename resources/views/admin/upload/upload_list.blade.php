@extends('layout.layout')

@section('title')
    素材添加
@endsection

@section('content')
   <table border="1">
        <tr>
            <th>id</th>
            <th>media_id</th>
            <th>path</th>
            <th>addtime</th>
            <th>type</th>
        </tr>
       @foreach($info as $v)
            <tr>
                <th>{{ $v['id'] }}</th>
                <th>{{ $v['medie_id'] }}</th>
                <th>{{ $v['path'] }}</th>
                <th>{{ $v['addtime'] }}</th>
                <th>
                    @if($v['type']=="image")
                        图片
                    @elseif($v['type']=="voice")
                        音频
                    @elseif($v['type']=="video")
                        视频
                    @else
                        缩略图
                    @endif
                </th>
            </tr>
       @endforeach
   </table>
@endsection