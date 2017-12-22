<?php
include '../init.php';
include DIR_CORE.'MysqlDb.php';
include DIR_CORE.'fenye.php';

if($_POST){
    unset ($_SESSION['areafuzzy']);
}
if(isset($_SESSION['areafuzzy'])){
    $areafuzzy =$_SESSION['areafuzzy'];
}else{
    $areafuzzy ='';
}
$userName = isset($_POST['userName'])?trim($_POST['userName']):$areafuzzy;
$curPage = isset($_GET['curPage'])?$_GET['curPage']:1;
$rowsPerPage = 10;
$offset = ($curPage-1)*$rowsPerPage;

if($userName){
    $_SESSION['fuzzy'] = $userName;
    $sql="select * from area where area_name like '%$userName%' limit $offset,$rowsPerPage ";
    $sql2 ="select count(*) total from area where area_name like '%$userName%'";
}else{
    $sql = "select * from area  limit $offset,$rowsPerPage";
    $sql2 ="select count(*) total from area";
}
 $rows=fetchAll($link,$sql);
 $pageNumString = Paging(10,$curPage,$link,"back-area.php",$sql2);

 include  DIR_TEMP.'back-area.html';