<?php
/*
	支付功能
*/

		 //	更新订单状态
    function update_order() {
        //print_r($_GET);exit;
/*		Array ( [buyer_email] => 13401042940 [buyer_id] => 2088702563886771 [exterface] => create_direct_pay_by_user 
		[is_success] => T [notify_id] => RqPnCoPT3K9%2Fvwbh3InTvPfuq5BXCf%2F4bocQfLOKmSJa421I10ROCa9eXsKlZ7PGogPL 
		[notify_time] => 2015-03-18 16:09:22 [notify_type] => trade_status_sync [out_trade_no] => 1000003451426666131 
		[payment_type] => 1 [seller_email] => allstarway@126.com [seller_id] => 2088011992057121 [subject] => è®¢å•12 
		[total_fee] => 0.01 [trade_no] => 2015031800001000770046538594 [trade_status] => TRADE_SUCCESS 
		[sign] => 00d8217c3e8fa7eb2f7265f343efda98 [sign_type] => MD5 ) */
        extract($_GET);
		$resp_arr = exec_procedure($_GET, 'p_update_order');
		if($resp_arr['status'] != 0)
			die_err_code($resp_arr['status'], __LINE__);
		if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS'){
				//成功处理
		}
		else{
				//订单失败处理
			}
    }
?>