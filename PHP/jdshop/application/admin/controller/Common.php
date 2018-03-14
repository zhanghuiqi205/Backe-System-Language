<?php
namespace app\admin\Controller;
use think\Controller;
use think\Request;
use think\Session;
use think\Cookie;
use think\captcha\Captcha;
use think\Db;

class Common extends Controller{
    public  $is_check_login =true;
    public  $request;
    public  $is_check_rule =true;
    public  $user=[];
    public  function __construct(Request $request){
        parent::__construct();
        $this->request =$request;

        if(!cookie('admin_id')&& $this->is_check_login){
           $this->error('没有登录','Login/index');
        }
        if($this->is_check_login){
            $admin_id = cookie('admin_id');

            $this->user =cache('user_'.$admin_id);
            $this->user['admin_id']=$admin_id;
            $userInfo = Db::name('admin_role')->where(['admin_id'=>$admin_id])->find();
            if(!$userInfo){
                echo 'no role';exit;
            }
            if($userInfo['role_id']==1){
                $this->is_check_rule =false;
                $rules =Db::name('rule')->select();
            }else{
                $rule_ids =model('RoleRule')->getRuleById($userInfo['role_id']);
                $rules =Db::name('rule')->where(['id'=>['in',$rule_ids]])->select();
            }
            foreach ($rules as $key => $value) {
                $this->user['rules'][]= strtolower($value['module_name'].'/'.$value['controller_name'].'/'.$value['action_name']);
                if($value['is_show']==1){
                    $this->user['menus'][]=$value;
                }
            }
            // 处理后台首页无权访问
            $this->user['rules'][]='admin/index/index';
            $this->user['rules'][]='admin/index/top';
            $this->user['rules'][]='admin/index/main';
            $this->user['rules'][]='admin/index/menu';
            // 判断是否有权访问 先根据是否超级管理员判断是否需要校验
            if($this->is_check_rule){
                // 获取当前用户访问的地址
                $action = strtolower($request->module().'/'.$request->controller().'/'.$request->action());
               if(!in_array($action,$this->user['rules'])){
                   echo 'no rule';exit;
               }

            }

        }

    }
}
