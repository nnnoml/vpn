<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//api获取vpn配置项，预留
Route::get('/vpnConf/{vpn_id?}', "\App\Http\Controllers\Api\ConfController@GetVpnConf");
