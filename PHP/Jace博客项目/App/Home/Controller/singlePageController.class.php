<?php

/**
 * 单页面的使用
 * 
 */

namespace Controller;
use Core\Controller;



class singlePageController extends Controller{
    public function aboutMe(){
         $this->display('about.html');
    }
}
