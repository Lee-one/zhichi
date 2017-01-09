<?php

namespace App\Http\Controllers\Home\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Home\HomeBaseController;
use Session;
use View;
class UserController extends HomeBaseController
{
	//我要送餐
	public function user(){
		$user = \Session::get('user');
		if(!$user){
			return View('home.login.dl');
		}
		return View('home.user.get');
	}

	//领取酬劳
	public function getMoney(Request $Request){
		if($Request->isMethod('post')){
			$uid = \Session::get('user')->id;
			$order_sn = $Request->get('order_sn');
			$order = DB::table('order')->where('order_sn',$order_sn)->first();
			if($order){
				if($order->uid){
					return response()->json(['status' => 0,'message'=>'订单已领取']);
				}
			}else{
				return response()->json(['status' => 0,'message'=>'编码有误']);
			}
			//优化从缓存拿
			$exchange = DB::table('recharge_rule')->value('exchange');
			DB::beginTransaction();
			$res = DB::table('order')->where('order_sn',$order_sn)->update(['uid'=>$uid,'over_time'=>time()]);
			$result1 = DB::table('user')->where('id',$uid)->increment('order_num');
			$result2 = DB::table('user')->where('id',$uid)->increment('order_momey',$exchange);
			$result3 = DB::table('user')->where('id',$uid)->increment('user_momey',$exchange);
			if($res&&$result1&&$result2&&$result3){
				DB::commit();
				return response()->json(['status' => 200,'message'=>'领取成功']);
			}else{
				DB::rollBack();
				return response()->json(['status' => 0,'message'=>'系统出错']);
			}
		}
		return View('home.user.lqu');
	}

	//我的
	public function userInfo(){
		$uid = \Session::get('user')->id;
		//本周统计
		//历史统计
		$user_info = DB::table('user')->where('id',$uid)->select('order_num','order_momey')->first();
		return View('home.user.my_one',['user_info'=>$user_info]);
	}

	//送餐提现
	public function userReflect(Request $Request){
		$uid = \Session::get('user')->id;
		$u_money = DB::table('user')->where('id',$uid)->first();
		if($Request->isMethod('post')){
			$msg = '';
			$name = $Request->get('name');
			$account = $Request->get('account');
			$momey = $Request->get('momey');
			if($momey > $u_money->user_momey){
				$msg = '输入金额有误！';
			}
			if(!$name){
				$msg = '账号名不能为空！';
			}
			if(!$account){
				$msg = '账号不能为空！';
			}
			if(!$momey){
				$msg = '提现金额不能为空';
			}
			if(!empty($msg)){
				return response()->json(['status'=>0,'message'=>$msg]);
			}
			$data = [
				'user_momey' => $u_money->user_momey-$momey,
				'reflect_momey' => $momey,
			];
			$reflect = [
				'uid'				=> $uid,
				'refeact_account'	=>$account,
				'account_name'		=>$name,
				'reflect_momey'		=>$momey,
				'reflect_time'		=>date('Y-m-d H:i:s',time()),
			];
			$res = DB::table('user')->where('id',$uid)->update($data);
			$result = DB::table('user_refeact')->insert($reflect);
			if($res && $result){
				return response()->json(['status' => 200,'message'=>'申请成功']);
			}else{
				return response()->json(['status' => 0,'message'=>'系统出错']);
			}
		}
		
		return View('home.user.lqu_three',['money'=>$u_money]);
	}

	//提现成功
	public function reflectSuccess(){
		$uid = \Session::get('user')->id;
		$u_money = DB::table('user')->where('id',$uid)->first();
		return View('home.user.lqu_four',['momey'=>$u_money]);
	}

	//查看历史记录
	public function userHistory(){
		$uid = \Session::get('user')->id;
		$order_list = DB::table('order')->where('uid',$uid)->take('50')->get();
		$user_info = DB::table('user')->where('id',$uid)->first();
		return View('home.user.lqu_two',['order_list'=>$order_list,'user_info'=>$user_info]);
	}
}