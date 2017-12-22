<?php
//获取总记录数


 
function  Paging($rowsPerPage=10,$curPage,$link,$url,$sql){
    $rowsPerPage = $rowsPerPage;
    $link = $link;
    $url = $url;

    $rowsPerPage = 10;
    //获得数据   
   $offset = ($curPage-1)*$rowsPerPage;
    // $sql = "select count(*) total from $database";
    $sql =$sql;
    $result = mysqli_query($link,$sql);
    $arr = mysqli_fetch_assoc($result);
    $totalRows=$arr['total'];

     //人为的定义一个最大的页码数
   

//计算最大的
$totalPage = ceil($totalRows/$rowsPerPage);

//当前页码数，默认当前页码为1
$curPage = isset($_GET['curPage'])?$_GET['curPage']:1;

//存储页码字符串
$pageNumString = "";

//根据当前页，决定起始页与终止页
if($curPage<=5){
	$begin =1;
	$end = $totalPage>=10?10:$totalPage;
}else{
	$end = $curPage +5>$totalPage?$totalPage:$curPage +5;
	$begin = $end -9<=1?1:$end -9;
}
//根据起始页与终止页将当前页面的页码显示出来
    for($i=$begin;$i<=$end;$i++){
        //使用if实现高亮显示当前点击的页码
        if($curPage == $i){
            $pageNumString .= "<li class='active'><a href='$url?curPage=$i'>$i</a></li>";
        }else{
            $pageNumString .= "<li><a href='$url?curPage=$i'>$i</a></li>";
        }
    }

    return  $pageNumString;
}
 


