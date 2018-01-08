<?php

// 框架文件

class  Frame{
    // private static function createApp(){
    //         	if(!file_exists(APP_PATH.'/install.txt')){
    //         		mkdir(APP_PATH);
    //         		mkdir(APP_PATH.'/Admin');
    //         		mkdir(APP_PATH.'/Admin/Controller');
    //         		mkdir(APP_PATH.'/Admin/Model');
    //         		mkdir(APP_PATH.'/Admin/View');
    //         		mkdir(APP_PATH.'/Home');
    //                 mkdir(APP_PATH.'/Home/Controller');
    //                 file_get_contents("APP/Home/Controller/indexController.class.php",$welcome); //创建初始文件的内容
    //         		mkdir(APP_PATH.'/Home/Model');
    //         		mkdir(APP_PATH.'/Home/View');
    //         		mkdir(APP_PATH.'/Runtime');
    //         		mkdir(APP_PATH.'/Runtime/template_c');
    //         		mkdir(APP_PATH.'/Runtime/cache');

    //         		file_put_contents(APP_PATH.'/install.txt','true');
    //         	}
	// }
    private static function setChar(){       //设置头部样式
      header('content-type:text/html;charset=utf-8');
    }
    private static function setError(){      //设置错误展示
        ini_set("display_errors","on");
        ini_set("error_reporting",E_ALL);
    }
    private static function loadConfig(){    //引入配置文件(并将其保存在全局的变量中)
      $GLOBALS['config'] = include DIR_COFIG.'/config.php';
    }
    private static function startSeesion(){   //启动session
        @session_start();
    }
    private static function analyseURL(){   //解析url中的g,a,c参数
      $g = isset($_REQUEST['g'])?$_REQUEST['g']:"home";
      $c = isset($_REQUEST['c'])?$_REQUEST['c']:"index";
      $a = isset($_REQUEST['a'])?$_REQUEST['a']:"index";
      
      //将所得到的参数保存在常量里面
      define('G',$g);
      define('C',$c);
      define('A',$a);
    }
    private  static function setDir(){    //设置路径

        //定于目录常量--项目中的目录  即定位到：app文件下面
        define('DIR_CONTROLLER',APP_PATH."/".G."/Controller");
        define('DIR_MODEL',APP_PATH."/".G."/Model");
        define('DIR_TEMP',APP_PATH."/".G."/View"); 
        define('DIR_RUNTIME',APP_PATH."/Runtime"); 

        //定义目录常量--框架中的目录  即是：Frame文件中的东西
        define("DIR_FRAME",str_replace('\\','/',dirname(__DIR__)));
        define("DIR_CORE",DIR_FRAME."/Core");
        define("DIR_SMARTY",DIR_FRAME."/Smarty");
        define("DIR_COMM",DIR_FRAME."/Common");
        define("DIR_COFIG",DIR_FRAME."/Config");

    }
    private static function autoLoad(){   //只有实例化的时候才会执行(排列顺序从实例化的概率算起，从高到低)
        spl_autoload_register([__CLASS__,'loadCore']);
        spl_autoload_register([__CLASS__,'loadController']);
        spl_autoload_register([__CLASS__,'loadModel']);
        spl_autoload_register([__CLASS__,'loadSmarty']);
    }
    private static function dispatch(){     //实例化方法(实例化控制器中的文件)
        $controller ='\\Controller\\'.C.'Controller';    //使用了命名空间，导致实例化发生了变化
        $action = A;
        $obj = new $controller;
		$obj -> $action();
    }
    private static function loadModel($cls){   //加载模型类的文件
        
        $cls = basename($cls);     //取得路径的文件名
        $file = DIR_MODEL.'/'.$cls.'.class.php';
        if(file_exists($file)){
            //echo "加载loadModel中的".$cls."文件",'===',"<br/>";
            include $file;
        }
    }
    private static function loadCore($cls){   //加载核心模块的文件   
        $cls = basename($cls);     //取得路径的文件名
        $file = DIR_CORE.'/'.$cls.'.class.php';
        if(file_exists($file)){
          // echo "加载loadCore中的".$cls."文件",'===',"<br/>";
           include $file;
        }
    }
    private static function loadController($cls){  //加载控制器的文件
        $cls = basename($cls);     //取得路径的文件名
        $file = DIR_CONTROLLER.'/'.$cls.'.class.php';
        if(file_exists($file)){
            //echo "加载loadController中的".$cls."文件",'===',"<br/>";
            include $file;
        }
    }
    private static function loadSmarty($cls){   //加载Smarty模板的文件
        
        $file = DIR_SMARTY.'/'.$cls.'.class.php';
        if(file_exists($file)){
            //echo "加载loadSmarty中的".$cls."文件",'===',"<br/>";
            include $file;
        }
    }

    //对外公开的 唯一执行   静态方法
    public static function run(){
       //self::createApp();     //创建目录
       self::setChar();       //设置头部文字样式
       self::setError();      //设置错误信息
       self::analyseURL();    //获取url参数
       self::setDir();        //设置文件目录
       self::loadConfig();    //加载配置信息
       self::autoLoad();      //注册加载事件
       self::startSeesion();  //开启session
       self::dispatch();      //派遣 分发时事件
    }
}
