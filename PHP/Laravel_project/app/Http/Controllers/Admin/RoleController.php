<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Admin\Auth;
class RoleController extends Controller
{
    //展示角色列表并且展示视图
    public  function  index(){
        //获取数据
        $data = Role::get();
        //展示视图
        return view('admin.role.index',compact('data'));
    }
    public  function  assign(){
          if(Input::method()=='POST'){
            // 调用自定义方法去实现权限分派
              $role = new Role();
              
            //调用自定义方法去实现权限分派
              $result =$role ->assignAuth(Input::only(['id','auth_id']));
              if($result){
                  $response =[
                      'code' => '0',
                      'msg'  => '权限分派成功!'
                  ];
              }else{
                //失败
                  $response =[
                      'code' => '1',
                      'msg'  => '权限分派失败!'
                  ];
              }
            //ajax响应
              return response() ->json($response);

          }else{
        
          //获取当前正在操作的role_id     获取角色的信息
          $role = Role::find(Input::get('id'));//前面需要引入input
          
           //获取当前网站的全部信息
          $one = Auth::where('pid','0')->get();
          $two = Auth::where('pid','!=','0')->get();
          return view('admin.role.assign',compact('role','one','two'));
        }
    }
}
