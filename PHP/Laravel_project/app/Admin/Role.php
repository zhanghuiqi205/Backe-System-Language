<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //关联指定数据表
    protected  $table ='role';
//    禁用使用事件更新
    public  $timestamps =false;

    public  function assignAuth($tmp){
        
        $data['auth_ids']= implode($tmp['auth_id'],',');
//        查询全部符合条件的记录 取出其中的controller和action
        $auth = \App\Admin\Auth::where('pid','!=','0')->whereIn('id',$tmp['auth_id'])->select('controller','action')->get();
//        循环取出控制器和方法
        $data['auth_ac'] ='';
        foreach ($auth as $key=>$value){
            $data['auth_ac'].=$value ->controller .'@'.$value->action .',';
        }
//       去除末尾的逗号
        $data['auth_ac'] = rtrim($data['auth_ac'],',');
//        将数据写入到数据表中去
        return Role::where('id',$tmp['id'])->update($data);
    }
}
