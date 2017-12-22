<?php

include '../init.php';
include DIR_CORE.'MysqlDb.php';

$sql = "select * from area where area_role =1";      //查询用户可以使用的活动区域

$user_role = $_SESSION['userInfo']['user_role'];

$rows=fetchAll($link,$sql);



include DIR_TEMP.'addtie.html';