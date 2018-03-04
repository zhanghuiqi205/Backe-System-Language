<?php
namespace app\admin\model;
use think\Model;
use think\Image; 

// 商品模型

class Goods extends Model{
    public function addGoods(){
        $postData =input();
        // 校验货号
        if($this->checkGoodsSn($postData)===false){
            $this->error ="货号错误";
            return false;
        }
        // 验证错误
        $obj = validate('Goods');
        if(!$obj->check($postData)){
          $this->error = $obj->getError();
          return false;
        }
        // 实现图片上传
        if($this->uploadImg($postData)===false){
            // 上传图片失败 中断
            return false;
        }
        $postData['addtime']=time();

       //allowField设置容许写入的字段
       //每个字段使用逗号隔开，设置为true表示根据数据表字段进行过滤 
        return Goods::isUpdate(false)->allowField(true)->save($postData);
    }

    //引用传值，这样函数内部可以修改函数外部的数据
    public function checkGoodsSn(&$data,$isUpdate=false)
    {
        if(!$data['goods_sn']){
            $data['goods_sn'] = 'JX'.uniqid();
            return true;
        }
        if($isUpdate){
            $where=[
                'goods_sn'=>$data['goods_sn'],
                'id'=>['neq',$data['id']]
            ];
            if(Goods::get($where)){
                return false;
            }
        }else{
            // 存在对比重复
            if(Goods::get(['goods_sn'=>$data['goods_sn']])){
                return false;
            }   
        }
    }

    // 实现图片上传
    public function uploadImg(&$data,$isMust=true)
    {
        // 1.获取文件信息
        $file = request()->file('goods_img');
        //   限制图片是否上传
        if($file===null){
            if($isMust){
              $this->error ='必须上传图片';
              return false;
            }else{
                // 没有图片但是不要求上传
                return true;
            }
        }
        // 2.文件上传
        $info = $file->move('uploads');
        if(!$info){
            $this->error =$file->getError();
            return false;
        }
        // 获取上传地址
        $data['goods_img']='uploads/'.str_replace('\\','/',$info->getSaveName());
        // 打开图片
        $image =Image::open($data['goods_img']);
        // 生成缩略图
        $data['goods_thumb']='uploads/'.date('Ymd').'/thumb_'.$info->getFileName();
        
        $image->thumb(200,200)->save($data['goods_thumb']);



        // 实现转移
        $result = upload_to_cdn($data['goods_img']);
        $result2 = upload_to_cdn($data['goods_thumb']);
        // 删除原始图片
        if($result&&$result2){
            @unlink($data['goods_img']);
            @unlink($data['goods_thumb']);
        }
    }

    //获取商品列表数据
    public function listData($isdel=1){

      //需要显示为正常状态商品
       $where =['a.isdel'=>$isdel];
      //拼接各种条件筛选数据
      $cate_id =input('cate_id');//接受提交分类的id
      if($cate_id){
          $tree = model('Category')->getTree($cate_id,true);
          $cate_ids[]=$cate_id;
          foreach ($tree as $v) {
              $cate_ids[]=$v['id'];
          }
          $cate_ids = implode(',',$cate_ids);
          $where['a.cate_id']= ['in',$cate_ids];
      }
       // 处理推荐状态
        $intro_type = input('intro_type');
        if($intro_type){
            $where['a'.$intro_type]=1;
        }
       
        // 处理上下架状态
        $is_sale =input('is_sale');
        if($is_sale){
            if($is_sale==1){
                $where['a.is_sale']=1;
            }else{
                $where['a.is_sale']=0;
            }
        }
        //处理关键词
        $keyword =input('keyword');
        if($keyword){
            $where['a.goods_name']=['like','%'.$keyword.'%'];
        }


        $data =Goods::alias('a')->where($where)->join('jd_category b','a.cate_id=b.id','left')->field('a.*,b.cname')->paginate(1,false,['query'=>request()->param()]);
        return $data;
    }
    // 修改状态的函数
    public function setStatus($goods_id,$field)
    {
        $allow =['is_sale','is_hot','is_new','is_rec'];
        if(!in_array($field,$allow)){
           $this->error ="field error";
           return false;
        }
        $goodsInfo = Goods::where(['id'=>$goods_id])->find();
        $nowStatus = $goodsInfo->getAttr($field);
        $status = $nowStatus?0:1;
        Goods::where(['id'=>$goods_id])->setField($field,$status);
        return $status;
    }
    public function editGoods()
    {
        $postData = input();
        if($this->checkGoodsSn($postData,true)===false){
           $this->error ="货号错误";
           return false;
        }
        //  验证数据
        $obj = validate('Goods');
        if($obj->check($postData)){
            $this->error = $obj ->getError();
            return false;
        }
        // 实现图片上传
        if($this->uploadImg($postData,false)===false){
            return false;
        }
        return Goods::isUpdate(true)->allowField(true)->where(['id'=>$postData['id']])->update($postData);
    }

}

