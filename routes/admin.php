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

        Route::resource('ArticleClass', "\App\Http\Controllers\Admin\Article\ArticleClassController");//文章分类
        Route::resource('ArticleDetail', "\App\Http\Controllers\Admin\Article\ArticleDetailController");//文章内容

        Route::resource('HelpClass', "\App\Http\Controllers\Admin\Help\HelpClassController");//文章分类
        Route::resource('HelpDetail', "\App\Http\Controllers\Admin\Help\HelpDetailController");//文章内容

        Route::group(['prefix' => 'api'], function () {
            Route::post('upload/{type?}', "\App\Http\Controllers\Common\UploaderController@img");
        });
    });
});