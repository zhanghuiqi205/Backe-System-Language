<?php


include 'init.php';
$info = isset($_GET['info'])?trim($_GET['info']):'';
$logout = isset($_GET['logout'])?trim($_GET['logout']):'';


if($logout=="out"){
    setcookie('user',' ',time()-1,'/');
    include DIR_TEMP.'/index.html';
    exit;
}
if(isset($_COOKIE['user'])){
    jump('./Module/back-home.php','');
}else{
    include DIR_TEMP.'/index.html';
}

?>