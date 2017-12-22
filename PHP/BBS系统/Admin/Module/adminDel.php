<?php






include '../init.php';
include DIR_CORE.'MysqlDb.php';
include DIR_CORE.'fenye.php';

$id =isset($_GET['id'])?trim($_GET['id']):'';

if($id){ 
    // pub_del
    $sql = "update publish set pub_del=0 where id='$id'";      //对需要删除的帖子进行重新赋值
    $return=my_query($link,$sql); 
     if($return) {
         jump('./usertie.php');
     }else{
        jump('./usertie.php','删除失败'); 
     }
   
 }else{
   jump('./usertie.php','删除失败');
 }
