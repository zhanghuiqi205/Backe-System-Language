<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //关联数据表
    protected $table = "profession";
    public function rel_protype()
    {
        return $this->hasOne('App\Admin\Protype','id','protype_id');
    }
}
