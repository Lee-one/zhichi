<?php

namespace App\Http\Controllers\Admin\store;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use Session;
use View;
class StoreController extends AdminBaseController
{
	//店铺列表
	public function getStoreList(){
		$store_list = DB::table('store')->paginate(10);
		return View('admin.store.store_list',['store_list'=>$store_list]);
	}

	//店铺详情
	public function getStoreInfo(Request $Request){
		$store_info = DB::table('store')->where('id',$Request->get('id'))->first();
		return View('admin.store.store_info',['store_info'=>$store_info]);
	}

	//店铺审核
	public function checkStore(Request $Request){
		if($Request->get('type') == 3){
			$result = DB::table('store')->where('id',$Request->get('id'))->delete();
			return redirect('/admin/store/list');
		}
		$result = DB::table('store')->where('id',$Request->get('id'))->update(['is_check'=>$Request->get('type')]);
		return redirect('/admin/store/list');
	}

	//送餐用户
	public function getUserList(){
		$user_list = DB::table('user')->paginate(10);
		return View('admin.store.user_list',['user_list'=>$user_list]);
	}
}