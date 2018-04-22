<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Paper;
class PaperController extends Controller
{
    public function index()
    {
        //获取数据
        $data = Paper::get();
        //展示视图并且携带数据

       return view('admin.paper.index',compact('data')); 
    }

}
