<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //关联的数据表
    protected $table ='course';
    public function rel_profession()
    {
       return $this ->hasOne('App\Admin\Profession','id','profession_id');
    }
}
