<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\Admin\Profession;
class ProfessionController extends Controller
{
    public function detail()
    {
        // 获取数据
        $data = Profession::find(Input::get('id'));
        // 展示视图
        return view('home.profession.detail',compact('data'));
    }
    public function showOrder()
    {
        // 获取id数据
        $data = Profession::find(Input::get('id'));
        //展示视图
        return view('home.profession.showorder',compact('data'));
    }


    public function payWithWX()
    {
        require_once "./wx/lib/WxPay.Api.php";
        require_once "./wx/example/WxPay.NativePay.php";
        require_once './wx/example/log.php';
        //  查询当前的商品信息
        $data = Profession::find(Input::get('id'));
        $notify = new \NativePay();
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("{$data -> pro_name}课程支付");   //商品描述,必填
        $input->SetAttach("好好学习,天天向上");  //附加信息  选填
        $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));//商户订单号
        $input->SetTotal_fee($data ->price*100*0.0001);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 1800));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://two.com/wx/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($data ->id);
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        return "<img alt='扫码支付' src='http://paysdk.weixin.qq.com/example/qrcode.php?data=" . urlencode($url2) . "' style='width:150px;height:150px;'/>";
    }
}
