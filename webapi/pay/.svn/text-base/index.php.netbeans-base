<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once("mobilepay/alipaysdk/lib/alipay_submit.class.php");
require_once("mobilepay/alipaysdk/lib/alipay_rsa.function.php");
require_once("mobilepay/wxpay/lib/WxPay.Api.php");

/*
 * 生成订单
 * 逻辑：先生成订单，产生订单号，再根据订单号添加具体商品信息
 */
function generate_order($body_arr) {
    if($body_arr['amount']<1){ //金额小于1，代表小于1分钱，不允许
        $resp['status'] = 1047;
        return $resp;
        exit;
    }
    $resp = exec_procedure($body_arr, 'p_order_generate');
    if ($resp['status'] != 0) {
        return $resp;
        exit;
    }
    $order_no = $resp['out_data']['order_no']; //生成的orderno
    $goods = $body_arr['goods']; //用户传过来的商品信息，json格式
    //建立一个数据库连接
    $mysqli = create_conn();
    //解析商品数据
    $body['order_no'] = $order_no;
    foreach ($goods as $key => $value) {
        $body['good_id'] = isset($value['good_id']) ? $value['good_id'] : '';
        $body['number'] = isset($value['number']) ? $value['number'] : '';
        if (!$body['good_id']) {
            continue;
        }
        $respgood = exec_procedure($body, 'p_order_add_goods', 2, $mysqli);
    }
    //关闭句柄
    close_conn($mysqli);
    //为了配合移动端的代码，把端口号、支付渠道移到上一层
    $resp['order_no'] = isset($resp['out_data']['order_no'])?$resp['out_data']['order_no']:'';
    $resp['pay_channel'] = isset($resp['out_data']['pay_channel'])?$resp['out_data']['pay_channel']:'';
    return $resp;
}

/*
 * 跳转到相应的支付渠道
 * 网页支付
 * 逻辑：
 */

function jump_paychannel($body_arr) {
    $resp = exec_procedure($body_arr, 'p_order_pay_info');
    $channel = $body_arr['channel']; //channel
    $order_no = $body_arr['order_no'];
    switch ($channel) {
        case 'wx': //微信支付，微信支付应该都是移动端接口
//            header("Location:" . _ROOT_URL_ . 'pay/pc_pay/wxpay/index.php');
            break;
        case 'alipay': //阿里支付
            header("Location:" . _ROOT_URL_ . 'pay/pc_pay/alipay/alipayapi.php?order_no=' . $order_no); //
            break;
        case 'alipaybank': //阿里网银支付
            header("Location:" . _ROOT_URL_ . 'pay/pc_pay/alipaybank/alipayapi.php?order_no='
                    . $order_no.'&WIDdefaultbank='.$body_arr['paybank']);
            break;
        case 'alipayweb'://阿里移动 网页支付
            header("Location:" . _ROOT_URL_ . 'pay/mobilepay/alipayweb/alipayapi.php?order_no=' . $order_no); //
            break;
        default :
            break;
    }
//    $goods = $body_arr['goods']; //用户传过来的商品信息，json格式
//    //建立一个数据库连接
//    $mysqli = create_conn();
//    //解析商品数据
//    $goodsarr = json_decode($goods, true);
//    $body['order_no'] = $order_no;
//    foreach ($goodsarr as $key => $value) {
//        $body['good_id'] = $value['good_id'];
//        $body['number'] = $value['number'];
//        $respgood = exec_procedure($body, 'p_order_add_goods',2,$mysqli);
//    }
//    //关闭句柄
//    close_conn($mysqli);
    exit;
}

/*
 * 专用语移动端app的支付逻辑
 * app支付
 */
function echo_paychannel($body_arr) {    
    $resp = exec_procedure($body_arr, 'p_order_pay_info');
    $resp['channel'] = $body_arr['channel']; //channel
    switch ($resp['channel']) {
        case 'wxapp': //微信app支付
            $respnew = joinwxinfo($body_arr);
            $resp = array_merge($resp,$respnew);
            break;
        case 'alipayapp'://阿里app支付
            $resp['ali_pay_info'] = joinalipayinfo($body_arr);
            break;
        default :
            break;
    }
    return $resp;
}

/*
 * 拼接微信app支付的消息
 */
