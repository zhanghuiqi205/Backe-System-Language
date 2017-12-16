<?php

//第一个展示的php页面


if($_SESSION['userinfo']){
    include '../resource/addnesw.html';
}else{
    header("location:login.php");
}















