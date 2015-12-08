<?php

$GLOBALS['_ERR_CODE'] = array(
    // 成功
    'suc_req_done' => '200',
    'suc_req_doing' => '202',
    // 失败
    'err_default' => '400',
    // 请求错误
    'err_unauthor' => '401',
    'err_auth_fail' => '402',
    'err_forbidden' => '403',
    'err_invalid_user' => '404',
    'err_dev_notmatch' => '405',
    'err_port_notmatch' => '406',
    'err_invalid_auth' => '407',
    'err_invalid_param' => '410',
    'err_mysql_con' => '420',
    'err_mysql_sel' => '421',
    'err_file_path' => '422',
    'err_file_upload' => '423',
    'err_exec_sys' => '424',
    'err_send_fax' => '425',
    'err_fax_id' => '426',
    'err_send_notify' => '427',
    'err_null_result' => '428',
    'err_null_out' => '429',
    'err_query_fail' => '430',
    'err_no_file' => '431',
    'err_read_file' => '432',
    'err_decrypt' => '433',
    'err_encrypt' => '434',
    'err_json' => '435',
    'err_key' => '436',
    'err_start_byte' => 437,
    'err_apiv' => 438,
    'err_print' => 439,
    'err_no_device' => '460', //设备服务器占用
    // 平台错误
    'err_fax_serv_busy' => '500',
    'err_fax_format_fail' => '501',
    'err_fax_send_param' => '502',
    'err_fax_file_noexist' => '503',
    'err_fax_format' => '504',
    'err_fax_format_save' => '505',
    'err_fax_call_fail' => '506',
    'err_fax_call_timeout' => '507',
    'err_fax_timeout' => '508',
    'err_fax_send' => '509',
    'err_fax_send_data' => '510',
    'err_fax_recv' => '511',
    'err_fax_recv_data' => '512',
    'err_fax_auth' => '513',
    'err_msg_init' => '514',
    'err_msg_send' => '515',
    'err_fax_ext_updata' => '516',
    // 数据库错误
    'err_sql_data' => '600',
    'err_sql_no_ext' => '601',
    'err_sql_no_admin' => '602',
    'err_sql_no_fax' => '603',
    'err_sql' => '604',
    'err_sql_dup_ext' => '605',
    'err_sql_pwd' => '606',
    'err_sql_auth' => '607',
    'err_sql_adm_null' => '609',
    'err_sql_self' => '610',
    'err_login_flag' => '617',
    'err_same_ow' => '619',
    'err_re_set' => '620',
    'err_msgid' => '621',
    'err_msgtype' => '622',
    'err_status_null' => '999'
);

/*
 * 错误码
 */
$GLOBALS['_ERR_INFO'] = array(
    // 成功
    '0' => "成功",
    // 失败 业务
    '1001' => "帐号不存在",
    '1002' => "请不要频繁生成验证码",
    '1003' => "验证码错误",
    '1004' => "您的联系方式未绑定",
    '1005' => "该联系方式已绑定",
    '1006' => "发送邮件失败",
    '1007' => "传入的参数有误",
    '1008' => "密码错误",
    '1009' => "更新失败",
    '1010' => "帐号已存在",
   /* '1011' => "该权限不能删除",
    '1012' => "该角色不能删除",
    '1013' => "角色不存在",
    '1014' => "权限不存在",
    '1015' => "角色与权限已绑定",
    '1016' => "角色与权限未绑定",
    '1017' => "角色已存在",
    '1018' => "权限已存在",
    '1020' => "请先上传版本",*/
    '1021' => "参数有误",
    '1031' => "文件路径有误",
    '1032' => "邮箱已经存在",
    '1033' => "手机已经存在",
    '1034' => "帐号已被绑定",
    '1035' => "您尚未登录，请重新登录",
    '1036' => "邮箱尚未激活，请激活后登录",
    '1037' => "订单号为空，请重新下单",
    '1038' => "订单号对应的订单数据有误",
    '1039' => '订单已失效',//
    '1040' => '订单已支付成功，不要重复支付',// 
    '1041' => '订单已生成，等待审核',// 
    '1042' => '订单手动取消',// 
    '1043' => '商品已经被添加',// 
    '1044' => '订单号无效',// 
    '1045' => '对账查询失败',// 
    '1046' => '微信支付失败',// 
    '1047' => '支付金额不能低于1分钱',// 
    
    //系统错误
    '9999' => "存储过程执行异常",
);

function err_code($err_marco) {
    if (array_key_exists($err_marco, $GLOBALS['_ERR_CODE']))
        return $GLOBALS['_ERR_CODE'][$err_marco];
    else
        return 0;
}

function err_info($err_code) {
    if (array_key_exists($err_code, $GLOBALS['_ERR_INFO']))
        return $GLOBALS['_ERR_INFO'][$err_code];
    else
        return "未知错误";
}

function die_err_code($err_code, $line = "", $desp = "") {
    if (!isset($err_code)) {
        $err_code = 0;
    }
    global $log;
    if ($log) {
        $log->tag_line($line);
        if ($desp == "")
            $log->log(iLOG_ERROR, "---------> <" . $log->iTag_file . ":" . $line . "> " . $log->iLog_user . " " . $log->iLog_key . " error:" . $err_code . " info:" . err_info($err_code));
        else
            $log->log(iLOG_ERROR, "---------> <" . $log->iTag_file . ":" . $line . "> " . $log->iLog_user . " " . $log->iLog_key . " error:" . $err_code . " info:" . err_info($err_code) . " desp:" . $desp);
        $log->stop();
    }
    die('{"status":"' . $err_code . '","desc":"' . err_info($err_code) . '"}');
}

//有错误，但是会携带返回值
function die_err_code_ret($data, $line = "", $desp = "") {
    $err_code = $data['status'];
    if (!isset($err_code)) {
        $err_code = 0;
    }
    global $log;
    if ($log) {
        $log->tag_line($line);
        if ($desp == "")
            $log->log(iLOG_ERROR, "---------> <" . $log->iTag_file . ":" . $line . "> " . $log->iLog_user . " " . $log->iLog_key . " error:" . $err_code . " info:" . err_info($err_code));
        else
            $log->log(iLOG_ERROR, "---------> <" . $log->iTag_file . ":" . $line . "> " . $log->iLog_user . " " . $log->iLog_key . " error:" . $err_code . " info:" . err_info($err_code) . " desp:" . $desp);
        $log->stop();
    }
    $data['desc'] = err_info($err_code);
    die(json_encode($data));
}

function die_err($err_marco, $line = "", $desp = "", $file = '') {
    if ($file) {
        set_ilog($file);
    }
    $err_code = err_code($err_marco);
    die_err_code($err_code, $line, $desp);
}

?>