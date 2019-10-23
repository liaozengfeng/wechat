@extends("index.layout.layout")
@section("title")
    收货地址
@endsection
@section("content")
    <header class="wy-header">
        <div class="wy-header-icon-back"><span></span></div>
        <div class="wy-header-title">编辑地址</div>
    </header>
    <form>
    <div class="weui-content">
        <div class="weui-cells weui-cells_form wy-address-edit">
            <div class="weui-cell">
                @csrf
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第一节课</label></div>
                <div class="weui-cell__bd">
                    <select name="one" width="50px">
                        <option value="">请选择</option>
                        @foreach($info as $v)
                            <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第二节课</label></div>
                <div class="weui-cell__bd">
                    <select name="two" width="50px">
                        <option value="">请选择</option>
                        @foreach($info as $v)
                            <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第三节课</label></div>
                <div class="weui-cell__bd">
                    <select name="three" width="50px">
                        <option value="">请选择</option>
                        @foreach($info as $v)
                            <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label wy-lab">第四节课</label></div>
                <div class="weui-cell__bd">
                    <select name="four" width="50px">
                        <option value="">请选择</option>
                        @foreach($info as $v)
                            <option value="{!! $v['id'] !!}">{!! $v['name'] !!}</option>
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