<?php
namespace app\admin\controller;
use think\Db;
/**
 * 角色控制器
 */
class Rule extends Common{

    // 角色添加页面
    public function add(){
        if($this->request->isGet()){
            $data  =model('Rule')->getRules();
            $this->assign('data',$data);
            return $this->fetch();
        }
        // 入库函数
        Db::name('rule')->insert(input());
        $this->success('ok');
    }

    // 角色列表页面
    public function index(){
        $data = model('Rule')->getRules();
        $this->assign('data',$data);
        return $this->fetch();
    }

    // 编辑页面
    public function edit(){      // 编辑页面
        $model = model('Rule');
        //get方法加载自身的页面
        if($this->request->isGet()){
            $id = input('id/d',0);
            $info = $model ->get($id);
            $tree = $model->getRules(); 
            // dump($tree);die;
            return view('edit',['info'=>$info,'tree'=>$tree]);  
        }
        // 其他为提交的数据
        $result = $model->edit();
        if($result===false){
            $this->error($model->getError());
        }
        $this->success("ok",'index');   
    }

    //  删除页面
    public function del(){           
     //获取传过来的id数据，没有给一个默认的 
      $id = input('id/d',0);
      $model = model('Rule');
     //通过调用模型下自定义的方法实现删除   
      $result = $model->del($id);
      if($result===false){
          $this->error($model->getError());
      }
      $this->success("删除成功",'index');
    }
}