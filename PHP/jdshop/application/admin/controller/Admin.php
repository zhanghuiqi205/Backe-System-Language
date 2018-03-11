<?php
namespace app\admin\controller;
use think\Db;

/**
 * 管理员控制器
 */
class Admin extends Common{
   public function add(){
       if($this->request->isGet()){
           $role =Db::name('role')->select();
           return $this->fetch('add',['role'=>$role]);
       }
       $data = input();
       $obj=validate('Admin');
       if(!$obj->check($data)){
           $this->error($obj->getError());
       }
      // 对密码进行加密
      $data['password']=md5($data['password']);
      //写入用户信息表
      Db::name('admin')->insert(['username'=> $data['username'],'password'=>$data['password']]);
      $admin_id =Db::name('admin')->getLastInsId();
      Db::name('admin_role')->insert(['admin_id'=> $admin_id,'role_id'=>$data['role_id']]);
       $this->success('ok');
   }
   public function index()
   {
       $list =Db::name('admin')->alias('a')->join('jd_admin_role b','a.id =b.admin_id','left')->join('jd_role c','b.role_id=c.id','left')->field('a.*,c.role_name')->select();
       return $this->fetch('index',['list'=>$list]);
   }


}