<?php
namespace app\admin\controller;
use think\Db;

class Attribute extends Common{
    public function add(){
        if($this->request->isGet()){
           $type =Db::name('type')->select();
           dump($type);
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
}
