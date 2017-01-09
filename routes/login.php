<?php

/*
|--------------------------------------------------------------------------
| login Routes
|--------------------------------------------------------------------------
|
| 后台登录模块路由
|
*/


Route::get('/admin/login', 'Admin\login\LoginController@index');

// 验证码
Route::get('imagecode', 'PublicController@code');

// 后台登录检验
Route::post('/admin/check_login', 'Admin\login\LoginController@checkLogin');

//退出登录
Route::get('/admin/logout', 'Admin\login\LoginController@logout');
//主页面
Route::get('/admin', 'Admin\login\LoginController@admin');

