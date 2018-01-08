<?php
/**
 * 由于模型类就是用于操作数据库
 * 而且只要是实例化就是要操作数据库，
 * 只要操作数据库就必须实化MyPDO。
 * 并且任何一个模型类都需要这样的MyPDO对象。
 * 所以为了减少代码的冗余，我们创建一个模型父类
 */

namespace Core;
class model{
    protected $pdo =null;
    public function __construct(){
       $config = $GLOBALS['config']['db'];
       return $this->pdo = new MyPDO($config);
    }
}