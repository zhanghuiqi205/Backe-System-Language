<?php
namespace app\admin\controller;
use think\Controller;
class Index  extends Common{
    
    public function index(){
        return view();
    }
    public function top(){
        return view();
    }
    public function menu(){
        $this->assign('menus',$this->user['menus']);
        return view();
    }
    public function main(){
        return view();
    }
   

}