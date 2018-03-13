<?php
namespace app\admin\model; 
use think\Model; 

// 实现无限极分类
class  Rule extends  Model {


    //
    public function getRules($id=0,$isClear=false){
        // 1.获取所有分类信息
        $list =Rule::all();
        return get_cate_tree($list,$id,1,$isClear); 
    }
    public function edit(){
        //接受数据
        $data = input();
        //修改数据不能设置自己为自己的父分类
        if($data['id']==$data['parent_id']){
          $this->error="设置自己为自己的父类";
          return false;
        }
        // 修改数据不能设置父分类为自己的子分类
        $tree =$this->getRules($data['id']);
        foreach ($tree as $key => $value) {
           if($data['parent_id']==$value['id']){
               $this->error='不能成为自己的子分类';
               return false;
           }
        }
        Rule::isUpdate(true)->save($data);
    }
     
    // 删除方法
    public function del($id){
      //检查是否存在子分类 
       $hasSon =Rule::get(['parent_id'=>$id]);
       if($hasSon){
          //存在子分类 
          $this->error ="存在子分类";
           return false;
       }
      //没有子分类直接删除
       $res = Rule::destroy($id);
       if($res===false){
        $this->error ="删除失败";
        return false;
       }
       return true;
    }

    
}