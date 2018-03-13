<?php
namespace app\admin\controller;
use think\Db;
/**
 * 角色控制器
 */
class Role extends Common{

    // 角色添加
     public function add(){
         if($this->request->isGet()){
             return $this->fetch();
         }
         Db::name('role')->insert(input());
         $this->success('ok');
     }
    // 角色列表页展示
    public function index(){
        $data =Db::name('role')->select();
        return $this->fetch('index',['data'=>$data]);
    }
    public function del()
    {
        $id =input('id/d');
        if($id<=1){
            $this->error('参数错误');
        }
        Db::name('role')->where(['id'=>$id])->delete();
        $this->success('ok','index');
    }
    // 角色编辑
    public function edit()
    {
        $id =input('id/d');
        if($id<=1){
            $this->error('参数错误');
        }
        if($this->request->isGet()){
            $info =Db::name('role')->where(['id'=>$id])->find();
            return $this->fetch('edit',['info'=>$info]);
        }
        $data = input();
        Db::name('role')->where(['id'=>$id])->update($data);
        $this->success('ok','index');
    }
    // 实现权限分配
    public function disfetch()
    {
        $model = model('RoleRule');
        $role_id = input('id/d');
        if($this->request->isGet()){
            $hasRules = $model->getRuleById($role_id);
            $this->assign('hasRules',$hasRules);
            $rules = model('Rule')->getRules();
            $this->assign('rules',$rules);
            return $this->fetch();
        }
        $role_id =input('id/d');
        $rules = input('rule/a');
        $model->disfetch($role_id,$rules);
        $this->success('ok'); 
    }


}