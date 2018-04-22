<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    //关联数据表
    protected $table = 'paper';

    /**
     * 关联关系
     */
    public function rel_course()
    {
       return $this ->hasOne('App\Admin\Course','id','course_id');
    }
}
