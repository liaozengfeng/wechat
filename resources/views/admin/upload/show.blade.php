<table border="1">
    <tr>
        <th>id</th>
        <th>media_id</th>
        <th>type</th>
        <th>属性</th>
    </tr>
    @foreach($info as $v)
        <tr>
            <th>{{ $v->id }}</th>
            <th>{{ $v->medie_id }}</th>
            <th>
                @if($v->type=="image")
                    图片
                @elseif($v->type=="voice")
                    音频
                @elseif($v->type=="video")
                    视频
                @else
                    缩略图
                @endif
            </th>
            <th><a href="/admin/download?media_id={{ $v->medie_id }}?type={{ $v->type }}">下载资源</a></th>
        </tr>
    @endforeach
</table>