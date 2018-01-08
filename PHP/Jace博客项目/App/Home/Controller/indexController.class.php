<?php

namespace Controller;
use Core\Controller;
use \Model\articleModel;
class indexController extends Controller{


    //加载前台文件
    public function index(){

        $cat = new articleModel();      
        


       $this->display('index.html');
    }
}