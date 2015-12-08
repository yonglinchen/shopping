<?php

//配置文件
require_once(dirname(dirname(dirname(__FILE__))) . "/libcode/base.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/libcode/fun.php");
//	require_once(dirname(dirname(dirname(__FILE__)))."/sms/code/sms.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/mail/sendmail.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/zxsendmsg/sendmsgzx.php");

/*
 * 生成,发送验证码
 */
function bind_general($body_arr) {
    $resp_arr = exec_procedure($body_arr, 'p_general_code');
    extract($resp_arr);

    if ($status != 0)
        die_err_code_ret($resp_arr, __LINE__);

    extract($body_arr);
    $code = $resp_arr['data'][0]['code'];
    $deadminutes = $resp_arr['data'][0]['deadminutes'];
    $callback = $body_arr['callback'];
    //发送邮件
    if ($type == 1) {//1:邮箱,2:手机
        $timeinfo = '';
        if ($deadminutes % 60 == 0) {
            $timeinfo = ($deadminutes / 60) . '小时';
        } else {
            $timeinfo = $deadminutes . '分钟';
        }
        $httpmsg = "亲爱的用户，您好！<br/>感谢您的注册，请在" . $timeinfo . "内点击下面的链接完成您的邮箱验证：<br/>" .
                '<a href="' . (_MAILCALLBACK_ . $callback) . '?mark=' . $code . '&email=' . $contact . '&userid=' . getSessonUserData('userid') . '" target="_blank">' .
                (_MAILCALLBACK_ . $callback) . "mark=" . $code . '&email=' . $contact . '&userid=' . getSessonUserData('userid') . "</a>" .
                "<br>如果以上链接无法点击，请将上面的地址复制到您的浏览器（如IE）的地址栏打开。<br>" .
//                    sendmail($contact, $message);
        $data['subject'] = '欢迎绑定邮箱';
        $data['fromname'] = '骑士团';
        $data['to'] = $body_arr['contact'];
        $data['body'] = $httpmsg;
        $data['img'] = ''; //绑定邮箱，没有附加图片
        $data['attach'] = ''; //绑定邮箱，没有附件
        sendemail($data);
    } else if ($type == 2) {
        $sms = "尊敬的用户您好，欢迎注册" . _MAILSUBJECT_ . "，验证码:" . $code . ',有效期为：' . $deadminutes . "分钟";
//                    sendmsg_zx($contact,$sms);
    }

    return $resp_arr;
}

/*
 * 校验验证码
 */
function bind_check($body_arr) {
    $resp_arr = exec_procedure($body_arr, 'p_check_code');
    extract($resp_arr);

    if ($status != 0)
        die_err_code($status, __LINE__);

    $resp_bind_arr = exec_procedure($body_arr, 'p_bind');
    if ($body_arr['type'] == 1) {//避免登录浏览器与邮箱打开超链接的浏览器不同
        setSessonUserData('userid', $body_arr['userid']);
    }
    return $resp_bind_arr;
}
?>


