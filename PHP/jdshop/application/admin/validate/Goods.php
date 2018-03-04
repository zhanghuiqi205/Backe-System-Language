<?php
namespace app\admin\validate;
use think\Validate;

// 商品的验证器

class Goods extends Validate{
    // 定义验证规则

    protected $rule=[
       'goods_name|商品名称'=>'require|length:1,100',
       'goods_number|商品数量'=>'require|egt:0',
       'market_price|市场售价'=>'require|egt:0',
       'shop_price|本店售价'=>'require|checkShopPrice'
    ];
    // 设置错误信息
    protected $message =[
      'goods_name.length'=>'长度不满足要求',
      'shop_price.checkShopPrice'=>'本店售价比市场还贵'
    ];
    // 检查本店售价
    public function checkShopPrice($value,$rule,$data)
    {
        if($value>=$data['market_price']){
            return false;
        }
        return true;
    }
} 
    

