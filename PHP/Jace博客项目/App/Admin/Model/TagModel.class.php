<?php



namespace Model;
use \Core\model;
class TagModel  extends model{
    function store($name){
      $sql="insert into tag(t_name) values('$name') on duplicate key update t_flag=t_flag+1";
      $this->pdo->doExec($sql);
      return $this->pdo->lastId();
    }
}