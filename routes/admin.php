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
 * admin路由 未登录
 */
Route::group(['prefix' => 'admin'], function () {
    //未登陆路由
    Route::get('login', "\App\Http\Controllers\Admin\Login\IndexController@login");
    Route::group(['prefix' => 'api'], function () {
        Route::post('loginDo', "\App\Http\Controllers\Admin\Login\IndexController@loginDo");
    });

    //已登录路由 中间件
    Route::group(['middleware'=>'login.admin'],function(){
        Route::get('/', "\App\Http\Controllers\Admin\Index\IndexController@Index");//后台首页
        Route::get('loginOut', "\App\Http\Controllers\Admin\Login\IndexController@loginOut");//登出
        Route::get('changePWD', "\App\Http\Controllers\Admin\Index\IndexController@changePWD");//修改密码

        Route::resource('ArticleClass', "\App\Http\Controllers\Admin\Article\ArticleClassController");//文章分类
        Route::resource('ArticleDetail', "\App\Http\Controllers\Admin\Article\ArticleDetailController");//文章内容

        Route::resource('HelpClass', "\App\Http\Controllers\Admin\Help\HelpClassController");//帮助分类
        Route::resource('HelpDetail', "\App\Http\Controllers\Admin\Help\HelpDetailController");//帮助内容

        Route::resource('Product', "\App\Http\Controllers\Admin\Product\ProductController");//产品列表
        Route::resource('ProductHType', "\App\Http\Controllers\Admin\Product\ProductHTypeController");//产品附表

        Route::resource('LogCenter', "\App\Http\Controllers\Admin\LogCenter\LogCenterController");//日志中心查询

        Route::group(['prefix' => 'api'], function () {
            Route::post('upload/{type?}', "\App\Http\Controllers\Common\UploaderController@img");
            Route::post('sysConf', "\App\Http\Controllers\Admin\Index\IndexController@sysConf");
            Route::post('changePWD', "\App\Http\Controllers\Admin\Index\IndexController@changePWDDo");
        });
    });
});