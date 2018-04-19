<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;     //为了验证门面
class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //关联的操作表
    protected  $table ='manager';
    //使用trait
    use Authenticatable;
    //关联角色模型， 关系是一对一的关系
    public function  rel_role(){
        return $this ->hasOne('App\Admin\Role','id','role_id');
    }
}