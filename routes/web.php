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

/**
 * web路由 未登录
 */
Route::group(['middleware' => 'checkTokenIndex'], function () {

//首页
    Route::get('/',"\App\Http\Controllers\Index\Index\IndexController@Index");
    //文章
    Route::group(['prefix' => 'article'], function () {
        Route::get('/{ac_id?}', "\App\Http\Controllers\Index\Index\ArticleController@Index");//文章分类列表
        Route::get('/{ac_id}/{id}', "\App\Http\Controllers\Index\Index\ArticleController@Detail");//文章内容
    });
//套餐购买
    Route::group(['prefix' => 'setMenu'], function () {
        Route::get('/vpn', "\App\Http\Controllers\Index\SetMenu\VpnController@Index");
        Route::get('/http', "\App\Http\Controllers\Index\SetMenu\HttpController@Index");
    });
//ip列表
    Route::get('/ipList',"\App\Http\Controllers\Index\IpList\IpListController@Index");
    Route::get('/ipList.csv',"\App\Http\Controllers\Index\IpList\IpListController@Index");

    //使用帮助
    Route::group(['prefix' => 'help'], function () {
        Route::get('/',"\App\Http\Controllers\Index\Help\HelpController@Index"); //文档中心
        Route::get('/school',"\App\Http\Controllers\Index\Help\HelpController@School"); //新手学堂
        Route::get('/search',"\App\Http\Controllers\Index\Help\HelpController@Search");//检索列表
        Route::get('/{hc_id}/{id}', "\App\Http\Controllers\Index\Help\HelpController@Detail");//帮助内容
    });
//获取API
    Route::get('/getIP',"\App\Http\Controllers\Index\GetIp\GetIpController@Index");
    Route::post('/getIP',"\App\Http\Controllers\Index\GetIp\GetIpController@formatUrl");
    Route::get('/getIP/city/{code}',"\App\Http\Controllers\Index\GetIp\GetIpController@getCity");


//登陆api
    Route::post('/user/login',"\App\Http\Controllers\Index\User\UserController@loginDo");
//注册api
    Route::post('/user/reg',"\App\Http\Controllers\Index\User\UserController@regDo");
//忘记 修改密码api
    Route::post('/user/changePWD',"\App\Http\Controllers\Index\User\UserController@changePWD");

//短信验证码api
    Route::post('/user/sms',"\App\Http\Controllers\Index\User\UserController@getSms");

//下订单
    Route::group(['prefix' => 'order'],function(){
        Route::post('/addOrder/{type}',"\App\Http\Controllers\Index\Order\OrderController@addOrder");

        Route::get('/alipay/{o_id}',"\App\Http\Controllers\Index\Order\AlipayController@alipay");//支付宝吊起支付页面
        Route::get('/alipay/notify',"\App\Http\Controllers\Index\Order\AlipayController@notify");//支付宝异步回调
        Route::get('/alipay/return',"\App\Http\Controllers\Index\Order\AlipayController@return");//支付宝成功回调

        Route::get('/qrCode',"\App\Http\Controllers\Index\Order\OrderController@qrCode"); //生成二维码
        Route::post('/wechat/notify',"\App\Http\Controllers\Index\Order\WechatController@notify");//微信异步回调

        Route::get('/scan/{o_id}',"\App\Http\Controllers\Index\Order\OrderController@scanOrder");
    });
});

Route::get('/testOrder/{order_no}',"\App\Http\Controllers\Index\Order\OrderController@test");

/**
 * web路由 已登录 过中间件 用户中心
 */
Route::group(['prefix' => 'user','middleware' => 'login.index'], function () {
    //用户界面
    Route::get('/',"\App\Http\Controllers\Index\User\UserController@Index");
    Route::get('/loginOut',"\App\Http\Controllers\Index\User\UserController@loginOut");
    Route::post('/changePWDLogin',"\App\Http\Controllers\Index\User\UserController@changePWDLogin");
    //白名单
    Route::resource('/whiteList',"\App\Http\Controllers\Index\User\WhiteListController");
    Route::get('/useMoneyList',"\App\Http\Controllers\Index\User\UseMoneyController@getList");
    Route::get('/orderList',"\App\Http\Controllers\Index\User\OrderListController@getList");
});