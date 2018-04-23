<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Stream;
use Input;
class StreamController extends Controller
{
    //展示视图，显示数据
    public function index()
    {
        // 获取数据
        $data = Stream::get();
        // 展示视图显示数据
        return view('admin.stream.index',compact('data'));
    }
    public function add()
    {
        // 判断请求类型(引入input)
        if(Input::method()=="POST"){
            // 提交
          $post = Input::except(['_token']);
           //需要将时间进行格式化
           $post['permited_at'] = strtotime($post['permited_at']);
           $result =  Stream::insert($post);
           if($result){
               $response = ['code'=>0,'msg'=>'流添加成功!'];
           }else{
               $response = ['code'=>1,'msg'=>'流添加失败!'];
           }

        return response()  -> json($response);



        }else{
          return view('admin.stream.add');
        }
    }
}