function joinwxinfo($body_arr) {
    $resp = array();
    $order_no = $body_arr['order_no'];
    $randnum = rand(1000, 9999); //产生一个4位随机数
    $out_trade_no = $order_no ;//. '-' . $randnum; //记录订单号+_+随机数
//    $arr['device_info'] = isset($body_arr['client_ip'])?$body_arr['client_ip']:''; //客户端地址
    $input = new WxPayUnifiedOrder();
    $input->SetBody($out_trade_no);
    $input->SetOut_trade_no($out_trade_no);
    $input->SetTotal_fee(getfee($body_arr)); //这里是微信，默认单位：分
    $time = time();
    $input->SetTime_start(date("YmdHis"),$time);
    $input->SetTime_expire(date("YmdHis", $time + 600));
    $input->SetNotify_url(_WXNOTIFYURL_.'pay/mobilepay/wxpay/interface/appnotify.php');
    $input->SetTrade_type("APP"); 
//    $WxPayUnifiedOrder->SetAttach("test");
//    $input->SetGoods_tag("test");
//    $input->SetProduct_id("123456789");
    $retarr = WxPayApi::unifiedOrder($input);//返回数据解析为数组了
    if($retarr['return_code']=='SUCCESS'){//成功
        $nostr = WxPayApi::getNonceStr();
        $resp['wx_app_id'] = $retarr['appid'];
        $resp['wx_partner_id'] = $retarr['mch_id'];   
        $resp['wx_nonce'] = $nostr;//$retarr['nonce_str'];
        $resp['wx_timestamp'] =$time;//date("YmdHis");
        $retinput = new WxPayReplyData();
   
        if($retarr['result_code']=='SUCCESS'){
            $resp['wx_prepay_id'] = $retarr['prepay_id'];
            $retinput->SetappId(WxPayConfig::APPID);//公众账号ID
            $retinput->SetnonceStr($nostr);//随机字符串 
            $retinput->Setpackage('Sign=WXPay');
            $retinput->SetpartnerId($retarr['mch_id']);   
            $retinput->SetprepayId($retarr['prepay_id']); 	  
            $retinput->SettimeStamp($time);//
            $resp['wx_sign'] = $retinput->MakeSignSpecil();
        }
        $resp['wx_package'] = 'Sign=WXPay';//固定值
    }
    else{
        $resp = $retarr;
        $resp['status']  = 1046;
        $resp['desc']  = '失败';
    }
    return $resp;
}

/*
 * 拼接阿里app支付的消息
 */
function joinalipayinfo($body_arr) {
    $order_no = $body_arr['order_no'];
    $randnum = rand(1000, 9999); //产生一个4位随机数
    $out_trade_no = $order_no ;//='1449136260764';//. '-' . $randnum; //记录订单号+_+随机数
    $fee = getfee($body_arr) / 100; //支付宝支付，这里需要变换单位：元
//    $info = 'partner="' . _ALIPAYPARTNER_ . '"&seller_id="' . _ALIPAYSELLEREMIAL_ 
//            . '"&out_trade_no="'. $out_trade_no . '"&subject="' . $order_no . '"&body="' 
//            . $order_no . '"&total_fee="' . $fee . '"&notify_url="' . _ALIPAYAPPNTURL_ 
//            . '"&service="mobile.securitypay.pay'. '"&payment_type="1"&_input_charset="utf-8'
//            . '"&it_b_pay="30m';//&show_url='._MAILCALLBACK_;
    $infonew = array(
        'partner'=> _ALIPAYPARTNER_ ,
        'seller_id'=> _ALIPAYSELLEREMIAL_, 
        'out_trade_no'=> $out_trade_no ,
        'subject'=> $order_no ,
        'body' => $order_no ,
        'total_fee' => $fee ,
        'notify_url' => _ALIPAYAPPNTURL_ ,
        'service' => 'mobile.securitypay.pay',
        'payment_type' =>'1',
        '_input_charset' =>'utf-8',
        'it_b_pay' =>'30m',
    );
    $infonew = creatersanew($infonew);
//    $info = $info. '"&sign="' . $sign . '"&sign_type="RSA"';
    ilog(3, "RESP:".$infonew, __LINE__);
    return $infonew;
}

/*
 * 查询订单
 */
