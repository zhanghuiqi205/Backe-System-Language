<?php

//配置文件

return array(
	    'db' => array(
			'type'=>'mysql',
            'host'=>'127.0.0.1',
            'port'=>3306,
			'user'=>'root',
			'pwd'=>'151766',
			'dbname'=>'php1210',
            'charset'=>'utf8',
            'prefix'=>'blog_'			
			),
        //分页，一页显示多少条记录
        'rowsPerPage'=>2,
        //验证码相关的匹配
        'width'=>100,
        'height'=>32,
        'chars'=>4,
        //图片上传所保存的目录
        'path'=>'./upload/images',
        'maxsize' => 1024*1024*5,
        'mime' => ['image/jpeg','image/jpg','image/pjpeg','image/png'],
        //缩略图的设置：
        't_w'=>200,
        't_h'=>200,
        'thumb'=>'./upload/thumber'
);