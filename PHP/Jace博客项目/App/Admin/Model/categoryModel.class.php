<?php



namespace Model;
use Core\Model;
class categoryModel extends model{
    
    //判断是否有子分类
    public function hasChild($id){
        $sql ="select * from category where c_pid = $id";
        return $this->pdo->getOne($sql);
    }
    
    //添加分类的数据
    public function store($arr){
       extract($arr);
       $sql ="insert into category(c_id,c_name,c_desc,c_sort,c_time,c_pid) values(default,'$c_name','$c_desc','$c_sort','$c_time','$c_pid')";
       return $this->pdo->doExec($sql);
    }
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
    //删除一条或者多条数据
    public function delById($id){
        $sql ="delete from category where c_id in ($id) ";
        return $this->pdo->doExec($sql);
    }
    //获得一条的数据
    public function getDateById($id){
        $sql ="select * from category where c_id=$id";
        return $this->pdo->getOne($sql);
    }
    public function update($arr){
        extract($arr);
        $sql ="update  category set c_name='$c_name',c_desc='$c_desc',c_sort='$c_sort',c_pid='$c_pid' where c_id='$c_id'" ;
        return $this->pdo->doExec($sql);
    }
}