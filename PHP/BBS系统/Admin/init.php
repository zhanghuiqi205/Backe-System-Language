<?php 
/**
 * 创建初始文件
 */
//1、设置编码集
header('Content-type:text/html;charset=utf-8');
//echo __DIR__; //D:\itcast\wamp\virtual\kfgbbs\Admin
//2、设置目录常量
define("DIR_ROOT", str_replace('\\', '/', __DIR__).'/');
//设置配置文件目录常量
define("DIR_CONFIG",DIR_ROOT.'Config/');
//设置核心文件目录常量
define("DIR_CORE",DIR_ROOT.'Core/');
//设置逻辑处理文件目录常量
define("DIR_MODEL",DIR_ROOT.'Module/');
//设置展示模板文件常量
define("DIR_TEMP",DIR_ROOT.'Templates/');


function jump($url,$info=NULL,$time=2)
{
	if ($info) {
        header("Location:$url?info=$info");
	}else{
		header("Location:$url");
	}
}






// function Dbstring($str)
// {
// 	return addslashes(strip_tags(trim($str)));
// }

// function is_login()
// {
// 	@session_start();
// 	if (!isset($_SESSION['userInfo'])) {
// 		jump('../index.php','请先登录！');
// 	}
// }
