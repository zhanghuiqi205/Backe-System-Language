<?php
include '../init.php';
include DIR_CORE.'MysqlDb.php';


$user_role =$_SESSION['userInfo']['user_role'];
$user_name =$_SESSION['userInfo']['user_name'];


$title =isset($_POST['title'])?trim($_POST['title']):'';

if($title){

     // 管理者登录
    if($user_role==1){ 

        $sql = "select p.* ,u.user_role from publish p,user u where p.pub_owner = u.user_name and u.user_role =0 and p.pub_del =1 and p.pub_title like'%$title%'"; 
        
    }else{ 
    
        // 用户者登录
        $sql = "select * from publish where pub_title like '%$title%' and pub_owner='$user_name' and pub_del =1";
    }
}else{
        // 管理者登录
        if($user_role==1){ 
        $sql = "select p.* ,u.user_role from publish p,user u where p.pub_owner = u.user_name and u.user_role =0 and p.pub_del =1"; 
        
        }else{
        // 用户者登录
        $sql = "select * from publish where pub_owner='$user_name' and pub_del =1";
        }
}




$return=my_query($link,$sql);

$rows=fetchAll($link,$sql);

include DIR_TEMP.'usertie.html';