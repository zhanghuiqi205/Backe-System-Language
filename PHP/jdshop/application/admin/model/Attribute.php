<?php
namespace app\admin\model; 
use think\Model; 



class Attribute extends Model{

    public function getAttrTypeAttr($value){
        $data = ['1'=>'唯一','2'=>'单选'];
        return $data['$value'];
    }
    public function getAttrInputTypeAttr()
    {
        $data = ['1'=>'手工输入','2'=>'列表选择'];
        return $data['$value'];
    }

    // 
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
        return Attribute::alias('a')->join('jd_type b','a.type_id=b.id','left')->field('a.*,b.type_name')->select();
    }

    

}
