<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    //关联指定的表
    protected  $table ="auth";
    public  $timestamps =false;
}
