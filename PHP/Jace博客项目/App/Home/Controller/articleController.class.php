<?php

namespace Controller;
use Core\Controller;
use \Model\articleModel;
use \Model\categoryModel;


class articleController extends Controller{
    public function addcomment(){
        echo 1334343;
    }
    public function check(){
       
    }






    //人生感悟页面
    public function index(){
        //接受当前类别的id
        $id = isset($_GET['id'])?$_GET['id']:0;
        if (!$id) {
            $this->error('非法操作','index.php&g=home&c=index&a=index');
            exit;
        }
        //获取当前类别的子类别
        $cat = new categoryModel;
        $arr = $cat->getAllCate($id);
        $this->assign('sub',$arr);

        //从数组中提取出来id字段
        $ids=[$id];
        foreach ($arr as $key => $value) {
             $ids[]= $value['c_id'];
        } 
        //将id字段拼接成1,2,3的样式
        $ids =implode(',',$ids);

        //获取当前分类及其子分类下的文章
        $cat =new articleModel();
        $data = $cat->getArtByCatId($ids);
        //得到数据进想渲染
        $this->assign('data',$data);
        $this->display('index.html');
    }
    //文章详情页
    public function view(){
        $id = isset($_GET['id'])?$_GET['id']:0;
        if (!$id) {
            $this->error('非法操作','index.php&g=home&c=index&a=index');
            exit;
        }
        //找到文章的id进行渲染
        $art =new articleModel();
        $data = $art->getArtById($id);
        //点击数的计算
        $art->updateClick($id);

        //上一篇和下一篇文章
        $pre = $art->getArtPre($id);
        $next = $art->getArtNext($id);

        //将得到的数据进行定义
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('data',$data);
        $this->display('view.html');
    }
}