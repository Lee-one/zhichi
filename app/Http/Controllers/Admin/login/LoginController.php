<?php

namespace App\Http\Controllers\Admin\login;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use Session;
use DB;
use App\Model\Admin;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
class LoginController extends AdminBaseController
{
    /*
     * 登录页面
     */
    public function index() {
        return view('admin.login.login');
    }

    public function admin(){
        if(!\Session::get('admin')){
            return View('admin.login.login');
        }
        return View('admin.common.main');
    }


    /*
     * 验证用户登录
     */
    public function checkLogin(Request $request) {
        $errors = [];
        $data = $request->except(['_token']);
        $code = \Session::get('imageCode');

        $rules = [
            'username' => 'required',
            'password' => 'required',
            'code' => 'required',
        ];
        $errorMessage = [
            'username.required' => '密码不能为空',
            'password.required' => '密码不能为空',
            'code.required' => '密码不能为空',
        ];
        $this->validate($request , $rules , $errorMessage);
        if ($code != $data['code'])   $errors['code'] =  '验证码不正确';
        $user = DB::table('admin')->where('name', $data['username'])->first();
        if (count($user) == 0)
        {
            $errors['username'] =  '用户名不存在';
        }else
        {	
        	// !Hash::check($data['password'] , $user->password)
            if ($data['password'] != $user->password) $errors['password'] =  '密码不正确';
        }
        if (count($errors) > 0)
        {
            return back()->withInput($data)->withErrors($errors);
        }
        // Auth::login($user);
        \Session::put(['admin'=>$user]);
        return redirect('/admin');
    }


    //退出登录
    public function logout(Request $request)
    {
        // Auth::logout();
        $request->session()->flush();
        return redirect('admin/login');
    }

  }