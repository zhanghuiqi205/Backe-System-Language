<?php

echo '<pre>';

print_r($_POST);


$n_title =$_POST['n_name'];
$c_id =$_POST['p_id'];
$n_sort =$_POST['n_sort'];
$n_desc =$_POST['n_desc'];
$n_content =$_POST['n_content'];

$obj =mysqli_connect('127.0.0.1','root','151766');

//设置字符集
$sql  =  "set names utf8";

//组织sql语句
$return = mysqli_query($obj,$sql);

//选择数据库
$sql  =  "use php1210";
$return = mysqli_query($obj,$sql);

//模拟数据
$sql  =  "insert into news values(default,'$n_title','$c_id','$n_sort','$n_desc','$n_content')";
$return = mysqli_query($obj,$sql);
if($return){
    header('location:listnews.php');
}else{
   
}












