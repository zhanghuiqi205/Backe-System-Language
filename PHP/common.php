<?php

/**
 * 绘制验证码
 */
$w = 100;
$h = 30;
$len = 4;
captcha($w,$h,$len);
function captcha($w,$h,$len){
	// 1、创建画布
	$img = imagecreatetruecolor($w,$h);

	// 2、填充背景颜色
	$bg = imagecolorallocate($img,mt_rand(210,255),mt_rand(210,255),mt_rand(210,255));
	imagefill($img,0,0,$bg);

	// 3、绘制随机验证码
	$code = getCode($len);
	for($i=0;$i<strlen($code);$i++){
		$color = imagecolorallocate($img,mt_rand(110,200),mt_rand(110,200),mt_rand(110,200));
		imagettftext($img,mt_rand(18,26),mt_rand(-20,20),18*($i+1),25,$color,'simhei.ttf',$code[$i]);
	}

	// 4、增加干扰线
	for($i=0;$i<4;$i++){
		$color = imagecolorallocate($img,mt_rand(110,200),mt_rand(110,200),mt_rand(110,200));
		imageline($img,mt_rand(0,100),mt_rand(0,30),mt_rand(0,100),mt_rand(0,30),$color);
	}

	// 测试
	header('content-type:image/jpeg');
	imagejpeg($img);
}

//生成随机的字符串
function getCode($len){
	$charset = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';		//57
	$code = '';
	for($i=0;$i<$len;$i++){
		$code .= $charset[mt_rand(0,56)];
	}
	return $code;
}

/**
 * 缩略图
 */
$d_w = 400;
$d_h = 200;
$src = "game.jpg";
thumb($d_w,$d_h,$src);
function thumb($d_w,$d_h,$src){
	//创建画布(框)
	$imgDest = imagecreatetruecolor($d_w,$d_h);		//框
	$bg = imagecolorallocate($imgDest,250,250,250);
	imagefill($imgDest,0,0,$bg);

	//由用户图片创建画布
	$infoSrc = getimagesize($src);
	$s_w = $infoSrc[0];
	$s_h = $infoSrc[1];
	$imgSrc = createFrom($src);
	$f_h = $d_h;
	$f_w = $s_w/$s_h*$f_h;
	if($f_w>$d_w){
		$f_w=$d_w;
		$f_h=$f_w*$s_h/$s_w;
	}
	//计算imgDest上所放置的起点位置
	$posX = ($d_w-$f_w)/2;
	$posY = ($d_h-$f_h)/2;
	//采样合并
	imagecopyresampled($imgDest,$imgSrc,$posX,$posY,0,0,$f_w,$f_h,$s_w,$s_h);
	header('content-type:image/jpeg');
	imagejpeg($imgDest);
}

//封装由图片创建画布的函数
function createFrom($file){

	$info = getimagesize($file);

	switch($info['mime']){
		case 'image/jpeg':
			$img = imagecreatefromjpeg($file);
			break;
		case 'image/png':
			$img = imagecreatefrompng($file);
			break;
		case 'image/gif':
			$img = imagecreatefromgif($file);
			break;
	}

	return $img;
}

/**
 * 水印的制作
*@param1 dest string 用户图片
*@param2 src string 公司logo
*@param3 int 表示logo的位置  1:左上角，2：右上角，3：左下角，4：右下角，5：中间
*@param4 op int 透明度
*/
//用户上传的图片
$dest = 'game.jpg';
//公司的logo
$src = 'logo.png';
$op = 50;
$pos = 4;
water($dest,$src,$pos,$op);


function water($dest,$src,$pos=2,$op=60){
   
   $infoDest = getimagesize($dest);
   $infoSrc = getimagesize($src);

   //将已有的图片读取到画布中
   $imgDest = createFrom($dest);
   $imgSrc = createFrom($src);

   switch($pos){
       case 1:
           $d_x = 0;
           $d_y = 0;
           break;
       case 2:
           $d_x = $infoDest[0]-$infoSrc[0];
           $d_y = 0;
           break;
       case 3:
           $d_x = 0;
           $d_y = $infoDest[1]-$infoSrc[1];
           break;
       case 4:
           $d_x = $infoDest[0]-$infoSrc[0];
           $d_y = $infoDest[1]-$infoSrc[1];
           break;
       case 5:
           $d_x = ($infoDest[0]-$infoSrc[0])/2;
           $d_y = ($infoDest[1]-$infoSrc[1])/2;
           break;
   }

   //制作水印
   imagecopymerge($imgDest,$imgSrc,$d_x,$d_y,0,0,$infoSrc[0],$infoSrc[1],$op);

   header('Content-type:image/jpeg');
   imagejpeg($imgDest);
}


/**
 *遍历文件夹
 * 
 */
$dir = "app";
function getTree($dir){
	$arr = scandir($dir);
	foreach($arr as $v){
		$item = $dir.'/'.$v;
		//判断是不否是文件夹
		if(is_dir($item)){
			//如果是文件夹，且不是. 或.. 才继续遍历
			if($v == '.' || $v=='..'){
				continue;
			}
			echo '<font color="red">'.$item.'</font>','<br/>';
			getTree($item);

		}else{
			//如果不是就直接输出
			echo '<font color="blue">'.$item.'</font>','<br/>';
		}
		
	}
}
getTree($dir);



