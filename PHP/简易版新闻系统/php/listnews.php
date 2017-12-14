<?php

//当前页码数，默认当前页码为1
$curPage = isset($_GET['curPage'])?$_GET['curPage']:1;
//人为的定义一个最大的页码数
$rowsPerPage = 10;
//获取所有的新闻数据

$obj =mysqli_connect('127.0.0.1','root','151766');
//设置字符集
$sql  =  "set names utf8";
$return = mysqli_query($obj,$sql);
//选择数据库
$sql  =  "use php1210";
$return = mysqli_query($obj,$sql);

//获得数据
$offset = ($curPage-1)*$rowsPerPage;
$sql = "select * from news order by n_sort desc limit $offset,$rowsPerPage";
$return = mysqli_query($obj,$sql);     //获取所有的数据

//获得数据总条数
$sql  =  "select count(*) as total from news";
$resq = mysqli_query($obj,$sql);
$arr =mysqli_fetch_assoc($resq);
$totalRows=$arr['total'];

$totalpage =ceil($totalRows/$rowsPerPage);
//存储页码字符串
$pageNumString = "";

    if($curPage <=5){
        $begin =1;
        $end = $totalpage>=10?10:$totalpage;
    }else{
        $end = $curPage +5>$totalpage?$totalpage:$curPage +5;
        $begin =$end -9<=1?1:$end -9; 
    }
	//实现上一页
    $prev = $curPage -1<=1?1:$curPage -1;
    $pageNumString .="<li><a href='listNews.php?curPage=1'>首页</a></li>";
	$pageNumString .="<li><a href='listNews.php?curPage=$prev'>&laquo;</a></li>";

	//根据起始页与终止页将当前页面的页码显示出来
	for($i=$begin;$i<=$end;$i++){
		//使用if实现高亮显示当前点击的页码
		if($curPage == $i){
			$pageNumString .= "<li class='active'><a href='listNews.php?curPage=$i'>$i</a></li>";
		}else{
			$pageNumString .= "<li><a href='listNews.php?curPage=$i'>$i</a></li>";
		}
	}

	//实现下一页
	$next = $curPage +1 >=$totalpage?$totalpage:$curPage +1;
    $pageNumString .="<li><a href='listNews.php?curPage=$next'>&raquo;</a></li>";
    $pageNumString .="<li><a href='listNews.php?curPage=$totalpage'>尾页</a></li>";
    include '../resource/listnews.html';


