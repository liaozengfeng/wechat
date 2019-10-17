@extends('layout.layout')

@section('title')
    素材展示
@endsection

@section('content')
    <style>
        .action{
            background-color: red;
        }
        li{
            text-align:center;
            line-height:50px;
            list-style-type: none;
            float:left;
            width: 100px;
            height: 50px;
            border:1px solid  #000;
            border-radius:30% 30% 30% 30%
        }
    </style>
    <ul>
        <li class="" type="voice"><a href="javascript:;">音频</a></li>
        <li class="" type="video"><a href="javascript:;">视频</a></li>
        <li class="" type="image"><a href="javascript:;">图片</a></li>
        <li class="" type="thumb"><a href="javascript:;">缩略图</a></li>
    </ul>
    <div class="show">
       <table border="1">
            <tr>
                <th>id</th>
                <th>media_id</th>
                <th>type</th>
                <th>属性</th>
            </tr>
           @foreach($info as $v)
                <tr>
                    <th>{{ $v['id'] }}</th>
                    <th>{{ $v['medie_id'] }}</th>
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
                    <th><a href="/admin/download?media_id={{ $v['medie_id'] }}&type={{ $v['type'] }}">下载资源</a></th>
                </tr>
           @endforeach
       </table>
    </div>
    <script>
        $(function () {
            $(document).on("click","li",function () {
                $(this).addClass("action");
                $(this).siblings("li").removeClass('action');
                var type=$(this).attr("type");
                $.get(
                    "/admin/upload_list",
                    "type="+type,
                    function (res) {
                        $(".show").empty();
                        $(".show").html(res);
                    }
                )
            })
        })
    </script>
@endsection