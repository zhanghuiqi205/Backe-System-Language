<?php

$id = $_GET['id'];
print_r($id );

$curPage=$_GET['curPage'];

print_r($curPage);

$obj =mysqli_connect('127.0.0.1','root','151766');
print_r($obj);
//设置字符集
$sql  =  "set names utf8";
//组织sql语句
$return = mysqli_query($obj,$sql);
//选择数据库
$sql  =  "use php1210";
$return = mysqli_query($obj,$sql);

//模拟数据
$sql  =  "delete from news where id=$id";
$return = mysqli_query($obj,$sql);


if($return){
    header("location:listnews.php?curPage=$curPage");
}else{
    header('location:listnews.php');
}
?>