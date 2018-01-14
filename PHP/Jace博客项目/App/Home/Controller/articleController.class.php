<?php

namespace Controller;
use Core\Controller;
use \Model\articleModel;
use \Model\categoryModel;
use \Model\ReplyModel;


class articleController extends Controller{

    //判断是否可以发表内容,并插入内容
    public function addcomment(){
        $data['a_id'] = isset($_POST['id'])?$_POST['id']:0;
        $data['r_content'] = isset($_POST['content'])?$_POST['content']:'';
        $data['u_id'] = 1;
        $data['r_time'] = time();
        $data['r_pid'] = isset($_POST['pid'])?$_POST['pid']:0;
        if(!isset($_SESSION['userInfo'])){
            $this->error('登陆后才能评论',"index.php?g=home&c=article&a=view&id=".$data['a_id']); 
        }
        $rep = new ReplyModel();
        $return = $rep ->store($data);
        if(!$return){
            $this->error('操作失败',"index.php?g=home&c=article&a=view&id=".$data['a_id']);
            exit;
        }
        $art =new articleModel();
        $art->updateComment($data['a_id']);
       header('location:index.php?g=home&c=article&a=view&id='.$data['a_id']);
    }


    //验证登录的方法
    public function check(){
        $a_name = isset($_POST['username'])?$_POST['username']:'';
        $a_pwd = isset($_POST['password'])?$_POST['password']:'';
        $art_id=isset($_POST['artid'])?$_POST['artid']:0;
        $admin = new articleModel();
        $return = $admin ->check($a_name,$a_pwd);
        if($return){
            $_SESSION['userInfo'] = $return;
            $admin ->updateInfo($return['id']);
            $this->success('认证成功，正在跳转',"index.php?g=home&c=article&a=view&id=$art_id");
        }else{
            $this->success('登录失败，正在跳转',"index.php?g=home&c=article&a=view&id=$art_id");
        }
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


        // 获得文章的回复(通过文章的id来获取)
        $rep = new ReplyModel();
        $return = $rep ->getreply($id); 
        $this->assign('reply',$return);


        //获取相关文章
        $assoc = $art->getAssocArt($id);
        // var_dump($assoc); exit;
        $this->assign('assoc',$assoc);
        
        $this->assign('data',$data);
        $this->display('view.html');
    }
    //退出登录
    public function logout(){
        $id = isset($_GET['id'])?$_GET['id']:0;
        // var_dump($id);exit;
        if (!$id) {
            $this->error('非法操作','index.php&g=home&c=article&a=index');
            exit;
        }
         session_destroy();
         $this->success('注销成功',"index.php?g=home&c=article&a=view&id=$id");
    }
}