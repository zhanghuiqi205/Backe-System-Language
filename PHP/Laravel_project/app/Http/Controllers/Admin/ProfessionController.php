<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Profession;
class ProfessionController extends Controller
{
    //专业列表
     public function index()
     {
         $data = Profession::get();
         return view('admin.profession.index',compact('data'));
     }
}
