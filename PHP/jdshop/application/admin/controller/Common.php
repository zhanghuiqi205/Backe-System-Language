<?php
namespace app\admin\Controller;
use think\Controller;
use think\Request;
use think\Session;
use think\Cookie;
use think\captcha\Captcha;

class Common extends Controller{
    public  $is_check_login =true;
    public  $request;
    public  function __construct(Request $request){
        parent::__construct();
        $this->request =$request;

        if(!cookie('admin_id')&& $this->is_check_login){
           $this->error('没有登录','Login/index');
        }
    }
}
