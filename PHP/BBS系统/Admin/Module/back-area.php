<?php
include '../init.php';
include DIR_CORE.'MysqlDb.php';
include DIR_CORE.'fenye.php';
$sql="select * from area where area_del=1";
$sq2="select count(*) total from area where area_del=1";
$rows=fetchAll($link,$sql);


$curPage = isset($_GET['curPage'])?$_GET['curPage']:1;

$pageNumString = Paging(10,$curPage,$link,"back-area.php",$sq2);

include DIR_TEMP.'back-area.html';