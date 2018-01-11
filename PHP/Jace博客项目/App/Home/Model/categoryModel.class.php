<?php



namespace Model;
use Core\Model;
class categoryModel extends model{

    //得到所有的数据,并返回给页面
    public function getAllCate($c_pid=0,$exclude=null){
        $sql ="select * from category";
        $data = $this->pdo->getRow($sql);
        $tree = $this ->getTree($data,$c_pid,0,$exclude);
        return $tree;
    }
    //对数据进行分析
    public function getTree($arr,$c_pid=0,$lv=0,$exclude=null){
        //只查询顶级分类
        static $tree=[];  //仔细理解？？
        foreach ($arr as  $value) {
            if($value['c_pid']==$c_pid){
                $value['lv']=$lv;
                //排除当前分类及其子分类
                if($value['c_id']==$exclude){
                    continue;
                }
                $tree[]=$value;
                $this->getTree($arr,$value['c_id'],$lv+1,$exclude);
            }
        }
        return $tree;
    }
  
}