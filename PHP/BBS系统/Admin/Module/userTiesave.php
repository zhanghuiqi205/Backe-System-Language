<?php

include '../init.php';
include DIR_CORE.'MysqlDb.php';

$title =isset($_POST['title'])?trim($_POST['title']):'';
$zoneId =isset($_POST['zoneId'])?trim($_POST['zoneId']):'';
$isTop =isset($_POST['isTop'])?trim($_POST['isTop']):'';
$content =isset($_POST['content'])?trim($_POST['content']):'';
$id =isset($_POST['id'])?trim($_POST['id']):'';
$time = date("Y-m-d H:i:s");
if($_POST){
   $sql ="update publish set pub_title='$title',pub_content='$content',pub_time='$time',pub_top='$isTop',pub_area='$zoneId' where id='$id'";
   $return=my_query($link,$sql);
   if($return){
      jump('./usertie.php','');
   }else{
      jump('./addInvitation.php','保存失败');
   }
}else{
    jump('./addInvitation.php','保存失败');
}