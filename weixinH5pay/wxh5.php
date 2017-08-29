<?php
namespace weixinpayApp;
include 'wechatH5Pay.php';
class wxh5{
	//$data 金额和订单号
	public function wxh5Request($data){
		$appid = 'wxdf************';
		$mch_id = '*********';//商户号
		$key = '32位申请时自己设置的';//商户key
		$notify_url = "https://www.mayunqq.com/paynotify/wxnativepay";//回调地址
		$wechatAppPay = new \wechatAppPay($appid, $mch_id, $notify_url, $key);
		$params['body'] = '蓝海工具商城';                       //商品描述
		$params['out_trade_no'] = $data['oid'];    //自定义的订单号
		$params['total_fee'] = '1';                       //订单金额 只能为整数 单位为分
		$params['trade_type'] = 'MWEB';                   //交易类型 JSAPI | NATIVE | APP | WAP 
		$params['scene_info'] = '{"h5_info": {"type":"Wap","wap_url": "https://api.lanhaitools.com/wap","wap_name": "蓝海工具商城"}}';
		$result = $wechatAppPay->unifiedOrder( $params );
		$url = $result['mweb_url'].'&redirect_url=https%3A%2F%2Fapi.lanhaitools.com/wap
';//redirect_url 是支付完成后返回的页面
		return $url;
	}
}
    
?>