/*
*数据库使用的封装
*/

<?php 
/**
*数据库连接函数
 */
function my_connect($arr)
{
	$host=isset($arr['host'])?$arr['host']:'127.0.0.1';
	//$port=isset($arr['port'])?$arr['port']:'3306';
	$user=isset($arr['user'])?$arr['user']:'root';
	$pwd=isset($arr['pwd'])?$arr['pwd']:'root';
	$link=@mysqli_connect($host,$user,$pwd);
	if (!$link) 
	{
		echo "数据库连接失败！<br />";
		echo "错误编码：",mysqli_errno($link),"<br />";
		echo "错误信息：",mysqli_error($link),"<br />";
		die;
	}
	return $link;
}

/**
*选择默认字符集
 */

function my_charset($link,$arr)
{
	$charset=isset($arr['charset'])?$arr['charset']:'utf-8';
	$sql="set names $charset";
	mysqli_query($link,$sql);
	
}
/*
*选择默认数据库
 */
function my_dbname($link,$arr)
{
	$dbname=isset($arr['dbname'])?$arr['dbname']:'gbbbs';
	$sql="use $dbname";
	mysqli_query($link,$sql);
	
}
/**
*封装sql执行及错误调试函数
* @param string $sql语句
* @return mixed(true|resource) sql执行结果
*/
function my_query($link,$sql)
{
	$result=mysqli_query($link,$sql);	
	if (!$result) {
		echo "数据库连接失败!<br />";
		echo "错误编码：",mysqli_errno($link),"<br />";
		echo "错误信息：",mysqli_error($link),"<br />";
		die;
	}
	return $result;
}
/**
* 封装fetchAll函数，得到数组格式数据
* @param string $sql 
* @return array 二维数组
*/
function fetchAll($link,$sql)
{
	$result=mysqli_query($link,$sql);
	$rows=array();
	while ($row=mysqli_fetch_assoc($result)) {
		$rows[]=$row;
	}
	mysqli_free_result($result);
	return $rows;
}

/**
* 封装fetchColumn函数得到，一行一列的数据
* @param string $sql
* @return string $str
*/
function fetchColumn($link,$sql)
{
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_row($result);
	mysqli_free_result($result);
	return isset($row[0])?$row[0]:NULL;
}



//加载配置文件
$config=include DIR_CONFIG.'config.php';
$arr=$config['db'];
//echo "<pre>";
//var_dump($arr);die;

//连接数据库
$link=my_connect($arr);
//var_dump($link);die;
my_charset($link,$arr);

$ll=my_dbname($link,$arr);
//var_dump($ll);die;




/*
*数据库使用的封装(面向对象的方法来实现)
*/
class DB{
	//定义属性
    private $host = '';
    private $port = '';
    private $user = '';
    private $pwd = '';
    private $charset = '';
    private $db = '';
    private $link =null;
    private $sql = '';

    public function __construct($config){
    	//完成的属性的初始化
    	$this->host=isset($config['host'])?$config['host']:'127.0.0.1';
    	$this->port=isset($config['port'])?$config['port']:'3306';
    	$this->user=isset($config['user'])?$config['user']:'root';
    	$this->pwd=isset($config['pwd'])?$config['pwd']:'';
    	$this->charset=isset($config['charset'])?$config['charset']:'utf8';
    	$this->db=isset($config['db'])?$config['db']:'';
    	//
    	$this->connect();
    	$this->setChar();
    	$this->useDB();
    }
    //封装数据库连接方法
    private function connect(){
    	$this->link = mysqli_connect($this->host,$this->user,$this->pwd);
    }

    //封装设置客户端字符集的方法
    private function setChar(){
    	mysqli_query($this->link,"set names $this->charset");
    }

    //封装方法用于选择数据库
    private function useDB(){
    	mysqli_query($this->link,"use $this->db");
    }

    //封装一个通用的执行sql的方法
    private function query($sql){
    	//将执行的仍然sql都保存到sql这个属性中
    	$this->sql = $sql;
    	$result = mysqli_query($this->link,$sql);
    	//判断是否有错误
    	if(mysqli_errno($this->link)){
    		echo 'SQL语句出错,错误信息如下:<br/>';
    		echo '错误代码为：',mysqli_errno($this->link),'<br/>';
    		exit;
    	}
    	return $result;
    }
    //封装一个获取一行的方法
    public function getOne($sql){
    	return mysqli_fetch_assoc($this->query($sql));
    }

    //封装一个获取多行的方法
    public function getRows($sql){
    	$result = $this->query($sql);
    	$data = [];
    	while($row = mysqli_fetch_assoc($result)){
    		$data[]=$row;
    	}
    	return $data;
    }

    //封装一个增、删、改的方法
    public function exec($sql){
    	$return = $this->query($sql);
    	return mysqli_affected_rows($this->link);
    }

    //封装一个获取新增记录id的方法
    public function getLastId(){
    	return mysqli_insert_id($this->link);
    }

    //获取最近执行的一条sql语句
   	public function __tostring(){
   		return $this->sql;
   	}

}
//使用者
$config=[
	'user' => 'root',
	'pwd' => '123',
	'db' => 'php9'
];
$obj = new DB($config);









