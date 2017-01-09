<?php

namespace App\Http\Controllers\Home\store;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Home\HomeBaseController;
use Session;
use View;
class LoginController extends HomeBaseController
{
	//注册
	public function register(Request $Request){
		if($Request->isMethod('post')){
			$error = '';
			$store = DB::table('store')->where('store_phone',$Request->get('phone'))->first();
			if($store){
				return response()->json(['status' => 0 ,'message'=>'该手机号已注册！']);
			}
			$msg = $Request->get('msg');
			$session_msg = \Session::get('msg');
			if($msg != $session_msg){
				return response()->json(['status' => 0 ,'message'=>'验证码错误！']);
			}
			if($Request->get('password') != $Request->get('repassword')){
				return response()->json(['status' => 0 ,'message'=>'密码不一致！']);
			}
			if(!$Request->get('password')){
				$error = '密码不能为空';
			}
			if(!$Request->get('phone')){
				$error = '手机号不能为空';
			}
			if(!$Request->get('store_name')){
				$error = '店铺名称不能为空';
			}
			if(!$Request->get('store_address')){
				$error = '店铺地址不能为空';
			}
			if($error){
				return response()->json(['status' => 0 ,'message'=>$error]);
			}
			$data = [
				'store_name'		=> $Request->get('store_name'),
				'store_address'		=> $Request->get('store_address'),
				'store_phone'		=> $Request->get('phone'),
				'store_password'	=> $Request->get('password'),
			];
			$res = DB::table('store')->insert($data);
			if($res){
				return response()->json(['status' => 200 ,'message'=>'注册成功,请等待审核']);
			}else{
				return response()->json(['status' => 0 ,'message'=>'注册失败']);
			}
		}
		return View('home.login.submit');
	}

	//发送验证码
	public function sendregister(Request $Request){
		$phone = $Request->get('phone');
		$res = $this->sendmsg($phone);
		\Session::put(['msg'=>$res]);
		if($res){
			return response()->json(['status' => 200 ,'message'=>'发送成功']);
		}else{
			return response()->json(['status' => 0 ,'message'=>'稍后重试']);
		}

	}

	//登录
	public function login(Request $Request){
		if($Request->isMethod('post')){
			$store = DB::table('store')->where('store_phone',$Request->get('phone'))->first();
			if(count($store)){
				if($store->is_check == 0){
					return response()->json(['status' => 0,'message'=>'账号还在审核中']);
				}
				if($store->is_check == 2){
					return response()->json(['status' => 0,'message'=>'审核未通过，请联系客户']);
				}
				if($store->store_password == $Request->get('password')){
					\Session::put(['store'=>$store]);
					return response()->json(['status' => 200,'message'=>'登录成功']);
				}else{
					return response()->json(['status' => 0,'message'=>'密码错误']);
				}
			}else{
				return response()->json(['status' => 0,'message'=>'账号不存在，请先注册']);
			}
		}
		return View('home.login.sign');
	}

	//注册须知
	public function text(){
		return View('home.login.resiger');
	}

	//用户登录
	public function userLogin(Request $Request){
		if($Request->isMethod('post')){
			$user = DB::table('user')->where('phone',$Request->get('phone'))->first();
			if(count($user)){
				if($user->password == $Request->get('password')){
					\Session::put(['user'=>$user]);
					return response()->json(['status' => 200,'message'=>'登录成功']);
				}else{
					return response()->json(['status' => 0,'message'=>'密码错误']);
				}
			}else{
				return response()->json(['status' => 0,'message'=>'账号不存在，请先注册']);
			}
		}
		return View('home.login.dl');
	}

	//用户注册
	public function userZc(Request $Request){
		if($Request->isMethod('post')){
			$error = '';
			$user = DB::table('user')->where('user',$Request->get('phone'))->first();
			if($user){
				return response()->json(['status' => 0 ,'message'=>'该手机号已注册！']);
			}
			$msg = $Request->get('msg');
			$session_msg = \Session::get('msg');
			if($msg != $session_msg){
				return response()->json(['status' => 0 ,'message'=>'验证码错误！']);
			}
			if($Request->get('password') != $Request->get('repassword')){
				return response()->json(['status' => 0 ,'message'=>'密码不一致！']);
			}
			if(!$Request->get('name')){
				$error = '名称不能为空';
			}
			if(!$Request->get('password')){
				$error = '密码不能为空';
			}
			if(!$Request->get('phone')){
				$error = '手机号不能为空';
			}
			if($error){
				return response()->json(['status' => 0 ,'message'=>$error]);
			}
			$data = [
				'name'		=> $Request->get('name'),
				'phone'		=> $Request->get('phone'),
				'password'	=> $Request->get('password'),
			];
			$res = DB::table('user')->insert($data);
			if($res){
				return response()->json(['status' => 200 ,'message'=>'注册成功']);
			}else{
				return response()->json(['status' => 0 ,'message'=>'注册失败']);
			}
		}
		return View('home.login.zc');
	}
}