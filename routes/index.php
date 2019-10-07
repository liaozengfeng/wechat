<?php
//项目

//注册
Route::any('/index/regist','Index\LoginController@regist');
Route::any('/index/regist_do','Index\LoginController@regist_do');
//登录
Route::any('/index/login','Index\LoginController@login');
Route::any('/index/login_do','Index\LoginController@login_do');

//测试
Route::any('/index/session','Index\LoginController@session');
//楼层
Route::any('/index/sortinfo','Index\IndexController@sortinfo');
Route::any('/index/shop','Index\IndexController@index');
//列表页
Route::any('/index/brand','Index\BrandController@brand');
//列表页条件排序
Route::any('/index/shop_where','Index\BrandController@shop_where');
//商品详情
Route::any('/index/shopinfo','Index\ShopController@shopinfo');
//分类
Route::any('/index/cart','Index\CartController@sort');
//个人中心
Route::any('/index/user','Index\UserController@index');


Route::group(['middleware'=>['IndexLogin']],function(){
    //收货地址添加
    Route::any('/index/address_edit','Index\UserController@address_edit');
    //三级联动
    Route::any('/index/area','Index\UserController@area');
    Route::any('/index/getArea','Index\UserController@getArea');
    //添加收货地址和收货人
    Route::any('/index/addAddress','Index\UserController@addAddress');
    //收货地址添加
    Route::any('/index/address_edit','Index\UserController@address_edit');
    //收货地址展示
    Route::any('/index/address_list','Index\UserController@address_list');
    //收货地址修改默认
    Route::any('/index/address_checked','Index\UserController@address_checked');
    //收货地址和收货人修改
    Route::any('/index/address_update','Index\UserController@address_update');
    Route::any('/index/address_update_do','Index\UserController@address_update_do');
    //删除收货地址
    Route::any('/index/brand_del','Index\UserController@brand_del');
    //历史浏览记录
    Route::any('/index/history','Index\ShopController@history');
    //浏览历史删除
    Route::any('/index/delete','Index\ShopController@delete');
    //收藏
    Route::any('/index/shoucang','Index\ShopController@shoucang');
    Route::any('/index/user/usercollect','Index\ShopController@usercollect');
    Route::any('/index/user/userdelete','Index\ShopController@userdelete');

    //购物车
    Route::any('/index/shopcart','Index\shopController@shopcart');
    //加入购物车
    Route::any('/index/shopsave','Index\shopController@shopsave');
    //获取总价
    Route::any('/index/getTotal','Index\shopController@getTotal');
    //删除
    Route::any('/index/cart_delete','Index\shopController@cart_delete');

    //支付
    Route::any('/index/pay','Alipay\AlipayController@pay');

    //展示订单页面
    Route::any('/index/order','Index\OrderController@order');
    //订单添加
    Route::any('/index/order_info','Index\OrderController@order_info');
    //订单展示
    Route::any('/index/order_list','Index\OrderController@order_list');
    //支付
    Route::any('/index/pay','Index\OrderController@pay');
    //同步返回
    Route::any('/index/alipayreturn', 'Index\OrderController@alipayreturn');
    //异步返回
    Route::post('/index/alipaynotify', 'Index\OrderController@alipayNotify');

    //注销登录
    Route::any('/index/logout','Index\LoginController@logout');

    //收藏展示
    Route::any('/index/usercollect','Index\UserController@usercollect');

    //交易记录
    Route::any('/index/record','Index\UserController@record');

});