function getfee($body_arr) {
    $ret = exec_procedure($body_arr, 'p_order_fee_calc');
    $ret['order_no'] = $body_arr['order_no'];
    $total_fee = isset($ret['out_data']['fee'])?$ret['out_data']['fee']:0; //单位：分
    return $total_fee;
}

/*
 * 生成RSA密码
 * 测试有问题，使用creatersanew
 */
function creatersa($info){
    $rsa=rsaSign($info, dirname(__FILE__).'/mobilepay/alipaysdk/key/rsa_private_key.pem');
    return $rsa; 
}

/*
 * 生成RSA密码
 * $info:数组
 */
function creatersanew($info){
    require_once("mobilepay/alipaysdk/alipay.config.php");
    $alisub = new AlipaySubmit($alipay_config);
    $rsa=$alisub->buildRequestParaToString($info);
    return $rsa; 
}

/*
 * 客户端主动请求数据，如果没有成功，
 * 服务器主动请求微信、阿里服务器，对账
 */
function queryorderstatus($body_arr) {
    $resp = array();
    $ret = exec_procedure($body_arr, 'p_order_fee_calc');
    if($ret['status']==0 &&($ret['out_data']['order_state']==0 ||$ret['out_data']['order_state']==1)){
        //主动请求，如果对账出现差异，修改数据库
        $paychannel = isset($ret['out_data']['pay_channel'])?$ret['out_data']['pay_channel']:'';
        if(!$paychannel){
            $paychannel = isset($body_arr['channel'])?$body_arr['channel']:'';
        }
        switch ($paychannel){
            case 'wxapp':
               $resp = wxqueryorderdata($body_arr);
                break;
            case 'alipayapp':
                $resp=$ret;
                $resp['order_state']=$ret['out_data']['order_state'];
                break;
            default :
                $resp['status'] = 1041;
                $resp['desc'] = '等待支付';
                break;
        }
    }
    else{
        $ret['order_state']=$ret['out_data']['order_state'];
        return $ret;
    }
    return $resp;
}

/*
 * 对账接口
 * 数据库显示未支付成功，这里做一下确认
 * 查询订单，组装数据
 * wx
 */
function wxqueryorderdata($body){
//    $data['pay_no'] = isset($body['out_data']['pay_no'])?$body['out_data']['pay_no']:'';
//    if(!$data['pay_no']){
//        $ret1['status'] = 1041;
//        $ret1['desc'] = '等待支付';
//        return $ret1;
//    }
    $queryOrderInput = new WxPayOrderQuery();
    $queryOrderInput->SetOut_trade_no($body['order_no']);
    $ret = WxPayApi::orderQuery($queryOrderInput);//数据已经解析为了数组格式
    $retexec=array();
    if($ret['return_code']=='SUCCESS'){ //查询成功
        $resp['wx_app_id'] = $ret['appid'];
        $resp['wx_partner_id'] = $ret['mch_id'];   
        if($ret['result_code']=='SUCCESS'){ //
            switch($ret['trade_state']){
                case 'SUCCESS': //支付成功    
                    $body['pay_result'] = 2;
                    $body['pay_time'] = $ret['time_end'];
                    $retexec = exec_procedure($body, 'p_order_update_result');
                    $retexec['order_state'] = 2;
                    break;
                case 'REFUND': //转入退款
                 case 'NOTPAY'://未支付
                case 'CLOSED'://已关闭
                case 'REVOKED'://已撤销
                 case 'USERPAYING'://用户支付中
                case 'PAYERROR'://支付失败
                    $retexec = exec_procedure($body, 'p_order_query_result');
                    $retexec['out_state'] = isset($retexec['out_data']['out_state'])?$retexec['out_data']['out_state']:0;
                    break;
            }
        }
        return $retexec;
    }
    else{
        $ret['status'] = 1045;
        return $ret;
    }
}


/*
 * 验证签名
 */
function verifysign($body){
    $realdata = $body['realdata'];
//    print_r($realdata);exit;
    $sign = $body['sign'];
    $ret = rsaVerify($realdata, _ROOT_URL_.'pay/mobilepay/alipaysdk/key/alipay_public_key.pem',$sign);
    if($ret){
        $ret1['status'] = 0;
        $ret1['ret'] = $ret;
    }
    else{
        $ret1['status'] = -1;
        $ret1['ret'] = $ret;
    }
    return $ret1; 
}

                