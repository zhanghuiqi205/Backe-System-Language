<?php
/** 
 * 由于所有的控制器的方法中都可能会用到视图类。
 * 为了减少代码冗余，所以创建一个控制器父类
 * 集中来控制和实例化view的类。也就是实例化Smarty的模板文件
 */
namespace Core;
class Controller{
    protected $view =null;
    public function __construct(){
        $this->view = new View();
      
    }
    public function display($tpl){
        $this->view->display($tpl);
    }
    public function assign($n,$v){
        $this->view->assign($n,$v);
    }
    protected function success($mess,$url,$second=3){
       $this ->assign('mess',$mess);
       $this ->assign('url',$url);
       $this ->assign('second',$second);
       $this ->display(DIR_COMM."/success.html");
       exit;
    }
    protected function error($mess,$url,$second=3){
        $this ->assign('mess',$mess);
        $this ->assign('url',$url);
        $this ->assign('second',$second);
        $this ->display(DIR_COMM."/error.html");
        exit;
    }
    
}
