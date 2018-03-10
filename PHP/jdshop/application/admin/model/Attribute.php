<?php
namespace app\admin\model; 
use think\Model; 
use think\Db;


class Attribute extends Model{
    public function addAttribute(){
        $data = input();
        $validate = validate('Attribute');
        if(!$validate->check($data)){
            $this->error = $validate->getError();
            return false;
        }
       return Attribute::isUpdate(false)->save($data);
    }
    
    public function listData(){
        // 采取这种方式，可以使用缓存
        // 获取所有类型的信息
        $typeInfo =get_type_info();
        $data = Attribute::all();
        foreach ($data as $key => $value) {
            $value =$value->toArray();  //对象转换为数组
            $value['type_name']=$typeInfo[$value['type_id']]['type_name'];
            $list[]=$value;
        }
        return $list;
    }
    public function editAttribute(){
        $data = input();
        $validate =validate('Attribute');
        if(!$validate->check($data)){
           $this->error= $validate->getError;
           return false;
        }
        return Attribute::isUpdate(true)->where(['id'=>$data['id']])->update($data);
    }

    

}
