<?php
/**

 */
//定义错误编码与错误信息的对应关系
$errorInfo=[
	'1001'=>'文件超过php.ini限',
	'1002'=>'文件超过html限制',
	'1003'=>'文件上传不完整',
	'1004'=>'没有选择文件',
	'1006'=>'服务器内部错误',
	'1007'=>'服务器内部错误',
	'1008'=>'文件太大',
	'1009'=>'文件类型不合法',
	'1010'=>'文件移动失败'
];

//设计者
function uploads($file,$mime,$maxsize,$path){
	//判断文件上传错误
	switch($file['error']){
		case 1:
			return 1001;//'文件超过php.ini限制';
			break;
		case 2:
			return 1002;//'文件超过html限制';
			break;
		case 3:
			return 1003;//'文件上传不完整';
			break;
		case 4:
			return 1004;//'没有选择文件';
			break;
		case 6:
			return 1006;//'服务器内部错误';
			break;
		case 7:
			return 1007;//'服务器内部错误';
            break;   
	}

	if($file['size']>$maxsize){
		return 1008;                          //文件太大;
	}

	//判断用户上传的文件类型是否合法
	if(!in_array($file['type'],$mime)){
		return 1009;                        //文件类型不合法;
	}

	$tmp = $file['tmp_name'];

	$fileName = getRandName();
	//获取文件的扩展名
	$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
	//拼接文件名
	$basename = $fileName.'.' . $ext;
	//拼接路径
	$dest = $path.'/'. $basename;

	//将临时文件夹中的文件，移动到目标位置
	if(move_uploaded_file($tmp,$dest)){
		return $basename;
	}else{
		return 1010;
	}

}

//随机文件的格式	20171214202230asdfsd
function getRandName(){
	$string = date('YmdHis');
	for($i=0;$i<6;$i++){
		switch(mt_rand(0,2)){
			case 0:
				$string .= chr(mt_rand(97,122));   //小a
				break;
			case 1:
				$string .= chr(mt_rand(65,90));   //大A
				break;
			case 2:
				$string .= mt_rand(0,9);          //获取随机数
				break;
		}
	}
	return $string;
}

//使用者
$path = "e:/uploads";
$maxsize = 1024*1024*5;
$mime = ['image/jpeg','image/jpg','image/pjpeg','image/png'];
$file = $_FILES['image'];

$return = uploads($file,$mime,$maxsize,$path);
echo $return;

