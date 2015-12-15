<?php

require_once(dirname(__FILE__) ."/serviceInterface.php");
/*$inter_num:接口序号.$body_arr:参数数组.详细参数见接口文档
*/
function base_fun($body_arr){
    global $_INTERFACE;//声明配置文件
    global $_NOCHECKLOGIN;
    $inter_num = arr_key_value("inter_num", $body_arr);//获取接口号
    $resp_arr = array();
    if(!arr_key_value_login($inter_num,$_NOCHECKLOGIN)){//检测登录状态
        $body_arr['userid'] = getSessonUserData('userid');
        if(!$body_arr['userid']){ //方便测试，这里先注释
            $resp_arr['status'] = 1035;
            $resp_arr['desc'] = err_info( $resp_arr['status']);
            return $resp_arr;
        }
    }
    switch($inter_num){
    case "0001": //web
    case "0046": //app
        require_once(dirname(__FILE__) . "/pay/index.php");
        $resp_arr = generate_order($body_arr);
        break;
    case "0005":#绑定提交
        require_once(dirname(__FILE__) . "/bind/code/bind.php");
        $resp_arr = bind_general($body_arr);
        break;
    case "0006":#绑定校验
        require_once(dirname(__FILE__) . "/bind/code/bind.php");
        $resp_arr = bind_check($body_arr);
        break;
    case "0007":#密码找回提交
        require_once(dirname(__FILE__) . "/getpwd/code/getpwd.php");
        $resp_arr = get_pwd_general($body_arr);
        break;
    case "0008":#密码找回校验
        require_once(dirname(__FILE__) . "/getpwd/code/getpwd.php");
        $resp_arr = get_pwd_check($body_arr);
        break; 
    case "0027":#发送验证码
        require_once(dirname(__FILE__) . "/sms/code/sendsms.php");
        $resp_arr = sms_general($body_arr);
        break;
    case "0028"://图片验证码校验
        require_once(dirname(__FILE__) . "/verifycode/verifyCode.php");
        $resp_arr = verify_code($body_arr);
        break;
    case "0029"://发送邮件
        require_once(dirname(__FILE__) . "/mail/sendmail.php");
        $resp_arr = sendemail($body_arr);
        break;
    case "0030": // 文件上传          
        require_once(dirname(__FILE__) .  "/fileupload/code/fileuploadservice.php");
        $resp_arr = serviceHandle($body_arr); // 该方法需要根据业务需求进行修改
        break;
    case "0032": //html2pdf
        require_once(dirname(__FILE__) .  "/html2pdf/html2pdf.class.php");
        $html2pdf = new html2pdf;
        $dest =dirname(dirname(__FILE__)). $body_arr['dest'];  
        $d_filename = $body_arr['d_filename'];
        $sourcehtmlfile = $body_arr['sourcehtmlfile'];
        $resp_arr = $html2pdf->createpdf($dest,$d_filename,$sourcehtmlfile); //  
        break;
    case "0036": // 获取服务器时间         
        require_once(dirname(__FILE__) .  "/systime/getsystime.php");
        $resp_arr = getsystime(); // 该方法需要根据业务需求进行修改
        break;
    case "0037";//发送注册激活邮件activeuser    
        require_once(dirname(__FILE__) . "/activeuser/code/activeuser.php");
        $resp_arr = activeuser_general($body_arr);
        break;
    case "0038"://验证 注册激活邮件activeuser    
        require_once(dirname(__FILE__) . "/activeuser/code/activeuser.php");
        $resp_arr = activeuser_check($body_arr);
        break;
    case "0039"://登出   
        require_once(dirname(__FILE__) . "/libcode/session.php");
        $resp_arr = clearsessionjump($body_arr);
        break;
    case "0040"://生成图片，保存在服务器
        require_once(dirname(__FILE__) . "/createpic/createpic.php");
        $resp_arr = createpicserver($body_arr);
        break;
    case "0043"://跳转到支付渠道，网页版支付
        require_once(dirname(__FILE__) . "/pay/index.php");
        $resp_arr = jump_paychannel($body_arr);
        break;
    case "0044"://返回支付信息，移动端app支付
        require_once(dirname(__FILE__) . "/pay/index.php");
        $resp_arr = echo_paychannel($body_arr);
        break;
    case "0045"://查询订单，移动端app
        require_once(dirname(__FILE__) . "/pay/index.php");
        $resp_arr = queryorderstatus($body_arr);
        break;
    case "0050"://购物车模块
        require_once(dirname(__FILE__) . "/shopping/index.php");
        $resp_arr = dealCartFlow($body_arr);
        break;
    case "0051"://会员、积分模块
        
        break;
    default:
        $procedure = arr_key_value($inter_num, $_INTERFACE);//根据接口号获取存储名
        //执行存储过程
        $resp_arr = exec_procedure($body_arr, $procedure);
        break;
    }
    if($inter_num == "0026" && $resp_arr['status']==0){//登录成功，记录userid到session中
        $ret = setSessonUserData('userid',$resp_arr['out_data']['userid']);
        if($body_arr['rememberpwd']){ //记住密码
            rememberpwd($body_arr['account'],$body_arr['passwd'],$body_arr['second']);
        }
    }
    return $resp_arr;
}
?>