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
                $this->user['menus'][]=$value;
            }

        }

    }
}
