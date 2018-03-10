<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

if ( ! function_exists('get_cate_tree')) {
    function get_cate_tree($data, $id = 0, $lev = 1,$isClear=false) {
         static $list =[];
         if($isClear){
             $list=[];
         }
         foreach ($data as $key => $value) {
            //将对象转换为数组
            $value = $value->toArray();
            if($value['parent_id']==$id){
                $value['lev'] = $lev;
                $list[]=$value;
                 // 不确定的再次调用函数
                get_cate_tree($data,$value['id'],$lev+1,false);
            }  
        }
        return $list;
    }
}

if(!function_exists('upload_to_cdn')){
    function upload_to_cdn($filePath,$newFilePath="")
    {
        $newFilePath = $newFilePath?$newFilePath:$filePath;
        $obj = new \ftp('192.168.214.132',21,'ftpuser','151766');
        return $obj->up_file($filePath,$newFilePath);
    }
}

// 得到type info 信息
if(!function_exists('get_type_info')){
  function get_type_info(){
      $typeInfo =cache('type');
      if(!$typeInfo){
          $type=db('type')->select();
          foreach ($type as $v) {
              $typeInfo[$v['id']]=$v;
          }
          cache('type',$typeInfo,3600*24);
      }
      return $typeInfo;
  }
}
// 删除类型缓存
if(!function_exists('del_type_cache')){
     function del_type_cache(){
         return cache('type',null);
     }
}


