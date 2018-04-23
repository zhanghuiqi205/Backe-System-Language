<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Live;
use App\Admin\Profession;
class IndexController extends Controller
{
    //展示前台首页
    public function index()
    {
        // 获取首页的直播列表
        $live = Live::where('status','1')->orderBy('sort','desc')->get();
        //循环处理直播状态
        foreach ($live as $key => $value) {
           if(time()>$value ->end_at){
               $value ->live_status ='直播已结束';
           }
           if(time()<$value ->begin_at){
               $value ->live_status ='直播未开始';
           }
           if(time()>$value ->begin_at && time()<$value->end_at){
               $value ->live_status ='直播中';
           }
        }
        // 获取专业列表
        $profession = Profession::orderBy('sort','desc')->get();
        // 展示前台首页
        return view('home.index.index',compact('live','profession'));
    }
}
