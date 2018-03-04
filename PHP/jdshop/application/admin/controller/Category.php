<?php
namespace app\admin\controller; 
use think\Controller;
use think\Request;

class Category  extends  Common {


     //分类的列表的页面加载
     public function index(){
        $tree = model('Category')->getTree();
        return view('index',['tree'=>$tree]);     
    }

    //分类添加的页面加载
    public function add(Request $request) {
        $model = model('Category');
        if($request->isGet()){
            // 获取所有的数据
            $tree = $model->getTree();
            $this->assign('tree',$tree);
            return $this->fetch();
        }
        $result =db('category')->insert(input('post.'));
        if($result === false){
            $this->error('fail');
        }
        $this->success('ok');

    }
    
    public function edit(){      // 编辑页面
        $model = model('Category');
        //get方法加载自身的页面
        if($this->request->isGet()){
            $id = input('id/d',0);
            $info = $model ->get($id);
            $tree = $model->getTree(); 
            return view('edit',['info'=>$info,'tree'=>$tree]);  
        }
        // 其他为提交的数据
        $result = $model->edit();
        if($result===false){
            $this->error($model->getError());
        }
        $this->success("ok",'index');   
    }


    public function del(){           //删除页面的方法
     //获取传过来的id数据，没有给一个默认的 
      $id = input('id/d',0);
      $model = model('Category');
     //通过调用模型下自定义的方法实现删除   
      $result = $model->del($id);
      if($result===false){
          $this->error($model->getError());
      }
      $this->success("删除成功",'index');
    }

   


}