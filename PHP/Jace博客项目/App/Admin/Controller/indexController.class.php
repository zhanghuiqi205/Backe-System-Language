<?php

namespace Controller;
use  \Core\commonController;
class indexController extends commonController{
    public function index(){
        
        $this->display('admin_index.html');
    }
}