<?php

include '../init.php';
include DIR_CORE.'MysqlDb.php';

$id =isset($_GET['id'])?trim($_GET['id']):'';




if($id){ 
    // pub_del
    $sql = "select * from  publish  where id='$id'";      //对需要修改的帖子进行查询
    $return=my_query($link,$sql);
     if($return) { 
        $curtInfo=mysqli_fetch_assoc($return);                 //当前修改帖子的信息
        $sql2 = "select * from area where area_role =1";
        $rows=fetchAll($link,$sql2);
        include  DIR_TEMP.'addInvitation.html';
     }else{
        jump('./usertie.php','修改失败'); 
     }
   
 }else{
   jump('./usertie.php','修改失败');
 }









