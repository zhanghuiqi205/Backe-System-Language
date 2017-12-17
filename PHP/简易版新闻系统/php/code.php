<?php

$w =100;
$h = 30;
$img =imagecreatetruecolor($w,$h);
$background =imagecolorallocate($img,mt_rand(220,255),mt_rand(220,255),mt_rand(220,255));
imagefill($img,0,0,$background);

$code = getCode();

$_SESSION['code'] = $code;

//绘制二维码
for ($i=0; $i<strlen($code);$i++) { 
   $color = imagecolorallocate($img,mt_rand(110,220),mt_rand(110,200),mt_rand(110,200));
   imagettftext($img,mt_rand(18,26),mt_rand(-20,20),18*($i+1),25,$color,"msyh.ttf",$code[$i]);
}
//绘制干扰线
for ($i=0; $i <4 ; $i++) { 
    $color = imagecolorallocate($img,mt_rand(110,200),mt_rand(110,200),mt_rand(110,200));
    imageline($img,mt_rand(0,100),mt_rand(0,30),mt_rand(0,100),mt_rand(0,30),$color);
}

header('content-type:image/jpeg');
imagejpeg($img);

function getCode(){
  $code ="";
  $str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  for ($i=0; $i <4 ; $i++) {
     $code .= $str[mt_rand(0,61)];
  } 
  return $code;
}




















