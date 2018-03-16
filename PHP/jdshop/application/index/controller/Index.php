<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
    //获取商品各种推荐商品
       $model = model('Goods');
    //热卖商品    
       $hot = $model->getRecGoods('is_hot');
    // 推荐商品
       $rec = $model->getRecGoods('is_rec');
    // 最新上线
       $new = $model->getRecGoods('is_new');
       return view('index',['hot'=>$hot,'new'=>$new,'rec'=>$rec,'is_show'=>1]);
    }
}
