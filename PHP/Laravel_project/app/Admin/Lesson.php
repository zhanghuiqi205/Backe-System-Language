<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //关联数据表
    protected $table ='lesson';

    public function rel_course()
    {
        return $this->hasOne('App\Admin\Course','id','course_id');
    }
}
