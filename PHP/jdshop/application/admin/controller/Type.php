<?php
namespace app\admin\controller;
use think\Db;

class Type extends Common{
    //增加分类
    public function add()
    {
       if($this->request->isGet()){
           $this->fetch();
       }
    }
    //类型的列表显示
    public function index()
    {
       $data =Db::name('type')->paginate(1);
       $this->assign('data',$data);
       return $this->fetch();
    } 
    // 类型删除
    public function del()
    {
       $id = input('id/d');
       $info =Db::name('type')->where(['id'=>$id])->delete();
       

    }

}