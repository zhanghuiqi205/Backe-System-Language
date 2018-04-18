<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
//   首页
    public function index(){
        return view('admin.index.index');
    }
//   欢迎页
    public  function welcome(){
        return  view('admin.index.welcome');
    }
}
