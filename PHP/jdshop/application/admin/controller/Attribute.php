<?php
namespace app\admin\controller;
use think\Db;

class Attribute extends Common{
    public function add(){
        if($this->request->isGet()){
           $type =Db::name('type')->select();
        //    dump($type);
           $this->assign('type',$type);
           return $this->fetch();
        }
        $model = model('Attribute');
        $result = $model->addAttribute();
        if($result===false){
            $this->error($model->getError());
        }
        $this->success('ok');

    }

    // 实现属性列表显示
    public function index(){
        $model = model('Attribute');
        $data = $model->listData();
        dump($data);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function del()
    {
       $id =input('id');
       $model =model('Attribute');
       $model->where(['id'=>$id])->delete();
       $this->success('ok','index');
    }
    public function edit()
    {
        $id = input('id');
        $model = model('Attribute');
        if($this->request->isGet()){
            $info = $model->where(['id'=>$id])->find();
            if(!$info){
                $this->error('fail');
            }
            $this->assign('info',$info);
            // 获取所有类型
            $type =Db::name('type')->select();
            $this->assign('type',$type);
            return $this->fetch();
        }
        $result = $model->editAttribute();
        if($result ===false){
            $this->error($model->getError());
        }
        $this->success('ok');

    }

}
