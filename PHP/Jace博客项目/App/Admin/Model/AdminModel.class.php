<?php



namespace Model;
use \Core\model;
class AdminModel  extends model{
     
    public  function validate($a_name,$a_pwd){   //查询所有的数据
        $sql ="select * from admin where a_name ='$a_name' and a_pwd = md5('$a_pwd')";
        return $this ->pdo->getOne($sql);
    }
    public function updateInfo($id){
        $time =date('Y-m-d h:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql ="update admin set a_last_ip ='$ip',a_last_time='$time' where id =$id";
        $this->pdo->doExec($sql);
    }

}