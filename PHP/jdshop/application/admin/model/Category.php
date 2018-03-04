<?php
namespace app\admin\model; 
use think\Model; 



// 实现无限极分类
class  Category extends  Model {
    //实现将分类数据进行格式化操作
    public function getTree($id=0,$isClear=false){
       //1.获取所有的分类信息
        $list = Category::all();
       // 2.将分类信息进行格式化,调用公共函数
        return get_cate_tree($list,$id,1,$isClear);
    }

    public function edit()
    {
        //接受数据
        $data = input();
        //修改数据不能设置自己为自己的父分类
        if($data['id']==$data['parent_id']){
          $this->error="设置自己为自己的父类";
          return false;
        }
        // 修改数据不能设置父分类为自己的子分类
        $tree =$this->getTree($data['id']);
        foreach ($tree as $key => $value) {
           if($data['parent_id']==$value['id']){
               $this->error='不能成为自己的子分类';
               return false;
           }
        }
        Category::isUpdate(true)->save($data);
    }

    public function del($id)
    {
      //检查是否存在子分类 
       $hasSon =Category::get(['parent_id'=>$id]);
       if($hasSon){
          //存在子分类 
          $this->error ="存在子分类";
           return false;
       }
      //没有子分类直接删除
       $res = Category::destroy($id);
       if($res===false){
        $this->error ="删除失败";
        return false;
       }
       return true;
    }
    
}