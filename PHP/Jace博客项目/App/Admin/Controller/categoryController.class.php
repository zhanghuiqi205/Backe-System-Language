<?php



namespace Controller; 
use \Core\commonController; 
use Model\categoryModel; 
class categoryController extends commonController {



    //添加成功后跳转的页面
    public function store() {
        //接受数据
        $data['c_name'] = isset($_POST['cname'])?$_POST['cname']:''; 
        $data['c_pid'] = isset($_POST['pid'])?$_POST['pid']:0; 
        $data['c_desc'] = isset($_POST['cdesc'])?$_POST['cdesc']:''; 
        $data['c_sort'] = isset($_POST['csort'])?$_POST['csort']:0; 
        $data['c_time'] = time(); 
        $cat = new categoryModel();
        $return =  $cat->store($data);
        if ($return) {
            header('location:index.php?g=admin&c=category&a=index');
            exit;
        }else{
            $this->error('分类添加出错',"index.php?g=admin&c=category&a=add");
            exit;
        }
    }
    

    public  function add(){//添加分类
        $cat = new categoryModel(); 
        //获取所有的类别数据getAllCate方法
        $data = $cat -> getAllCate(); 
        $this->assign('cate', $data);

        $this -> display('add.html'); 
    }




    //所有类别的方法
    public function index() {
          $cat = new categoryModel(); 
          //获取所有的类别数据getAllCate方法
          $data = $cat -> getAllCate(); 
          $this->assign('cate', $data);
          $this -> display('index.html'); 
    }
    //删除一条新闻
    public function del(){
        $c_id =isset($_GET['id'])?$_GET['id']:0;
        if(!$c_id){
            $this->error("非法操作","index.php?g=admin&c=category&a=index");
            exit;
        }
        $cat = new categoryModel();

        //方法一：如果有子分类不允许删除
        // $return = $cat ->hasChild($c_id);
        // if ($return) {
        //     $this->error('不允许直接删除父分类',"index.php?g=admin&c=category&a=index");
        //     exit;
        // }
        // //删除操作
        // $return =  $cat->delById($c_id);
        
        // 方法二：直接删除分类及其子分类
        $rows = $cat ->getAllCate($c_id);
        $ids = [$c_id];
        foreach ($rows as $value) {
            $ids[]=$value['c_id'];
        }
        $ids =implode(',',$ids);
        $return =  $cat->delById($ids);
        if ($return) {
            header('location:index.php?g=admin&c=category&a=index');
            exit; 
        }else{
            $this->error('删除失败',"index.php?g=admin&c=category&a=index");
            exit;
        }

    }
    
    public function modify(){
        $c_id =isset($_GET['id'])?$_GET['id']:0;
        if(!$c_id){
            $this->error("非法操作","index.php?g=admin&c=category&a=index");
            exit;
        }
        $cat = new categoryModel();
        $data = $cat ->getDateById($c_id);
        $this->assign('cate', $data); 

        $data = $cat ->getAllCate(0,$c_id);
        $this->assign('cates', $data);
        $this -> display('modify.html'); 
    }



    public function update(){
        $data['c_id'] = isset($_POST['c_id'])?$_POST['c_id']:'';
        $data['c_name'] = isset($_POST['cname'])?$_POST['cname']:''; 
        $data['c_pid'] = isset($_POST['pid'])?$_POST['pid']:0; 
        $data['c_desc'] = isset($_POST['cdesc'])?$_POST['cdesc']:''; 
        $data['c_sort'] = isset($_POST['csort'])?$_POST['csort']:0;
        $data['c_time'] = time(); 
        $cat = new categoryModel();
        $return  = $cat->update($data);
        if ($return) {
            header('location:index.php?g=admin&c=category&a=index');
            exit;
        }else{
            $this->error('更新出错',"index.php?g=admin&c=category&a=modify&id=".$data['c_id']);
            exit;
        }

    }



}