<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;

class Common extends Controller
{
    public $request;
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request =$request;
        // 获取所有分类的信息
        $category =Db::name('category')->select();
        $this->assign('category',$category);
    }
}
