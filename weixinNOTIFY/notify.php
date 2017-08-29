<?php
require 'wechatAppPay.php';
$appid = 'wxdf**************';
$mch_id = '********';
$key = '32位key';
$notify_url = "https://mayunqq.com/paynotify/wxnativepay";
$checkSign = new wechatAppPay($appid, $mch_id, $notify_url, $key);
$arr = $checkSign->getNotifyData();//获取数据(微信服务器返回的数据)

$w_sign = array();           //参加验签签名的参数数组                     
$w_sign['appid']             = $arr['appid'];
$w_sign['bank_type']         = $arr['bank_type'];
$w_sign['cash_fee']          = $arr['cash_fee'];
$w_sign['fee_type']          = $arr['fee_type'];
$w_sign['is_subscribe']      = $arr['is_subscribe'];
$w_sign['mch_id']            = $arr['mch_id'];
$w_sign['nonce_str']         = $arr['nonce_str'];
$w_sign['openid']            = $arr['openid'];
$w_sign['out_trade_no']      = $arr['out_trade_no'];
$w_sign['result_code']       = $arr['result_code'];
$w_sign['return_code']       = $arr['return_code'];
$w_sign['time_end']          = $arr['time_end'];
$w_sign['total_fee']         = $arr['total_fee'];
$w_sign['trade_type']        = $arr['trade_type'];
$w_sign['transaction_id']    = $arr['transaction_id'];
//生成签名
$verify_sign = $checkSign->MakeSign($w_sign);

if($arr['result_code'] == 'SUCCESS' && $verify_sign == $arr['sign']){//验证签名
    $data= ['oid'=>$arr['out_trade_no'],'buyerid'=>$arr['openid'],'trade_no'=>$arr['transaction_id'],'receipt'=>$arr['total_fee']];

    $ret =  AfterPayOrder($data,$return_url);//自己写修改订单状态 付款状态===
    if(!$ret){
        //('订单支付成功后，状态操作失败'.$_POST['out_trade_no']);
    }else{
        
        $checkSign->replyNotify();//操做成功  通知微信 停止异步通知
    }
}else{
    $msg = isset($arr['out_trade_no'])?'订单：'.$arr['out_trade_no']:'支付时间：'.date('Y-m-d H:i:s',time());
    //$msg.'异步通知失败,请联系开发人员'
}



  ?>
