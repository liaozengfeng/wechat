@extends('layout.layout')

@section('title')
    分类添加
@endsection

@section('content')
    <input type="hidden" id="lid" value="{{old('id') ?? $id ?? "1" }} ">
    <table class="table table-bordered">
        <thead>
        <tr align="center">
            <th class="abc"><input type="checkbox" id="asc"></th>
            <td>头像</td>
            <td>名</td>
            <td>性别</td>
            <td>国家</td>
            <td>省</td>
            <td>市</td>
            <td>拥有标签</td>
        </tr>
        </thead>
        <tbody>
        @foreach($info as $v)
            <tr align="center">
                <th class="abc"><input type="checkbox" class="asc" value="{{ $v['openid'] }}"></th>
                <th><img src="{{ $v['headimgurl'] }}" alt="" width="50"></th>
                <th>{{ $v['nickname'] }}</th>
                <th>@if($v['sex']==1)男@else女@endif</th>
                <th>{{ $v['country'] }}</th>
                <th>{{ $v['province'] }}</th>
                <th>{{ $v['city'] }}</th>
                <th>
                    @if(!empty($v['tagname']))
                        @foreach($v['tagname'] as $k=>$v)
                            {{ $v }}
                        @endforeach
                    @endif
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-danger" id="save">添加标签</button>
    <button class="btn btn-danger" id="del">删除标签</button>
    <script>
        $(function () {
            if($("#lid").val()==1){
                $(".abc").hide();
                $("#save").hide();
                $("#del").hide();
            }else{
                var l_id=$("#lid").val();
            }

            $(document).on("click","#asc",function () {
                $(".asc").prop("checked",$(this).prop("checked"));
            })
            function openid() {
                var openid=$(".asc:checked");
                var str="";
                openid.each(function (index) {
                    str+=$(this).val()+",";
                })
                str=str.substr(0,str.length-1);
                return str;
            }

            $(document).on("click","#save",function () {
                var str=openid();
                location.href="/lable/fans_save?id="+l_id+"&openid="+str;
            })
            
            $(document).on("click","#del",function () {
                var str=openid();
                location.href="/lable/fans_del?id="+l_id+"&openid="+str;
            })
        })
    </script>
@endsection