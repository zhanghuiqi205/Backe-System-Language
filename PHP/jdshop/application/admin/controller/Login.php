<?php

namespace app\admin\Controller;
use think\Controller;
use think\Cookie;
use think\captcha\Captcha;

//管理员登录控制器

class Login extends Common{

   public $is_check_login =false;
   public function index(){
    if($this->request->isGet()){
        return $this ->fetch();
    }
    $model =model('Admin');
    //    调用自定义方法实现登录
    $result1 = $model->login();
    if($result1===false){
        $this->error($model->getError());
    }
     $this->success("登录成功","index/index");  
   }

  //验证码
   public function captcha(){
       $obj =new Captcha(['length'=>4]);
       return $obj->entry();
   }
   public function logout()
   {
      cookie('admin_id',null);
      $this->redirect('index');
   }


}
