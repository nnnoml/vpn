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
    Route::get('/ipList',"\App\Http\Controllers\Index\IpList\IndexController@Index");
    //使用帮助
    Route::group(['prefix' => 'help'], function () {
        Route::get('/',"\App\Http\Controllers\Index\Help\IndexController@Index"); //文档中心
        Route::get('/school',"\App\Http\Controllers\Index\Help\IndexController@School"); //新手学堂
        Route::get('/search',"\App\Http\Controllers\Index\Help\IndexController@Search");//检索列表
        Route::get('/{hc_id}/{id}', "\App\Http\Controllers\Index\Help\IndexController@Detail");//帮助内容
    });
//获取API
Route::get('/getIP',"\App\Http\Controllers\Index\GetIp\IndexController@Index");
Route::post('/getIP',"\App\Http\Controllers\Index\GetIp\IndexController@formatUrl");

Route::any('/do',"\App\Http\Controllers\Index\Index\IndexController@do");

/**
 * web路由 已登录 过中间件 用户中心
 */
//
//Route::get('/', function () {
//    echo "212323.....";
//    //return view('welcome');
//});