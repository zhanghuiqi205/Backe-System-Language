<?php
/**
 * 绘制验证码
 */
namespace core;
class verify{
    function captcha($w,$h,$len){
        // 1、创建画布
        $img = imagecreatetruecolor($w,$h);
    
        // 2、填充背景颜色
        $bg = imagecolorallocate($img,mt_rand(210,255),mt_rand(210,255),mt_rand(210,255));
        imagefill($img,0,0,$bg);
    
        // 3、绘制随机验证码
        $code = $this-> getCode($len);
        //将随机生成的验证码写入session
        $_SESSION['code'] = $code;
        for($i=0;$i<strlen($code);$i++){
            $color = imagecolorallocate($img,mt_rand(110,200),mt_rand(110,200),mt_rand(110,200));
            imagettftext($img,mt_rand(18,26),mt_rand(-20,20),18*($i+1),25,$color,'./Public/fonts/simhei.ttf',$code[$i]);
        }
    
        // 4、增加干扰线
        for($i=0;$i<4;$i++){
            $color = imagecolorallocate($img,mt_rand(110,200),mt_rand(110,200),mt_rand(110,200));
            imageline($img,mt_rand(0,100),mt_rand(0,30),mt_rand(0,100),mt_rand(0,30),$color);
        }
    
        // 测试
        header('content-type:image/jpeg');
        imagejpeg($img);
    }
    
    //生成随机的字符串
    function getCode($len){
        $charset = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';		//57
        $code = '';
        for($i=0;$i<$len;$i++){
            $code .= $charset[mt_rand(0,56)];
        }
        return $code;
    }
}


