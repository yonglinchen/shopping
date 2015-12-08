<?php
require_once(dirname(dirname(dirname(__FILE__))) . "/libcode/base.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/libcode/fun.php");
//下面要根据不同短信网关，调用相应厂家提供的接口
require_once(dirname(dirname(dirname(__FILE__)))."/zxsendmsg/sendmsgzx.php");
//生成,发送验证码
function sms_general($body_arr) {
    $resp_arr = exec_procedure($body_arr, 'p_general_code');
    extract($resp_arr);

    if ($status != 0)
        die_err_code_ret($resp_arr, __LINE__);

    extract($body_arr);
    $code = $data[0]['code'];
    ilog(iLOG_INFO, "contact--->" . $contact, __LINE__);
    $content = '【'._MESSAGESUBJECT_.'】，您的验证码为：'.$code.'，有效期为：'.$deadminutes.'分钟！';
    //sendmsg_zx($contact, $content);
    return $resp_arr;
}

?>
