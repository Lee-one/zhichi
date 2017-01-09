<?php

namespace App\Http\Controllers\Admin\refeact;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use Session;
use View;
class RefeactController extends AdminBaseController
{	
	//待处理
	public function deal(){
		$ref_list = DB::table('user_refeact')->where('is_deal',0)->join('user','user_refeact.uid','=','user.id')->paginate(10);
		return View('admin.refeact.refeact_list',['ref_list'=>$ref_list]);
	}

	//处理
	public function dealWith(Request $Request){
		$admin = \Session::get('admin');
		$data = [
			'is_deal' => 1,
			'admin_name' => $admin->name,
			'admin_id'	 => $admin->id,
			'deal_time'  => date('Y-m-d H:i:s',time()),
		];
		$res = DB::table('user_refeact')->where('id',$Request->get('id'))->update($data);
		return redirect('/admin/deal');
	}

	//已处理
	public function overDeal(){
		$ref_list = DB::table('user_refeact')->where('is_deal',1)->join('user','user_refeact.uid','=','user.id')->paginate(10);
		return View('admin.refeact.over_list',['ref_list'=>$ref_list]);
	}
}