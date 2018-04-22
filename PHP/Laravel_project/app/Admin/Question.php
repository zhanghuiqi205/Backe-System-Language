<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //数据表
    protected $table = 'question';
    public function rel_paper()
    {
        return $this->hasOne('App\Admin\Paper','id','paper_id');
    }
    
}
