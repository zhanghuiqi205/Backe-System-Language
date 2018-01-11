<?php



namespace Model;
use \Core\model;
class articleModel extends model{
    //首页推荐文章的数据   连接查询
    public function getRecommend(){
        //使用联合查询，获取
        $sql="select art.*,cat.c_name,adm.a_name from article art,category cat,admin adm where art.c_id=cat.c_id and art.a_author = adm.id limit 8";
        return $this->pdo->getRow($sql);
    }
    //人生纪实的数据  连接查询
    public function getArtByCatId($ids){
        //使用联合查询，获取
        $sql="select art.*,cat.c_name,adm.a_name from article art,category cat,admin adm where art.c_id=cat.c_id and art.a_author = adm.id and art.c_id in ($ids)";
        return $this->pdo->getRow($sql);
    }

    //文章详情
    public function getArtById($id){
      $sql ="select  art.*,adm.a_name from article art inner join admin adm where a_id = $id and art.a_author = adm.id";
      return $this->pdo->getOne($sql);
    }

    //点击更新点击数
    public function updateClick($id){
        $sql ="update article set a_click = a_click+1 where a_id = $id";
        $this->pdo->doExec($sql);
    }
    
    //上一篇和下一篇
    public function getArtPre($id){
        $sql ="select a_id,a_title from article where a_id<$id order by a_id desc limit 1";
        return $this->pdo->getOne($sql);
    }
    public function getArtNext($id){
        $sql ="select a_id,a_title from article where a_id>$id order by a_id asc limit 1";
        return  $this->pdo->getOne($sql);
    }

    







}