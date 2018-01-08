<?php

/**
 * 为模型类添加命名空间
 */

namespace Model;
use \Core\model;
class articleModel  extends model{


    public function getAllArt(){
        //确定关系
        //最终想得到的结果是否是等值的匹配还是非等值匹配
        //填空法
        $sql ="select art.*,cat.c_name from article art inner join category cat where  art.c_id=cat.c_id";
        return  $this->pdo->getRow($sql);
    }

    public function delArt($id){
        $sql ="delete from article where a_id in ($id)";
        return  $this->pdo->doExec($sql);
    }

    public function recommend($id){
        $sql ="update  article set a_recommend = a_recommend^1  where a_id=$id";
        return  $this->pdo->doExec($sql);
    }








       //添加文章提交的数据
    public function store($data){
           extract($data);
           $sql = "insert into article(a_title,a_desc,a_content,a_author,a_time,a_click,a_like,a_comment,c_id,a_img,a_thumber,a_water) values('$a_title','$a_desc','$a_content','$a_author','$a_time','$a_click','$a_like','$a_comment','$c_id','$a_img','$a_thumber','')";
           return $this->pdo->doExec($sql);
    }
       
}