<?php

namespace App\Http\Controllers\Admin\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use Session;
use App\Model\Admin;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
class AdminController extends AdminBaseController
{
	//管理员账号列表
	public function getUserList(){
		$user_list = DB::table('admin')->get();
		return View('admin.user.user_list',['user_list'=>$user_list]);
	}

	//编辑管理员
	public function editUser(Request $Request){
		if($Request->isMethod('post')){
			$data = $Request->all();
			unset($data['id']);
			$res = DB::table('admin')->where('id',$Request->get('id'))->update($data);
			$res ? $code='200' : $code='300';
			return response()->json(['state' => $code,'msg'=>"修改失败"]);
		}else{
			$detail = DB::table('admin')->where('id',$Request->get('id'))->first();
			return View('admin.user.edit',['detail'=>$detail]);
		}
		
	} 

	//添加管理员
	public function addUser(Request $Request){
		if($Request->isMethod('post')){
			$data = $Request->all();
			$res = DB::table('admin')->where('id',$Request->get('id'))->insert($data);
			$res ? $code='200' : $code='300';
			return response()->json(['state' => $code,'msg'=>"添加失败"]);
		}else{
			return View('admin.user.add');
		}
	}

	//删除管理员
	public function delUser(Request $Request){
		$res = DB::table('admin')->where('id',$Request->get('id'))->delete();
		return redirect('/admin/user/list');
	}
}