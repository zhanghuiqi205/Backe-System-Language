<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Protype;
class ProtypeController extends Controller
{
    //展示视图
    public function index()
    {
       
       $data = Protype::get();
       return view('admin.protype.index',compact('data'));
    }
}
