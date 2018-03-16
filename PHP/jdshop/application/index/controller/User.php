<?php
namespace app\index\controller;

// 用户控制器
class User extends Common{
    // 实现用户注册
    public function regist()
    {
        if($this->request->isGet()){
            return $this->fetch();
        }
    } 
}