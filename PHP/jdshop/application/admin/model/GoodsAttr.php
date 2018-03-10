<?php
namespace app\admin\model;
use think\Model;
use think\Db;


// 商品属性模型
class GoodsAttr extends Model{
    // 商品属性的值的批量添加
    public function insertAllAttr($goods_id,$attr){
        
        $list =[];
        if(!$attr){
            return;
        }
        foreach ($attr as $key => $value) {
            $value =array_unique($value);
            foreach ($value as  $v) {
                $list[]=[
                   'goods_id'=>$goods_id,
                   'attr_id'=>$key,
                   'attr_value'=>$v
                ];
            }
        }
        if($list){
            Db::name('goods_attr')->insertAll($list);
        }

    }




}
