@extends("index.layout.layout")
@section("title")
    收货地址
@endsection
@section("content")
    <header class="wy-header">
        <div class="wy-header-icon-back"><span></span></div>
        <div class="wy-header-title">编辑地址</div>
    </header>
    <form action="/course/list_add" method="post">
    <div class="weui-content">
        <div class="weui-cells weui-cells_form wy-address-edit">
            <div class="weui-cell">
                <input type="hidden" value="{{ $openid }}" name="openid">
                @csrf
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第一节课</label></div>
                <div class="weui-cell__bd">
                    <select name="one" width="50px">
                        @foreach($info as $v)
                            @if(!empty($data['one'])&&$data['one']==$v['id'])
                                <option value="{!! $v['id'] !!}" selected>{!! $v['name'] !!}</option>
                            @else
                                <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第二节课</label></div>
                <div class="weui-cell__bd">
                    <select name="two" width="50px">
                        @foreach($info as $v)
                            @if(!empty($data['two'])&&$data['two']==$v['id'])
                                <option value="{!! $v['id'] !!}" selected>{!! $v['name'] !!}</option>
                            @else
                                <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第三节课</label></div>
                <div class="weui-cell__bd">
                    <select name="three" width="50px">
                        @foreach($info as $v)
                            @if(!empty($data['three'])&&$data['three']==$v['id'])
                                <option value="{!! $v['id'] !!}" selected>{!! $v['name'] !!}</option>
                            @else
                                <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第四节课</label></div>
                <div class="weui-cell__bd">
                    <select name="four" width="50px">
                        @foreach($info as $v)
                            @if(!empty($data['four'])&&$data['four']==$v['id'])
                                <option value="{!! $v['id'] !!}" selected>{!! $v['name'] !!}</option>
                            @else
                                <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="weui-btn-area">
            <input type="submit" value="保存" class="weui-btn weui-btn_primary" id="bnt">

        </div>

    </div>
    </form>
@endsection