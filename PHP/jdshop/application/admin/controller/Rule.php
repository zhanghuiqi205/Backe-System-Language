<?php
namespace app\admin\controller;
use think\Db;
/**
 * 角色控制器
 */
class Rule extends Common{
    public function add(){
        if($this->request->isGet()){
            $data  =model('Rule')->getRules();
            $this->assign('data',$data);
            return $this->fetch();
        }
        // 入库函数
        Db::name('rule')->insert(input());
        $this->success('ok');
    }
    public function index(){
        $data = model('Rule');
        $this->assign('data',$data);
        return $this->fetch();
    }
}