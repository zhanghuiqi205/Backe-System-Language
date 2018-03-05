<?php
namespace app\admin\controller;
use think\Db;
// 商品控制器
class Goods extends Common{
    // 商品添加入库
    public function add()
    {
        if($this->request->isGet()){
            $tree = model('Category')->getTree();
            $this->assign('tree',$tree);
            return $this->fetch();
        }
        $model = model('Goods');
        $retult = $model->addGoods();
        if($retult===false){
            $this->error($model->getError());
        }
        $this->success('ok');
    }
    // 商品列表展示
    public function index(){
       //获取所有的分类
        $tree =model('Category')->getTree();
        $this->assign('tree',$tree);

      //获取商品的数据 
       $model = model('Goods');
      //调用自定义的方法获取数据 (含有对数据的筛选)   
       $data = $model->listData();
    //    dump($data);
       $this->assign('data',$data);
       return $this->fetch();
    }

    // 实现对状态的切换(上架，推荐，新品，热销)
    public function setStatus()
    {
        $model = model('Goods');
        $goods_id  = input('goods_id/d');
        $field =input('field'); //类型
        $result = $model->setStatus($goods_id,$field);
        if($result===false){
            return json(['statusCode'=>0,'msg'=>$model->getError()]);
        }
        return json(['statusCode'=>1,'msg'=>'ok','status'=>$result]);
    }
   // 商品的伪删除
    public function del()
    {
        $id =input('id/d');
        Db::name('goods')->where(['id'=>$id])->setField('isdel',0);
        $this->success('ok');
    }
   // 回收站
   public function recycle()
   {
       $tree =model('Category')->getTree();
       $this->assign('tree',$tree);
       $model =model('Goods');
     //调用自定义方法获取数据
     $data = $model->listData(0);
       $this->assign('data',$data);
       return $this->fetch();
   }
   //从商品还原
   public function restore()
   {
      $id = input('id/d');
      Db::name('goods')->where(['id'=>$id])->setField('isdel',1);
      $this->success('ok');
   } 
//    彻底删除
    public function remove()
    {
        $id = input('id/d');
        Db::name('goods')->where(['id'=>$id])->delete();
        $this->success('ok');
    }
    // 编辑商品
    public function edit()
    {
        $id = input('id/d');

        if($this->request->isGet()){
            $info= Db::name('goods')->where(['id'=>$id])->find();
            
            if(!$info){
                $this->error('编辑的商品不存在');
            }
            $info['goods_body']=htmlspecialchars_decode($info['goods_body']);
            $this->assign('info',$info);

            // 获取所有的分类
            $tree = model('Category')->getTree();
            $this->assign('tree',$tree);
            return $this->fetch();
        }
        $model = model('Goods');
        $result = $model->editGoods();
        if($result===false){
            $this->error($model->getError());
        }
        $this->success('ok');
    }



    
}
