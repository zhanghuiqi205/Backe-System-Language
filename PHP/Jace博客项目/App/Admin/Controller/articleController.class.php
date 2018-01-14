<?php


namespace Controller;
use \core\commonController;
use \Model\categoryModel;
use \Model\articleModel;
use \Model\ArtArtModel;
use \Model\TagModel;

use Core\fileupload;
use \core\myImage;
use \Core\pagination;

class articleController extends commonController{
    

    //文章列表和分页的实现
    public function index(){

        $art = new articleModel();

        $curPage =isset($_GET['curPage'])?$_GET['curPage']:1;
        $rowsPerPage = $GLOBALS['config']['rowsPerPage'];
        $url ="index.php?g=admin&c=article&a=index";
        $totalRows = $art->getTotalRows();
        $page =new pagination();

        $pageString=$page->getpage($totalRows,$rowsPerPage,$curPage,$url);
        
        $data= $art ->getAllArt($curPage,$rowsPerPage);
        $this->assign('curPage',$curPage);
        $this->assign('art',$data);
        $this->assign('pageString',$pageString);
        $this ->display("index.html");

    }
    //推荐和取消推荐
    public function recommend(){  
        $a_id =isset($_GET['id'])?$_GET['id']:0;
        $curPage =isset($_GET['curPage'])?$_GET['curPage']:1;
        if(!$a_id){
             $this->error('非法操作','index.php?g=admin&c=article&a=index');
             exit;
        }
        $art = new articleModel();
        $return = $art->recommend($a_id);
        if (!$return) {
            $this->error('操作出错','index.php?g=admin&c=article&a=index');
            exit; 
        }
        header("location:index.php?g=admin&c=article&a=index&curPage=$curPage");
    }
    //添加文章的页面数据
    public function store(){
        //添加文章传递过来的数据，提交到文章表
        
        $data['a_title'] =isset($_POST['title'])?$_POST['title']:'';
        $data['c_id'] =isset($_POST['cid'])?$_POST['cid']:'';
        $data['a_desc'] =isset($_POST['desc'])?$_POST['desc']:'';
        $data['a_content'] =isset($_POST['content'])?$_POST['content']:'';
        $data['a_time'] = time();
        $data['a_click']=0;
        $data['a_like']=0;
        $data['a_comment']=0;
        $data['a_author']=$_SESSION['userInfo']['id'];
        // var_dump($data);exit;
        //处理文件上传
        if(is_uploaded_file($_FILES['MyFile']['tmp_name'])){
            echo '有文件上传';
            $obj =new fileupload();
            $file = $_FILES['MyFile'];
            $mime = $GLOBALS['config']['mime'];
            $maxsize = $GLOBALS['config']['maxsize'];
            $path = $GLOBALS['config']['path'];
            $filename =$obj->uploads($file,$mime,$maxsize,$path);
            if($filename){
                $data['a_img'] = $filename;
                $d_w = $GLOBALS['config']['t_w'];
                $d_h = $GLOBALS['config']['t_h'];
                $path = $GLOBALS['config']['thumb'];
                $src = $GLOBALS['config']['path'].'/'.$filename;
                $image =new myImage();
                $thumber = $image ->thumb($d_w,$d_h,$src,$path);
                if($thumber){
                    $data['a_thumber'] = $thumber;
                }

            }else{
                $data['a_img'] = 'default_img.jpeg';
            }
        }else{
            $data['a_img'] = 'default_img.jpeg';
            $data['a_thumber'] = 'default_thumber.jpeg';
        }
        $art = new articleModel();
        $return = $art->store($data);

        $a_tag =isset($_POST['tag'])?$_POST['tag']:'';
        if(!$a_tag){
            $this->error('关键字不能为空','index.php?g=admin&c=article&a=add');
        }


        $arr = explode(',',$_POST['tag']);
        // var_dump($arr);exit;
        foreach ($arr as  $value) {
            $tag =new TagModel();
            $t_id =  $tag ->store($value);
            $artart =new ArtArtModel();
            $artart->store($t_id,$return);
        }

        if ($return) {
           header("location:index.php?g=admin&c=article&a=index");
           exit;
        }else{
            //写错误日志
        }
    }
    //添加文章页面的展示
    public function add(){
        $cat = new  categoryModel();

        $data = $cat ->getAllCate();
        $this->assign('cate', $data);
        $this ->display("add.html");
    }
    //删除文章和批量删除
    public function del(){
        $a_id =isset($_GET['id'])?$_GET['id']:0;
        $curPage =isset($_GET['curPage'])?$_GET['curPage']:1;
        if(!$a_id){
           $this->error('非法操作','index.php?g=admin&c=article&a=index');
        }   
        $art = new articleModel();
        $return = $art->delArt($a_id);
        if (!$return) {
            $this->error('删除失败','index.php?g=admin&c=article&a=index');
            exit;
        }
        header("location:index.php?g=admin&c=article&a=index&curPage=$curPage");
    }
    //修改文章的方法
    public function modify(){
        $a_id =isset($_GET['id'])?$_GET['id']:0;
        if(!$a_id){
           $this->error('非法操作','index.php?g=admin&c=article&a=index');
        }
        $art = new articleModel();
        $data = $art->modify($a_id);
        $this->assign('cate', $data);
        $this ->display("modify.html");
    }
}