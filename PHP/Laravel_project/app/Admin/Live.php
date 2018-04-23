<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    //关联的数据表
    protected $table ='live';
    public function rel_profession()
    {
      return $this->hasOne('App\Admin\Profession','id','profession_id');  
    }

    public function rel_stream ()
    {
        return $this->hasOne('App\Admin\Stream','id','stream_id');
    }


}
