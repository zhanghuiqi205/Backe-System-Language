<?php
namespace app\admin\controller;
use think\Db;

class Type extends Common{
    //增加分类
    public function add(){
       if($this->request->isGet()){
          return $this->fetch();
       }
       $data = input();
       Db::name('type')->insert($data);
     $this->success('ok');
    }
    //类型的列表显示
    public function index(){
       $data =Db::name('type')->paginate(1);
       $this->assign('data',$data);
       return $this->fetch();
    } 
    // 类型删除
    public function del(){
       $id = input('id/d');
       $info =Db::name('type')->where(['id'=>$id])->delete();
       $this->success('ok','index');  
    }
    public function edit()
    {
        $id = input('id');
        if($this->request->isGet()){
           $info = Db::name('type')->where(['id'=>$id])->find();
           if(!$info){
               $this->error("参数错误");
           }
           $this->assign('info',$info);
           return $this->fetch();
        }
        Db::name('type')->where(['id'=>$id])->update(['type'=>input('type')]);
        $this->success('ok');
    }

}