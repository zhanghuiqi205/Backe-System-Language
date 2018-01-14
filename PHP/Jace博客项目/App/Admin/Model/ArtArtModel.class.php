<?php



namespace Model;
use \Core\model;
class ArtArtModel  extends model{
       function store($t_id,$a_id){
           $sql="replace into art_art(t_id,a_id) values($t_id,$a_id)";
           $this->pdo->doExec($sql);
           return $this->pdo->lastId();
       }
}