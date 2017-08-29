<?php

ini_set('date.timezone','Asia/Shanghai');
require_once 'WxPay.Api.php';
require_once 'WxPay.JsApiPay.php';
class jsapi{
	public function prepay($data){
		$tools = new \JsApiPay();
		$openId = $tools->GetOpenid();
		$input = new \WxPayUnifiedOrder();
		$input->SetBody("蓝海工具");
		$input->SetOut_trade_no(time().'123');
		$input->SetTotal_fee("1");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetNotify_url("https://mayunqq.com/paynotify/wxnativepay");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = \WxPayApi::unifiedOrder($input);
		//echo '122255444';die;
		//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		//print_r($order);die;
		$jsApiParameters = $tools->GetJsApiParameters($order);
		//获取共享收货地址js函数参数
		//$editAddress = $tools->GetEditAddressParameters();

		//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
		/**
		 * 注意：
		 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
		 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
		 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
		 */
		 return $jsApiParameters;
	}
}


?>
