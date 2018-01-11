<?php

namespace Controller;
use Core\Controller;
use \Model\articleModel;
class indexController extends Controller{


    //加载前台文件
    public function index(){


    //获取文章的信息
        $art = new articleModel();  
        $recommend = $art->getRecommend();  
        // var_dump($recommend);exit;

        $this->assign('recommend',$recommend);
        $this->display('index.html');
    }


}