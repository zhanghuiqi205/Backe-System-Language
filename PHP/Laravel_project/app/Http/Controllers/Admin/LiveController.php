<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Live;
class LiveController extends Controller
{
    //直播课程列表
    public function index()
    {
        $data = Live::get();
        return view('admin.live.index',compact('data'));
    }
}
