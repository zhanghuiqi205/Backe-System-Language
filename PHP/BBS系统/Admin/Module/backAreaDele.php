<?php
include '../init.php';
include DIR_CORE.'MysqlDb.php';
$id=$_GET['id'];
$sql="update area set area_del=0 where id='$id'";
$return=my_query($link,$sql);

if ($return) {
	jump('./back-area.php','',0);
}
jump('./back-area.php','删除专区失败！');