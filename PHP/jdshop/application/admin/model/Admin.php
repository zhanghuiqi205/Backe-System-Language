<?php
namespace app\admin\model; 
use think\Model; 
use think\captcha\Captcha;

// 创建管理员模型
class  Admin extends  Model {
  

   public function login(){
        //1.接受参数
        $data =input();
        $userInfo = Admin::get(['username'=>$data['username']]);
       
        //2.比对验证码 
        $obj =new Captcha(['length'=>4]);
        if(!$obj->check($data['captcha'])){
            $this->error ='验证码错误';
            return false;
        }
        // 3.比对用户名和密码匹配
        if(!$userInfo){
            $this->error ="用户名错误";
            return false;
        }
        if(md5($data['password']) !=$userInfo['password']){
            $this->error ="密码错误";
            return false;
        }
        // 4.保存用户信息
        if(isset($data['remember'])){
            cookie('admin_id',$userInfo['id'],360000);
        }else{
            cookie('admin_id',$userInfo['id']);
        }
   }


}