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
    }
}
