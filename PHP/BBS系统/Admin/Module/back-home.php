<?php

include '../init.php';
include DIR_CORE.'MysqlDb.php';

$user_name=isset($_POST['userName'])?trim($_POST['userName']):'';
$user_pwd=isset($_POST['userPass'])?trim($_POST['userPass']):'';
$passcode=isset($_POST['passcode'])?trim($_POST['passcode']):'';
$remember = isset($_POST['remember'])?trim($_POST['remember']):'';


if($remember=='on'){
    setcookie('user',"$user_name",time()+3600,'/');
}

if(isset($_COOKIE['user'])){
    $user_name =$_COOKIE['user'];
    $sql="select * from user where user_name='$user_name' ";
    $rows=fetchAll($link,$sql);
    $row =$rows[0];
    $_SESSION['userInfo']=$row;
    include DIR_TEMP.'/back-home.html';
    exit;
}

$code=$_SESSION['code'];

// 验证码错误
// if (strtolower($code)!= strtolower($passcode)) {
//  	 jump('../index.php',1);
//  }
// 用户名或密码不能为空
if (empty($user_name)||empty($user_pwd)) {
	jump('../index.php',2);
	exit;
}
$sql="select * from user where user_name='$user_name'";
$result=my_query($link,$sql);

// 用户名不存在
if (mysqli_affected_rows($link)==0) {
	jump('../index.php',3);
	exit;
}
$row=mysqli_fetch_assoc($result);

// 密码错误
if (md5($user_pwd)!=$row['user_pwd']) {
	jump('../index.php',4);
	exit;
}

$_SESSION['userInfo']=$row;
// var_dump($_SESSION);
// exit;
include DIR_TEMP.'/back-home.html';

//    include '../Templates/back-home.html';
?>
