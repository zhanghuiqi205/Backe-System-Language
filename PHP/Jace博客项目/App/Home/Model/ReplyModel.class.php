<?php


namespace Model;
use \Core\model;
class ReplyModel extends model{
    function store($data){
        extract($data);
        $sql="insert into reply(r_content,r_time,u_id,a_id,r_pid) values ('$r_content',$r_time,$u_id,$a_id,$r_pid)";
        return $this->pdo->doExec($sql);
    }
    function getreply($id){
        $sql="select * from reply where a_id=$id";
        $data = $this->pdo->getRow($sql);
        return $this->getTree($data);
    }
    public function getTree($arr,$pid=0){
        static $tree=[];
        foreach ($arr as $key => $value) {
               if($value['r_pid']==$pid){
                   $tree[]=$value ;
                   $this->getTree($arr,$value['r_id']);
               }
        }
        return $tree;
    }
}