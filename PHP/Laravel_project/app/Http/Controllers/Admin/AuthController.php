<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\Admin\Auth;
use DB;
class AuthController extends Controller
{
    //权限列表展示页面(自连主要是想获得上级权限的名称)
    public  function index(){
//      展示视图
        $data =DB::table("auth as t1")->select('t1.*','t2.auth_name as parent_name')->leftJoin('auth as t2','t1.pid','=','t2.id')->get();
        return view('admin.auth.index',compact('data'));
    }

    public  function  add(){
//        判断请求类型
        if(Input::method()=='POST'){
//            post 请求
            //自动验证.... 
            $data =Input::except(['_token']);
            //开始写入数据库
            $result = Auth::insert($data);
            // 判断结果（api）
            if($result){
                $response =[
                   'msg'  =>'权限添加成功！',
                   'code' =>'0'
                ];
            }else{
                $response =[
                    'msg'  =>'数据失败',
                    'code' =>'1'
                ];
            }
            return response()->json($response);
        }else{
//            get请求,让其显示顶级选项.
            $parent =Auth::where('pid','0')->get();
            return view('admin.auth.add',compact('parent'));
        }
    }
}
