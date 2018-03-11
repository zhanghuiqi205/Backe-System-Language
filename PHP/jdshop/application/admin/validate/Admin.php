<?php
namespace app\admin\validate;
use think\Validate;

// 属性的验证器

class Admin extends Validate{
    // 验证规则
    protected $rule =[
        'username'=>'require|unique:admin',
        'password'=>'require'
    ];
}