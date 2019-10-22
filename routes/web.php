<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['CheckLogin']],function(){
    //商品
    Route::get('/','Admin\ShopController@index');
    Route::any('/shop/index','Admin\ShopController@index');
    Route::any('/shop/save','Admin\ShopController@save');
    Route::any('/shop/info','Admin\ShopController@info');
    //删除
    Route::any('/shop/delete/{id}','Admin\ShopController@delete');
    //修改
    Route::get('/shop/edit/{id}','Admin\ShopController@edit');
    Route::post('/shop/edit/{id}','Admin\ShopController@update');


    //管理
    Route::any('/admin/index','Admin\AdminController@index');
    Route::any('/admin/save','Admin\AdminController@save');
    //删除
    Route::any('/admin/delete/{id}','Admin\AdminController@delete');
    //修改
    Route::get('/admin/edit/{id}','Admin\AdminController@edit');
    Route::post('/admin/edit/{id}','Admin\AdminController@update');

    //标签管理
    Route::any('/lable/save','Admin\LableController@save');
    Route::any('/lable/index','Admin\LableController@index');
    Route::any('/lable/dele','Admin\LableController@delete');
    Route::any('/lable/fans','Admin\LableController@fans');
    Route::any('/lable/fans_list','Admin\LableController@fans_list');
    Route::any('/lable/fans_save','Admin\LableController@fans_save');
    Route::any('/lable/fans_del','Admin\LableController@fans_del');
    Route::any('/lable/send_news','Admin\LableController@send_news');

    //分类
    Route::any('/sort/index','Admin\SortController@index');
    Route::any('/sort/save','Admin\SortController@save');
    Route::any('/sort/delete','Admin\SortController@delete');
    Route::any('/sort/update','Admin\SortController@update');
     //删除
    Route::any('/sort/delete/{id}','Admin\SortController@delete');
    //修改
    Route::get('/sort/edit/{id}','Admin\SortController@edit');
    Route::post('/sort/edit/{id}','Admin\SortController@update');

    //品牌
    Route::any('/brand/index','Admin\BrandController@index');
    Route::any('/brand/save','Admin\BrandController@save');
    //删除
    Route::any('/brand/delete/{id}','Admin\BrandController@delete');
    //修改
    Route::get('/brand/edit/{id}','Admin\BrandController@edit');
    Route::post('/brand/edit/{id}','Admin\BrandController@update');

    //接口配置


    // Route::get('/logout', 'admin\UserController@index')->name('logout');
    // Route::get('/send', 'admin\UserController@send');


    //注册 登录
    Route::get('/logout', 'Admin\UserController@logout')->name('logout');

    Route::get('/send', 'Admin\UserController@send');
    Route::any('/admin/upload', 'Admin\UploadController@upload');
    Route::any('/admin/upload_list', 'Admin\UploadController@upload_list');
    Route::any('/admin/download', 'Admin\UploadController@download');

    //展示粉丝
    Route::any('/admin/qrcode_list', 'Admin\UploadController@qrcode_list');
    //生成二维码
    Route::any('/admin/qrcode', 'Admin\UploadController@qrcode');

    Route::any('/admin/menu_save', 'Admin\MenuController@menu_save');
    Route::any('/admin/menu_next', 'Admin\MenuController@menu_next');
    Route::any('/admin/menu', 'Admin\MenuController@menu');
    Route::any('/admin/menu_list', 'Admin\MenuController@menu_list');


});
//微信签到
Route::any('/admin/user_save', 'Admin\IntegralController@user_save');


Route::any('/exec/exec','Admin\ExecController@exec');



