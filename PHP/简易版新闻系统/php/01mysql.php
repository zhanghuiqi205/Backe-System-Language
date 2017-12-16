<?php

$name =$_POST['uname'];
$pass =$_POST['upass'];

//连接数据库
$obj =mysqli_connect('127.0.0.1','root','151766');
//设置字符集
$sql  =  "set names utf8";
$return = mysqli_query($obj,$sql);
//选择数据库
$sql  =  "use php1210";
$return = mysqli_query($obj,$sql);
//模拟数据
$pass =md5("$pass");
print_r($pass);
$sql  =  "select * from users where u_name='$name' && u_pwd='$pass'";
$return = mysqli_query($obj,$sql);
print_r($return);
$userinfo =mysqli_fetch_assoc($return);
if($userinfo){
    $_SESSION['userinfo']=$userinfo;
    header("location:addNews.php");
}else{
    header("location:login.php");
}








