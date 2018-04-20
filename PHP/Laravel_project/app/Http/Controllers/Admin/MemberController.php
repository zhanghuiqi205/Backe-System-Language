<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Member;
use Input;
use DB;
class MemberController extends Controller
{
    //获取数据
    public function index()
    {
        //获取数据
        $data = Member::get();
        //传递给视图区展示数据
        return view('admin.member.index',compact('data'));
    }

    public function add()
    {
        
        if(Input::method()=="POST"){
            //post请求
            $data = Input::except(['_token','file']);
            //密码加密
            $data['password']=bcrypt($data['password']);
            //当前时间
            $data['created_at'] = date('Y-m-d H:i:s');
            //写入数据库
            $result = Member::insert($data);

            if($result){
                $response =['code' =>0,'msg' =>'用户添加成功'];
            }else{
                $response =['code' =>1,'msg' =>'用户添加失败'];
            }

            // json返回
            return response() ->json($response);

        }else{
            
            //get请求
            $country = DB::table('area')->where('pid','0')->get();
            return view('admin.member.add',compact('country'));
        }
    }


    // 获取地区的函数(四级联动)
    public function getAreaById()
    {
        // 获取父级地区的id值
        $id = Input::get('id');
        // 查询数据表，获取子级的地区
        $data =DB::table('area')->where('pid',$id)->get();
        //json格式输出

        return response() ->json($data);
    }


}
