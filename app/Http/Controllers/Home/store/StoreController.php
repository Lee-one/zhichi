<?php

namespace App\Http\Controllers\Home\store;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Home\HomeBaseController;
use Session;
use View;
class StoreController extends HomeBaseController
{
	//我是商家
	public function store(){

		$store = \Session::get('store');
		if(!$store){
			return View('home.login.sign');
		}
		return View('home.store.out');
	}

	//发单
	public function serOrder(Request $Request){
		if($Request->isMethod('post')){
			$sid = \Session::get('store')->id;
			$order_num = DB::table('store')->where('id',$sid)->value('order_num');
			if($order_num<0){
				return response()->json(['status' => 0 ,'message'=>'无可用编码']);
			}
			$phone = $Request->get('phone');
			if(!$phone){
				return response()->json(['status' => 0 ,'message'=>'手机号不能为空']);
			}
			$sn = $this->send($phone);
			if($sn){
				$data = [
					'store_id' 	  => $sid,
					'order_sn'    => $sn,
					'order_phone' => $phone,
					'add_time'	  => date('Y-m-d H:i:s',time()),
				];
				DB::beginTransaction();
				$res = DB::table('store')->where('id',$sid)->decrement('order_num');
				$res = DB::table('store')->where('id',$sid)->increment('history_num');
				$result = DB::table('order')->insert($data);
				if($res && $result){
					DB::commit(); 
					return response()->json(['status' => 200 ,'message'=>'发单成功']);
				}else{
					DB::rollBack();
					return response()->json(['status' => 0 ,'message'=>'系统繁忙']);
				}
			}else{
				return response()->json(['status' => 0,'message'=>'发单失败请联系客户']);
			}
		}
		return View('home.store.fadan');
	}

	//充值
	public function recharge(){
		return View('home.store.czhi');
	}

	//我的
	public function storeInfo(){
		$sid = \Session::get('store')->id;
		$store_info = DB::table('store')->where('id',$sid)->first();
		return View('home.store.my',['store_info'=>$store_info]);
	}

	// //查看可用编码
	// public function usableCode(){
	// 	return View('home.store.my_two');
	// }

	//查看发单记录
	public function orderNotes(){
		$sid = \Session::get('store')->id;
		$store_info = DB::table('store')->where('id',$sid)->first();
		$order_list = DB::table('order')->where('store_id',$sid)->take('50')->get();
		return View('home.store.my_three',['store_info'=>$store_info,'order_list'=>$order_list]);
	}

	//查看充值记录
	public function rechargeNotes(){
		$sid = \Session::get('store')->id;
		$rec_list = DB::table('recharge')->where('store_id',$sid)->take('50')->get();
		return View('home.store.my_four',['rec_list'=>$rec_list]);
	}
}