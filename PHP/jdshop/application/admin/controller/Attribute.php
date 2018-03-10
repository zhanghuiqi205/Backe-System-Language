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
    public function index()
    {
        $model = model('Attribute');
        $data = $model->listData();
        $this->assign('data',$data);
        return $this->fetch();
    }
}
