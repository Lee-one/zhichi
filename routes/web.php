<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home.store.index');
});

/*
	我是商家
*/

//商家注册
Route::any('/register', 'Home\store\LoginController@register');	
//发送验证码
Route::post('/send', 'Home\store\LoginController@sendregister');
//登录
Route::any('/login', 'Home\store\LoginController@login');
//注册须知
Route::get('/text', 'Home\store\LoginController@text');

//我是商家
Route::get('/store', 'Home\store\StoreController@store');
//发单
Route::any('/set/order', 'Home\store\StoreController@serOrder');
//充值
Route::get('/recharge', 'Home\store\StoreController@recharge');
//我的
Route::get('/store/info', 'Home\store\StoreController@storeInfo');
//查看可用编码   
Route::get('/usable/code', 'Home\store\StoreController@usableCode');
//查看发单记录
Route::get('/order/notes', 'Home\store\StoreController@orderNotes');
//查看充值记录
Route::get('/recharge/notes', 'Home\store\StoreController@rechargeNotes');


/*
	我要送餐
*/
//用户注册
Route::any('/user/zc', 'Home\store\LoginController@userZc');
//用户登录
Route::any('/user/dl', 'Home\store\LoginController@userLogin');
//我要送餐
Route::get('/user', 'Home\user\UserController@user');
//领取酬劳
Route::any('/user/get/money', 'Home\user\UserController@getMoney');
//我的
Route::get('/user/info', 'Home\user\UserController@userInfo');
//送餐提现
Route::any('/user/reflect', 'Home\user\UserController@userReflect');
//提现成功
Route::get('/reflect/success', 'Home\user\UserController@reflectSuccess');
//查看历史记录
Route::get('/user/history', 'Home\user\UserController@userHistory');

