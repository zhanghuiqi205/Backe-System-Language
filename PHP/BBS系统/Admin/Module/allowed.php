<?php
include '../init.php';
include DIR_CORE.'MysqlDb.php';
$user_id=$_GET['id'];
$sql="select user_allowed from user where id='$user_id'";
$row=fetchColumn($link,$sql);
if ($row==1) {
	$sql="update user set user_allowed=0 where id='$user_id'";	
}else{
	$sql="update user set user_allowed=1 where id='$user_id'";	
}
$return=my_query($link,$sql);
//var_dump($return);die;
if ($return) {
	jump('back-user.php','',0);
}
jump('back-user.php','修改失败！');