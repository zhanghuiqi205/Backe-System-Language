<?php

//定义入口文件(单一入口)
// 定义项目所在的目录
define("APP_PATH","./App");

//引入框架文件frame.class.php
include 'Frame/Core/Frame.class.php';
//执行框架文件唯一公开的对外静态方法
Frame::run();