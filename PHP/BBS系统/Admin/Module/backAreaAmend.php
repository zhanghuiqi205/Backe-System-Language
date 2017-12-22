<?php
//1、加载初始化文件
include '../init.php';
//2、加载连接数据库函数
include DIR_CORE.'MysqlDb.php';
$id =$_GET['id'];
//3、接受修改专区id
$sql="select * from area where id=$id";
$rows=fetchAll($link,$sql);

$row =$rows[0];
//4、组织并执行查看sql

//5、加载修改页面
include DIR_TEMP.'backAreaAmend.html';