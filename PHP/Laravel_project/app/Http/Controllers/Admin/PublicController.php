<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;  //已经定义别名，可以简写

class PublicController extends Controller
{
    //登录界面
    public  function  login(){
        return view('admin.public.login');
    }
    //进行数据的有效性验证
    public  function check(Request $request){
        $this ->validate($request,[
            'username'              => 'required|min:2|max:20',
            'password'              => 'required|min:6',
            'geetest_challenge'     => 'required|geetest'
        ],[
            'geetest'          =>config('geetest.server_fail_alert')
        ]);
    //进行身份认证
        $data =$request ->only(['username','password']);
        $data['status']='2';
        if($res =Auth::guard('diy_admin') ->attempt($data,$request ->get('online'))){
//            成功，去后台
            return redirect('/admin/index/index');
        }else{
//           失败，再次登录
            return redirect('/admin/public/login')->withErrors([
               'loginErr'  =>'用户名或者密码错误！'
            ]);
        }

    }
    public  function logout(){
       Auth::guard('diy_admin')->logout();
       return redirect('/admin/public/login');
    }
}
