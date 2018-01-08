<?php

/**
 * 权限认证控制器
 */
namespace Controller;
use \Model\AdminModel;
use \Core\Controller;
use \Core\verify;
class  PrivilegeController extends Controller{
    public function logout(){
         session_destroy();
         $this->success('注销成功',"index.php?g=admin&c=privilege&a=login");
    }
    public function verify(){
        $verify =new Verify();
        $w =$GLOBALS['config']['width'];
        $h =$GLOBALS['config']['height'];
        $len =$GLOBALS['config']['chars'];
        $verify->captcha($w,$h,$len);
    }

    public function validate(){
        //接受数据
        $a_name = isset($_POST['uname'])?$_POST['uname']:'';
        $a_pwd = isset($_POST['upass'])?$_POST['upass']:'';
        $code = isset($_POST['verify'])?$_POST['verify']:'';
        //判断验证码的正确性
        // if(strtolower($code) != strtolower($_SESSION['code'])){
        //     $this->error('验证码不正确','index.php?g=admin&c=privilege&a=login');
        // }

        //判断数据的合法性
        //得到数据后，操作数据库。
        $admin = new AdminModel();
        $return = $admin ->validate($a_name,$a_pwd);
        if($return){
            $_SESSION['userInfo'] = $return;
            $admin ->updateInfo($return['id']);
            $this->success('认证成功，正在跳转',"index.php?g=admin&c=index&a=index");
        }else{
            echo 'false';
        }
    }


    public function login(){
         $this ->display("login.html");
    }
  
}