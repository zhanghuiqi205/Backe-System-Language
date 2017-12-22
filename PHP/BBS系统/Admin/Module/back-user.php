<?php



include '../init.php';
include DIR_CORE.'MysqlDb.php';
include DIR_CORE.'fenye.php';

if($_POST){
    unset ($_SESSION['fuzzy']);
}
if(isset($_SESSION['fuzzy'])){
    $fuzzy =$_SESSION['fuzzy'];
}else{
    $fuzzy ='';
}
$userName = isset($_POST['userName'])?trim($_POST['userName']):$fuzzy;     //查询的字段
$curPage = isset($_GET['curPage'])?$_GET['curPage']:1;
$rowsPerPage = 10;
$offset = ($curPage-1)*$rowsPerPage;

if($userName){
    $_SESSION['fuzzy'] = $userName;
    $sql="select * from user where user_name like '%$userName%' limit $offset,$rowsPerPage ";
    $sql2 ="select count(*) total from user where user_name like '%$userName%'";
}else{

    $sql = "select * from user  limit $offset,$rowsPerPage";
    $sql2 ="select count(*) total from user";
}

$rows=fetchAll($link,$sql);


// var_dump($rows);
// exit;

 $pageNumString = Paging(10,$curPage,$link,"back-user.php",$sql2);

 include  DIR_TEMP.'back-user.html';




?>