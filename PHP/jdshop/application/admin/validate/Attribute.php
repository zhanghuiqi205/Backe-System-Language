<?php
namespace app\admin\validate;
use think\Validate;

// 属性的验证器

class Goods extends Validate{
   
    // 验证规则
    protected $rule =[
      'attr_name'=>'require',
      'type_id'=>'require|gt:0',
      'attr_type'=>'require|in:1,2',
      'attr_input_type'=>'require|in:1,2'
    ];
}