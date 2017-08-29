<?php
namespace weixinpayApp;
include 'wechatAppPay.php';
class wxapp{
	public function wxappRequest($data){
		$appid = 'wxdf************';
		$mch_id = '***********';//商户号
		$key = '32位key';
		$notify_url = "https://mayunqq.com/paynotify/wxnativepay";
		$wechatAppPay = new \wechatAppPay($appid, $mch_id, $notify_url, $key);
		$params['body'] = $data['body'];                       //订单名称
		$params['out_trade_no'] = $data['oid'];    //订单号
		$params['total_fee'] = '1';                       //交易金额 单位分
		$params['trade_type'] = 'APP';                   //支付方式 JSAPI | NATIVE | APP | WAP 
		$result = $wechatAppPay->unifiedOrder( $params );
		/** @var TYPE_NAME $result */
		$data = @$wechatAppPay->getAppPayParams( $result['prepay_id'] );

		//print_r($data);die;

		return json_encode($data);
	}
}
    
?>