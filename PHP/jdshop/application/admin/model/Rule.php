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

    
}