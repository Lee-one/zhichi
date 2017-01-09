<?php

namespace App\Http\Controllers\Admin\recharge;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use Session;
use View;
class RechargeController extends AdminBaseController
{	
	//充值记录
	public function getOrder(Request $Request){
		if($Request->get('keyword')){
			$recharge = DB::table('recharge')->where('store_name','like','%'.$Request->get('keyword').'%')->paginate(10);
			return View('admin.recharge.recharge',['recharge'=>$recharge]);
		}
		$recharge = DB::table('recharge')->paginate(10);
		return View('admin.recharge.recharge',['recharge'=>$recharge]);
	}
	//充值提现规则
	public function getExchange(){
		$rule = DB::table('recharge_rule')->first();
		return View('admin.recharge.rule',['rule'=>$rule]);
	}
	//优惠赠送
	public function getDiscount(){
		$discount = DB::table('discount')->orderBy('money')->get();
		return View('admin.recharge.discount',['discount'=>$discount]);
	}

	//优惠赠送修改
	public function saveDiscount(Request $Request){
		if($Request->isMethod('post')){
			$admin_info = \Session::get('admin');
			$data = [
				'money' 		=> $Request->get('money'),
				'discount_num'	=> $Request->get('discount_num'),
				'update_time'	=> date('Y-m-d H:i:s',time()),
				'admin_id'		=> $admin_info->id,
				'admin_name'	=> $admin_info->name,
			];
			$res = DB::table('discount')->where('id',$Request->get('id'))->update($data);
			if($res){
				return response()->json(['state' => 200 ,'message'=>'修改成功']);
			}else{
				return response()->json(['state' => 300 ,'message'=>'修改失败']);
			}
		}
		$discount = DB::table('discount')->where('id',$Request->get('id'))->first();
		return View('admin.recharge.save_discount',['discount'=>$discount]);
	}

	//修改赠送删除
	public function delDiscount(Request $Request){
		DB::table('discount')->where('id',$Request->get('id'))->delete();
		return redirect('/admin/discount');
	}

	//优惠赠送添加
	public function addDiscount(Request $Request){
		if($Request->isMethod('post')){
			$admin_info = \Session::get('admin');
			$data = [
				'money' 		=> $Request->get('money'),
				'discount_num'	=> $Request->get('discount_num'),
				'update_time'	=> date('Y-m-d H:i:s',time()),
				'add_time'	=> date('Y-m-d H:i:s',time()),
				'admin_id'		=> $admin_info->id,
				'admin_name'	=> $admin_info->name,
			];
			$res = DB::table('discount')->insert($data);
			if($res){
				return response()->json(['state' => 200 ,'message'=>'添加成功']);
			}else{
				return response()->json(['state' => 300 ,'message'=>'添加失败']);
			}
		}
		return View('admin.recharge.add_discount');
	}

	//保存规则
	public function saveRule(Request $Request){
		$admin_info = \Session::get('admin');
		$data = $Request->all();
		$result = DB::table('recharge_rule')->where($data)->value('id');
		if($result){
			return response()->json(['state' => '200']);
		}
		$data['admin_id'] = $admin_info->id; 
		$data['admin_name'] = $admin_info->name; 
		$data['update_time'] = date('Y-m-d H:i:s',time());
		$res = DB::table('recharge_rule')->update($data);
		$res ? $code='200' : $code='300';
		return response()->json(['state' => $code,'msg'=>"修改失败"]);
	}
}