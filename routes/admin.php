<?php

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| 后台模块路由
|
*/

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminAuth'], function () {

	/*
		管理员
	*/
	//列表
	Route::get('/user/list', 'Admin\user\AdminController@getUserList');
	//编辑 
	Route::any('/user/edit', 'Admin\user\AdminController@editUser');
	//添加
	Route::any('/user/add', 'Admin\user\AdminController@addUser');
	//删除 
	Route::any('/user/del', 'Admin\user\AdminController@delUser');

	/*
		店铺
	*/
	//列表
	Route::get('/store/list', 'Admin\store\StoreController@getStoreList');
	//详情
	Route::get('/store/info', 'Admin\store\StoreController@getStoreInfo');
	//审核
	Route::get('/store/check', 'Admin\store\StoreController@checkStore');

	/*
		充值
	*/
	//充值记录
	Route::any('/price', 'Admin\recharge\RechargeController@getOrder');
	//充值提现规则
	Route::get('/exchange', 'Admin\recharge\RechargeController@getExchange');
	//保存规则
	Route::post('/rule/save', 'Admin\recharge\RechargeController@saveRule');
	//优惠赠送
	Route::get('/discount', 'Admin\recharge\RechargeController@getDiscount');
	//优惠赠送修改
	Route::any('/discount/save', 'Admin\recharge\RechargeController@saveDiscount');
	//优惠赠送添加
	Route::any('/discount/add', 'Admin\recharge\RechargeController@addDiscount');
	//优惠赠送删除
	Route::get('/discount/del', 'Admin\recharge\RechargeController@delDiscount');

	/*
		提现管理
	*/
	//提现待处理
	Route::any('/deal', 'Admin\refeact\RefeactController@deal');
	//提现待处理
	Route::any('/deal/with', 'Admin\refeact\RefeactController@dealWith');
	//提现已处理
	Route::any('/over/deal', 'Admin\refeact\RefeactController@overDeal');

	/*
		送餐用户
	*/
	Route::any('/sc/user', 'Admin\store\StoreController@getUserList');
});
