<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    //登录界面
    public  function  login(){
        return view('admin.public.login');
    }
}
