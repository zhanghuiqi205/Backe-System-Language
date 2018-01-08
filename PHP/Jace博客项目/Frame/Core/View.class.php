<?php

namespace Core;
class View extends \Smarty{ //命名空间的使用
  
     public function __construct(){
        parent::__construct();                                      //调用父类的构造方法
        $this -> setTemplateDir(DIR_TEMP.'/'.C);                    //设置编译模板存放的位置
        $this -> setCompileDir(DIR_RUNTIME.'/template_c');          //设置编译目录
        $this -> setCacheDir(DIR_RUNTIME.'/cache');                 //设置缓存目录
        $this -> setLeftDelimiter('<{');
        $this -> setrightDelimiter('}>');
     }
}