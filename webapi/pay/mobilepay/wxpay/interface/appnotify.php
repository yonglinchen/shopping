<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';
require_once('../../../../libcode/session.php');
require_once('../../../../serviceInterface.php');

//初始化日志
//$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
//$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
//		Log::DEBUG("query:" . json_encode($result));
                ilog(iLOG_INFO, 'Queryorder:'.json_encode($result), __LINE__);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
                {
                    $user_trade_no = $result['out_trade_no'];
                    $transaction_id = $result['transaction_id'];
                    $info1 = 'wxapp/interface/appnotify.php,operator success,session == trade_no,ordernum:'
                    . $user_trade_no . ',wxno:' . $transaction_id;
                     ilog(iLOG_INFO, $info1, __LINE__);
                    $body_arr['order_no'] = $user_trade_no;
                    $body_arr['pay_result'] = 2;  //支付成功
                    $body_arr['alipay_no'] = $transaction_id;  //微信流水号
                    $body_arr['channel'] = 'wxapp'; //
                    $ret = exec_procedure($body_arr, 'p_order_pay_result');
                    if ($ret['status'] == 0||$ret['status'] ==1040) { //成功，返回success
                      return true;
                    } else {  //返回错误码，非success  
                        $info = 'wxapp/interface/appnotify.php,p_order_pay_result failed';
                        ilog(iLOG_INFO, $info, __LINE__);
                        return false;
                    }
                }
                $info = 'wxapp/interface/appnotify.php,operator failed';
                ilog(iLOG_INFO, $info, __LINE__);
                //验证失败   
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
//		Log::DEBUG("call back:" . json_encode($data));
                ilog(iLOG_INFO,  'wxapp/interface/appnotify.php,call back:'.$data, __LINE__);
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}

//Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);

   