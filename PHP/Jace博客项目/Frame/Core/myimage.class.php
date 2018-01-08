<?php

namespace core;
class myImage {
    function thumb($d_w,$d_h,$src,$path){
        //创建画布(框)
        $imgDest = imagecreatetruecolor($d_w,$d_h);		//框
        $bg = imagecolorallocate($imgDest,250,250,250);
        imagefill($imgDest,0,0,$bg);
    
        //由用户图片创建画布
        $infoSrc = getimagesize($src);
        $s_w = $infoSrc[0];
        $s_h = $infoSrc[1];
        $imgSrc = $this->createFrom($src);
        $f_h = $d_h;
        $f_w = $s_w/$s_h*$f_h;
        if($f_w>$d_w){
            $f_w=$d_w;
            $f_h=$f_w*$s_h/$s_w;
        }
        //计算imgDest上所放置的起点位置
        $posX = ($d_w-$f_w)/2;
        $posY = ($d_h-$f_h)/2;
        //采样合并
        imagecopyresampled($imgDest,$imgSrc,$posX,$posY,0,0,$f_w,$f_h,$s_w,$s_h);
        //header('content-type:image/jpeg');
        $filename = 'thumber_'.basename($src);
        $dest =$path.'/'.$filename;
        if(imagejpeg($imgDest,$dest)){
           return $filename;
        }
    }
    
    //封装由图片创建画布的函数
    function createFrom($file){
    
        $info = getimagesize($file);
    
        switch($info['mime']){
            case 'image/jpeg':
                $img = imagecreatefromjpeg($file);
                break;
            case 'image/png':
                $img = imagecreatefrompng($file);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($file);
                break;
        }
    
        return $img;
    }
}