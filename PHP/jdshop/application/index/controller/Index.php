<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
    //获取商品各种推荐商品
       $model = model('Goods');
    //热卖商品    
       $hot = $model->getRecGoods('is_hot');
    // 
       $rec = $model->getRecGoods('is_rec');
       $new = $model->getRecGoods('is_new');
       
    }
}
