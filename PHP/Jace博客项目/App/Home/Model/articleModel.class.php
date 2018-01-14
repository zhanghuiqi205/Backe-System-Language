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

    //验证登录的方法
    public function check($a_name,$a_pwd){
       $sql ="select * from admin where a_name='$a_name' and a_pwd=md5('$a_pwd')";
    //    var_dump($sql);exit;
       return $this->pdo->getOne($sql);
    }

    //更新登录的时间
    public function updateInfo($id){
        $time =date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql ="update admin set a_last_ip ='$ip',a_last_time='$time' where id =$id";
        $this->pdo->doExec($sql);
    }

    //更新评论数
    public function updateComment($a_id){
     $sql="update article set a_comment = a_comment+1 where a_id=$a_id";
     $this->pdo->doExec($sql);
    }
   
    //获取相关文章的数据
    public function getAssocArt($id){
        $sql="select a_id,a_title from article where a_id in (select distinct a_id from art_art where t_id in (select a_id from art_art where t_id =$id)) and a_id != $id";
        return $this->pdo->getRow($sql);
    }

}
