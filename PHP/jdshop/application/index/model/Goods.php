<?php
namespace app\index\model; 
use think\Model; 


// 创建管理员模型
class  Goods extends  Model {
    public function getRecGoods($field)
    {
        return Goods::where([$field=>1])->limit(5)->order('id desc')->select();
    }
}