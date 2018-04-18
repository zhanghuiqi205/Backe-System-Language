<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //关联的操作表
    protected  $table ='manager';
    //使用trait
    use Authenticatable;
}
