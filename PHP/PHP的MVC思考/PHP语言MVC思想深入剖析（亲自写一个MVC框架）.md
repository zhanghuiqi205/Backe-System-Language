1. 写这篇帖子的主要目的就是对PHP中MVC思想的使用，进行一下分析。并亲手写一个MVC框架，达到熟练掌握MVC思想的目的。
2. 产生的原因：
    1. MVC的主要作用是为了将代码分层、分类。
    2. MVC的主要目的是为了解决Web开发中分离开发与设计工作，使其工作相对独立
    3. 在这样的过程中还发现了其他的一些优点，网站的目录结构更加清晰，网站更易维护与扩展，可以实现模块的复用
3. MVC各司其职，使得功能单一，更容易维护。因为一个项目最大的成本就是维护的成本。我们来说一下MVC各自的职责：
   - [x] Model(模型)，程序应用功能的实现，程序的逻辑的实现。在PHP中负责数据管理，数据生成，更多的是操作数据库，我们实际项目中可能在模型中使用PDO来连接数据库。
   - [x] View(视图)，图形界面逻辑。在PHP中负责输出，处理如何调用模板、需要的资源文件。我们实际项目中可能会使用模板文件比如：Smarty，Twig，blade等，来将数据输出到html中。(后续对于PHP模板我们会拿出一个章节专门讲解)
   - [x] Controller(控制器)，负责转发请求，对请求处理。在PHP中根据请求决定调用的视图及使用的数据。类似于一个枢纽站，管家的功能。  
4. 建立一个index.php作为唯一入口，所有对使用程序的访问都是必须通过这个入口。约定我们的url规则，这是我们能够实现MVC很重要的一点。我们能够准确找到文件，找到类，找到方法，都是通过我们约定好的规则实现的。比如：我们约定index.php?g=xxx&c=xxx?a=xxx.
   - [x] g:选择的文件目录：比如访问的是前台文件(home)还是后台(admin)的文件.
   - [x] c:文件目录中的类的文件，准确的找到我们需要的类.
   - [x] a:找到类中我们请求的方法.
