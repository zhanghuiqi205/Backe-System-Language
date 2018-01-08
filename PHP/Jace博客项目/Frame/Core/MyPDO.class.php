<?php
/**
 * MyPDO数据库操作类
 */
//设计 者


namespace Core;
use PDO;
use PDOStatment;
use PDOException;

class MyPDO{
    private $type= '';
    private $host= '';
    private $port= '';
    private $user= '';
    private $pwd= '';
    private $charset= '';
    private $dbname = '';
    private $pdo = '';
    public function __construct($config = []){
    	$this -> type = isset($config['type'])?$config['type']:'mysql';
    	$this -> host = isset($config['host'])?$config['host']:'127.0.0.1';
    	$this -> port = isset($config['port'])?$config['port']:'3306';
    	$this -> user = isset($config['user'])?$config['user']:'root';
    	$this -> pwd = isset($config['pwd'])?$config['pwd']:'';
    	$this -> charset = isset($config['charset'])?$config['charset']:'utf8';
    	$this -> dbname = isset($config['dbname'])?$config['dbname']:'';
    	//
    	$this -> connect();
    	$this -> enableException(); 
    }

    //封装一个数据库连接方法
    private function connect(){
    	$dsn = "$this->type:host=$this->host;port=$this->port;charset=$this->charset;dbname=$this->dbname";
    	$user = $this->user;
    	$pwd = $this ->pwd;
    	$this-> pdo = new PDO($dsn,$user,$pwd);
    }
    
    //封装一个方法开启异常处理模式
    private function enableException(){
    	$this -> pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    //封装一个通用的执行增、删、改的方法
    public function doExec($sql){
    	try{
			$return = $this -> pdo ->exec($sql);
		}catch(PDOException $e){
			echo '错误信息如下：<br/>';
			echo '错误编码为：',$e->getCode();
			echo '错误信息为：',$e->getMessage();
			echo '错误文件为：',$e->getFile();
			echo '错误行号为：',$e->getLine();
			exit;
		}
 
    	return $return;
    }

    //封装一个获取新增记录id的方法
    public function lastId(){
    	return $this->pdo->lastInsertId();
    }

    //封装一个获取一行记录的方法
    public function getOne($sql){
    	try{
			$stmt = $this -> pdo ->query($sql);
		}catch(PDOException $e){
			echo '错误信息如下：<br/>';
			echo '错误编码为：',$e->getCode();
			echo '错误信息为：',$e->getMessage();
			echo '错误文件为：',$e->getFile();
			echo '错误行号为：',$e->getLine();
			exit;
		}
 
    	return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //封装一个获取多行记录的方法
    public function getRow($sql){
    	try{
			$stmt = $this -> pdo ->query($sql);
		}catch(PDOException $e){
			echo '错误信息如下：<br/>';
			echo '错误编码为：',$e->getCode();
			echo '错误信息为：',$e->getMessage();
			echo '错误文件为：',$e->getFile();
			echo '错误行号为：',$e->getLine();
			exit;
		}
 
    	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 	  
}



// //使用者
// $config = [
// 	'type'=>'mysql',
// 	'host'=>'127.0.0.1',
// 	'port'=>3306,
// 	'user'=>'root',
// 	'pwd'=>'123',
// 	'charset'=>'utf8',
// 	'dbname'=>'php9'
// ];
// $myPdo = new MyPDO($config);
