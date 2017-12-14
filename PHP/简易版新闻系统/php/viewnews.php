<?php



$id = $_GET['id'];
$obj =mysqli_connect('127.0.0.1','root','151766');
//设置字符集
$sql  =  "set names utf8";
//组织sql语句
$return = mysqli_query($obj,$sql);
//选择数据库
$sql  =  "use php1210";
$return = mysqli_query($obj,$sql);

//模拟数据
$sql  =  "select * from news where id=$id";
$return = mysqli_query($obj,$sql);
$resut = mysqli_fetch_assoc($return);

if($return){
    include '../resource/viewnews.html';
}else{
    header('location:listnews.php');
}





