![image](https://github.com/zhanghuiqi205/Backe-System-Language/blob/master/PHP/images/one.png)
5. 开始书写我们的核心文件，也就是我们准备工作前的准备工作。比如定义一些常用的方法，比如设置全局配置信息，创建目录结构的方法，定义目录常量，设置查找文件的分发事件函数(注册为自动执行事件)......
```
    index文件的代码：
    <?php
    
    //定义入口文件(单一入口)
    // 定义项目所在的目录
    define("APP_PATH","./App");
    //引入框架文件frame.class.php
    include 'Frame/Core/Frame.class.php';
    //执行框架文件唯一公开的对外静态方法
    Frame::run();
    配置文件的代码：
    <?php
    //将项目中使用到得配置信息都可以放在这里：
    return array(
	    'db' => array(
			'type'=>'mysql',
            'host'=>'127.0.0.1',
            'port'=>3306,
			'user'=>'root',
			'pwd'=>'root',
			'dbname'=>'database',
            'charset'=>'utf8'
			),
        //分页，一页显示多少条记录
        'rowsPerPage'=>5,
        //验证码相关的匹配
        'width'=>100,
        'height'=>32,
        'chars'=>4,
        //图片上传所保存的目录
        'path'=>'./upload/images',
        'maxsize' => "1024*1024*5",
        'mime' => ['image/jpeg','image/jpg','image/pjpeg','image/png']
    );

```
6. 上面定义的单一入口，加载了我们的框架文件。我们的框架文件代码如下：
```
 //对外公开的 唯一执行   静态方法
    public static function run(){
       self::createApp();     //创建目录
       self::setChar();       //设置头部文字样式
       self::setError();      //设置错误信息
       self::analyseURL();    //获取url参数
       self::setDir();        //设置文件目录
       self::loadConfig();    //加载配置信息
       self::autoLoad();      //注册加载事件
       self::startSeesion();  //开启session
       self::dispatch();      //派遣 分发时事件
    }
    
    private static function createApp(){
        if(!file_exists(APP_PATH.'/install.txt')){
        	mkdir(APP_PATH);
            		mkdir(APP_PATH.'/Admin');
            		mkdir(APP_PATH.'/Admin/Controller');
            		mkdir(APP_PATH.'/Admin/Model');
            		mkdir(APP_PATH.'/Admin/View');
            		mkdir(APP_PATH.'/Home');
                    mkdir(APP_PATH.'/Home/Controller');
                    file_get_contents("APP/Home/Controller/indexController.class.php",$welcome); //创建初始文件的内容
            		mkdir(APP_PATH.'/Home/Model');
            		mkdir(APP_PATH.'/Home/View');
            		mkdir(APP_PATH.'/Runtime');
            		mkdir(APP_PATH.'/Runtime/template_c');
            		mkdir(APP_PATH.'/Runtime/cache');

            		file_put_contents(APP_PATH.'/install.txt','true');    	
        }
	}
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
            include $file;
        }
    }
    private static function loadCore($cls){   //加载核心模块的文件   
        $cls = basename($cls);     //取得路径的文件名
        $file = DIR_CORE.'/'.$cls.'.class.php';
        if(file_exists($file)){
           include $file;
        }
    }
    private static function loadController($cls){  //加载控制器的文件
        $cls = basename($cls);     //取得路径的文件名
        $file = DIR_CONTROLLER.'/'.$cls.'.class.php';
        if(file_exists($file)){
            include $file;
        }
    }
    private static function loadSmarty($cls){   //加载Smarty模板的文件
        
        $file = DIR_SMARTY.'/'.$cls.'.class.php';
        if(file_exists($file)){
            include $file;
        }
    }
    
```
我们执行上面的代码，生成如下的目录：
![image](https://github.com/zhanghuiqi205/Backe-System-Language/blob/master/PHP/images/two.png)

7.当我们刚进入我们的项目中，如果地址栏没有传入我们对应的参数，我们会给三个参数一个默认值：也就是找到home文件下面的的indexController类里面的方法index。
```
<?php
namespace Controller;
class indexController{
    public function index(){
        echo "加载前台文件的控制器目录文件";
    }
}
```
我们为了代码的可维护性。我们对命名空间规定一个原则，属于核心或者父类的方法，放在core中，定义空间名为core，属于控制器层面的，定义为Controller,属于模型类的，我们定义命名空间为Model,属于视图的我们定义为View空间名.

8.因为我们实际项目中操作数据库更多的使用PDO来操作，那么我们在模型类中这样来定义代码：

```
<?php
/**
 * 由于模型类就是用于操作数据库
 * 而且只要是实例化就是要操作数据库，
 * 只要操作数据库就必须实化MyPDO。
 * 并且任何一个模型类都需要这样的MyPDO对象。
 * 所以为了减少代码的冗余，我们创建一个模型父类
 */

namespace Core;   //放在核心类中，所以命名空间为core
class model{
    protected $pdo =null;
    public function __construct(){
       $config = $GLOBALS['config']['db'];
       return $this->pdo = new MyPDO($config);
    }
}
对于上述出现的MyPDO类，我们使用的是自己或者php自带的pdo类。在这里就不附着代码了。
```
9.因为我们在视图层使用了模板文件，所以我们要在创建视图层，构建一个公共类：
```
<?php

namespace Core;     //放在核心类中，所以命名空间为core
class View extends \Smarty{ //命名空间的使用，继承samrty类
  
     public function __construct(){
        parent::__construct();                                      //调用父类的构造方法
        $this -> setTemplateDir(DIR_TEMP.'/'.C);                    //设置编译模板存放的位置
        $this -> setCompileDir(DIR_RUNTIME.'/template_c');          //设置编译目录
        $this -> setCacheDir(DIR_RUNTIME.'/cache');                 //设置缓存目录
        $this -> setLeftDelimiter('<{');
        $this -> setrightDelimiter('}>');
     }
}
```
10. 因为页面中很多地方会使用到视图的实例化，所以为了我们代码的简洁，我们抽离出来制作一个父类控制器，放在核心文件中.
```
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
}
```
11. 我们按照上述所说的思路，就完成了一个基本功能的MVC框架，我们把核心类放在我们的Core文件，其他类和各自的对应的模型，视图放在各自对应的文件，书写各自的逻辑代码就可以。一个简单的MVC，我们就书写完了。我书写了几个类别，给大家看看
![image](https://github.com/zhanghuiqi205/Backe-System-Language/blob/master/PHP/images/three.png)
12. 我们书写这个MVC框架用到的知识有：模板，pdo，命名空间，PHP基础的知识，PHP面向对象的知识。大家抽空也可以自己看看出名框架的源码，试着自己去分析一下源码。大体的思想都是相似的。
