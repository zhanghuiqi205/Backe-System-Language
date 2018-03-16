<?php
namespace app\index\controller;
use think\Db;

class Goods extends Common
{
    public function index()
    {
        $id = inpput('id/d');
        if($id<0){
            $this->redirect('index/index/index');
        }
        //获取商品的基本信息
        $obj=Db::name('goods');
        $goodsInfo=$obj->where(['id'=>$id])->find();
        if(!$goodsInfo){
            $this->redirect('index/index/index');
        }
        $goodsInfo['goods_body']=htmlspecialchars_decode($goodsInfo['goods_body']);
        $this->assign('goodsInfo',$goodsInfo);
        // 获取商品相册信息
        $img =Db::name('goods_img')->where(['goods_id'=>$id])->select();
        $this->assign('img',$img);
        return view();
    }
}
