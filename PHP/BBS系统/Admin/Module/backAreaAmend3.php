<?php


include '../init.php';
include DIR_CORE.'MysqlDb.php';

$area_name=isset($_POST['area_name'])?trim($_POST['area_name']):'';
$area_role=isset($_POST['area_role'])?trim($_POST['area_role']):'';

$sql="insert into area value(default,'$area_name','$area_role',default)";
$result=my_query($link,$sql);



if($result){
   jump('./back-area.php','');
}else{
   jump('./backAreaAmend3.php','添加出错');
}