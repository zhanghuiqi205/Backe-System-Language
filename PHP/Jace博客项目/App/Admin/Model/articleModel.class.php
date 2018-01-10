<?php

/**
 * 为模型类添加命名空间
 */

namespace Model;
use \Core\model;
class articleModel  extends model{

    //获得文章列表的数据
    public function getAllArt($curPage,$rowsPerPage){
        //确定关系
        //最终想得到的结果是否是等值的匹配还是非等值匹配
        //填空法
        $offset =($curPage-1)*$rowsPerPage;
        $sql ="select art.*,cat.c_name from article art inner join category cat where  art.c_id=cat.c_id limit $offset,$rowsPerPage";
        return  $this->pdo->getRow($sql);
    }
    //删除和批量删除
    public function delArt($id){
        $sql ="delete from article where a_id in ($id)";
        return  $this->pdo->doExec($sql);
    }
    //推荐和取消推荐
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
    //修改文章
    public function  modify($id){
         $sql ="select * from (select art.*,cat.c_name from article art inner join category cat where  art.c_id=cat.c_id) as data  where data.a_id=$id"; 
         return  $this->pdo->getOne($sql); 
    }
    //获得数据库所有文章的数据
    public function getTotalRows(){
        $sql="select count(*) total from article";
        $total= $this->pdo->getOne($sql);
        return $total['total'];
    }



       
}