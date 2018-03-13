<?php
namespace app\admin\model; 
use think\Model; 

class  RoleRule extends  Model {
    public function disfetch($role_id,$rules)
    {
        RoleRule::where(['role_id'=>$role_id])->delete();
        $list=[];
        foreach ($rules as $key => $value) {
           $list[]=['role_id'=>$role_id,'rule_id'=>$value];
        }  
        if($list){
            RoleRule::insertAll($list);
        }
    }
    public function getRuleById($role_id)
    {
        $data = RoleRule::where(['role_id'=>$role_id])->select();
        $rule_ids =[];
        foreach ($data as $key => $value) {
            $rule_ids[]= $value->getAttr('rule_id');
        }
        $ids = implode(',',$rule_ids);
        return $ids;
    }
}