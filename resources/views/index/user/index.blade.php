@extends("index.layout.shop")
@section("title")
    个人中心
@endsection
@section("content")
    <div class='weui-content'>
    <div class="wy-center-top">
        <div class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd"><img class="weui-media-box__thumb radius" src="/images/headimg.jpg" alt=""></div>
            <div class="weui-media-box__bd">
            @if(empty(session("userinfo")))
                <div>
                    <span>
                        <a href="/index/login">登录</a>/
                        <a href="/index/regist">注册</a>
                    </span>
                </div>
                @else
                <span>
                <h4 class="weui-media-box__title user-name">{{ session('userinfo')['phone'] }}</h4>
                <p class="user-grade">等级：普通会员</p>
                <p class="user-integral">待返还金额：<em class="num">500.0</em>元</p>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd">
            <a href="/index/order_list" class="weui-cell weui-cell_access center-alloder">
                <div class="weui-cell__bd wy-cell">
                    <div class="weui-cell__hd"><img src="/images/center-icon-order-all.png" alt="" class="center-list-icon"></div>
                    <div class="weui-cell__bd weui-cell_primary"><p class="center-list-txt">全部订单</p></div>
                </div>
                <span class="weui-cell__ft"></span>
            </a>
        </div>
        <div class="weui-panel__bd">
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <a href="/index/order_list?pay_static=1" class="center-ordersModule">
                        <div class="imgicon"><img src="/images/center-icon-order-dfk.png" /></div>
                        <div class="name">待付款</div>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="/index/order_list?pay_static=2" class="center-ordersModule">
                        <div class="imgicon"><img src="/images/center-icon-order-dfh.png" /></div>
                        <div class="name">待发货</div>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="/index/order_list?pay_static=3" class="center-ordersModule">
                        <div class="imgicon"><img src="/images/center-icon-order-dsh.png" /></div>
                        <div class="name">待收货</div>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="/index/history" class="center-ordersModule">
                        <div class="imgicon"><img src="/images/center-icon-order-dpj.png" /></div>
                        <div class="name">浏览记录</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd">
            <a href="myburse.html" class="weui-cell weui-cell_access center-alloder">
                <div class="weui-cell__bd wy-cell">
                    <div class="weui-cell__hd"><img src="/images/center-icon-jk.png" alt="" class="center-list-icon"></div>
                    <div class="weui-cell__bd weui-cell_primary"><p class="center-list-txt">我的小金库</p></div>
                </div>
                <span class="weui-cell__ft"></span>
            </a>
        </div>
        <div class="weui-panel__bd">
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <a href="myburse.html" class="center-ordersModule">
                        <div class="center-money"><em>800.0</em></div>
                        <div class="name">账户总额</div>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="myburse.html" class="center-ordersModule">
                        <div class="center-money"><em>50.0</em></div>
                        <div class="name">返现金额</div>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="myburse.html" class="center-ordersModule">
                        <div class="center-money"><em>550.0</em></div>
                        <div class="name">待返还</div>
                    </a>
                </div>
                <div class="weui-flex__item">
                    <a href="myburse.html" class="center-ordersModule">
                        <div class="center-money"><em>165</em></div>
                        <div class="name">蓝豆</div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="weui-panel">
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_small-appmsg">
                <div class="weui-cells">
                    <a class="weui-cell weui-cell_access" href="/index/usercollect">
                        <div class="weui-cell__hd"><img src="/images/center-icon-sc.png" alt="" class="center-list-icon"></div>
                        <div class="weui-cell__bd weui-cell_primary">
                            <p class="center-list-txt">我的收藏</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    <a class="weui-cell weui-cell_access" href="/index/address_list">
                        <div class="weui-cell__hd"><img src="/images/center-icon-dz.png" alt="" class="center-list-icon"></div>
                        <div class="weui-cell__bd weui-cell_primary">
                            <p class="center-list-txt">地址管理</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                    <a class="weui-cell weui-cell_access" href="/index/logout">
                        <div class="weui-cell__hd"><img src="/images/center-icon-out.png" alt="" class="center-list-icon"></div>
                        <div class="weui-cell__bd weui-cell_primary">
                            <p class="center-list-txt">退出账号</p>
                        </div>
                        <span class="weui-cell__ft"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection