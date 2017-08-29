<?php
namespace weixinpayApp;
ini_set('date.timezone','Asia/Shanghai');
require_once 'WxPay.Api.php';
require_once 'WxPay.NativePay.php';

class native{
	public function prepay($data){
		$notify = new \NativePay();
		$input = new \WxPayUnifiedOrder();
		$input->SetBody("蓝海工具");
		$input->SetOut_trade_no($data['oid']);//订单号
		$input->SetTotal_fee("1");//支付金额 单位分
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("蓝海工具");
		$input->SetNotify_url("https://api.lanhaitools.com/paynotify/wxnativepay");
		$input->SetTrade_type("NATIVE");
		$input->SetProduct_id($data['oid']);//订单id
		$result = $notify->GetPayUrl($input);
		if(isset($result["code_url"])){
			$url2 = $result["code_url"];
			return $url2;
		}
		
	}
}


?>
