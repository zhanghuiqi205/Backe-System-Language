<?php 
/**
*数据库连接函数
 */
function my_connect($arr)
{
	$host=isset($arr['host'])?$arr['host']:'127.0.0.1';
	//$port=isset($arr['port'])?$arr['port']:'3306';
	$user=isset($arr['user'])?$arr['user']:'root';
	$pwd=isset($arr['pwd'])?$arr['pwd']:'root';
	$link=@mysqli_connect($host,$user,$pwd);
	if (!$link) 
	{
		echo "数据库连接失败！<br />";
		echo "错误编码：",mysqli_errno($link),"<br />";
		echo "错误信息：",mysqli_error($link),"<br />";
		die;
	}
	return $link;
}

/**
*选择默认字符集
 */

function my_charset($link,$arr)
{
	$charset=isset($arr['charset'])?$arr['charset']:'utf-8';
	$sql="set names $charset";
	mysqli_query($link,$sql);
	
}
/*
*选择默认数据库
 */
function my_dbname($link,$arr)
{
	$dbname=isset($arr['dbname'])?$arr['dbname']:'gbbbs';
	$sql="use $dbname";
	mysqli_query($link,$sql);
	
}
/**
*封装sql执行及错误调试函数
* @param string $sql语句
* @return mixed(true|resource) sql执行结果
*/
function my_query($link,$sql)
{
	$result=mysqli_query($link,$sql);	
	if (!$result) {
		echo "数据库连接失败!<br />";
		echo "错误编码：",mysqli_errno($link),"<br />";
		echo "错误信息：",mysqli_error($link),"<br />";
		die;
	}
	return $result;
}
/**
* 封装fetchAll函数，得到数组格式数据
* @param string $sql 
* @return array 二维数组
*/
function fetchAll($link,$sql)
{
	$result=mysqli_query($link,$sql);
	$rows=array();
	while ($row=mysqli_fetch_assoc($result)) {
		$rows[]=$row;
	}
	mysqli_free_result($result);
	return $rows;
}

/**
* 封装fetchColumn函数得到，一行一列的数据
* @param string $sql
* @return string $str
*/
function fetchColumn($link,$sql)
{
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_row($result);
	mysqli_free_result($result);
	return isset($row[0])?$row[0]:NULL;
}



//加载配置文件
$config=include DIR_CONFIG.'config.php';
$arr=$config['db'];
//echo "<pre>";
//var_dump($arr);die;

//连接数据库
$link=my_connect($arr);
//var_dump($link);die;
my_charset($link,$arr);

$ll=my_dbname($link,$arr);
//var_dump($ll);die;

