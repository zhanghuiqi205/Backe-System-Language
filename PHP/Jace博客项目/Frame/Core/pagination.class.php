<?php


namespace Core;
class pagination {


    public function getpage($totalPage,$rowsPerPage,$curPage,$url){
                //计算最大的
                $totalPage = ceil($totalRows/$rowsPerPage);

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

                //实现上一页
                $prev = $curPage -1<=1?1:$curPage -1;
                $pageNumString .="<li><a href='listNews.php?curPage=$prev'>&laquo;</a></li>";

                //根据起始页与终止页将当前页面的页码显示出来
                for($i=$begin;$i<=$end;$i++){
                    //使用if实现高亮显示当前点击的页码
                    if($curPage == $i){
                        $pageNumString .= "<li class='active'><a href='$url&curPage=$curPage'>$i</a></li>";
                    }else{
                        $pageNumString .= "<li><a href='$url&curPage=$curPage'>$i</a></li>";
                    }
                }

                //实现下一页
                $next = $curPage +1 >=$totalPage?$totalPage:$curPage +1;
                $pageNumString .="<li><a href='listNews.php?curPage=$next'>&raquo;</a></li>";
                return $pageNumString;
    }
   
}