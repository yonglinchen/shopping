<?php

require_once(dirname(dirname(dirname(__FILE__))) . "/libcode/base.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/libcode/fun.php");
//	require_once(dirname(dirname(dirname(__FILE__)))."/sms/code/sms.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/mail/sendmail.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/zxsendmsg/sendmsgzx.php");

/*
 * 生成,发送验证码
 */
function get_pwd_general($body_arr) {
    //判断联系方式是否绑定过
    $resp_is_bind_arr = exec_procedure($body_arr, 'p_is_bind');
    $contact = $body_arr['contact'];
    $type = $body_arr['type'];
    $callback = $body_arr['callback'];
    extract($resp_is_bind_arr);
    //未绑定返回
    if ($status != 0) {
        die_err_code($status, __LINE__);
        return;
    }

    //生成验证码
    $resp_general_arr = exec_procedure($body_arr, 'p_general_code_getpd');

//		$code = $data[0]['code'];
    if ($status != 0)
        die_err_code($status, __LINE__);

    $data0 = $resp_general_arr['data'][0];
    extract($data0);
    $code = isset($data0['code']) ? $data0['code'] : '';
    $deadminutes = isset($data0['deadminutes']) ? $data0['deadminutes'] : '';
    //发送邮件
    if ($type == 1) {//1:邮箱,2:手机
        if ($deadminutes % 60 == 0) {
            $timeinfo = ($deadminutes / 60) . '小时';
        } else {
            $timeinfo = $deadminutes . '分钟';
        }
        $httpmsg = "亲爱的用户，您好！<br/>您正在执行找回密码操作，请在" . $timeinfo . "内点击下面的链接完成您的邮箱验证：<br/>" .
                '<a href="' . (_MAILCALLBACK_ . $callback) . '?mark=' . $code . '&email=' . $contact . '&userid=' . getSessonUserData('userid') . '" target="_blank">' .
                (_MAILCALLBACK_ . $callback) . "mark=" . $code . '&email=' . $contact . '&userid=' . getSessonUserData('userid') . "</a>" .
                "<br>如果以上链接无法点击，请将上面的地址复制到您的浏览器（如IE）的地址栏打开。<br>" .
//                    sendmail($contact, $message);
        $data['subject'] = '找回密码';
        $data['fromname'] = '骑士团';
        $data['to'] = $body_arr['contact'];
        $data['body'] = $httpmsg;
        $data['img'] = ''; //绑定邮箱，没有附加图片
        $data['attach'] = ''; //绑定邮箱，没有附件
        sendemail($data);
    } else if ($type == 2) {
        $sms = "尊敬的用户:" . _MAILSUBJECT_ . ",您好,您正在找回密码，验证码:" . $code . ',有效期为：' . $deadminutes . "分钟";
//                    sendmsg_zx($contact,$sms);
    }

    return $resp_general_arr;
}

/*
 * 校验验证码
 */
function get_pwd_check($body_arr) {
    $resp_arr = exec_procedure($body_arr, 'p_check_code');
    return $resp_arr;
}
?>


