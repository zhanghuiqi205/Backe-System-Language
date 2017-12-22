<?php


include '../init.php';
include DIR_CORE.'MysqlDb.php';

$area_id=isset($_POST['area_id'])?trim($_POST['area_id']):'';
$area_name=isset($_POST['area_name'])?trim($_POST['area_name']):'';
$area_role=isset($_POST['area_role'])?trim($_POST['area_role']):'';


$sql="update area set area_name='$area_name',area_role='$area_role' where id='$area_id'";

$result=my_query($link,$sql);



if($result){
   jump('./back-area.php','');
}else{
   jump('./backAreaAmend2.php','添加出错');
}