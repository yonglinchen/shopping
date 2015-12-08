<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//配置文件
require_once(dirname(dirname(__FILE__))."/libcode/def.php");
require_once('class.phpmailer.php'); //载入PHPMailer类 

//img_path预览图片的绝对路径 .$attachment_path附件的绝对路径
function sendemail($body_arr){
	extract($body_arr);
	$mail = new PHPMailer(); //实例化 
	$mail->IsSMTP(); // 启用SMTP 
	$mail->Host = _MAILHOST_;//'smtp.exmail.qq.com';//hisun.hisunsray.com   'smtp.126.com';// //SMTP服务器 
	$mail->Port = 25;//465;  //邮件发送端口 
	$mail->SMTPAuth = true;  //启用SMTP认证 
			
	$mail->CharSet  = "UTF-8"; //字符集 
	$mail->Encoding = "base64"; //编码方式 

	$mail->Username =  _MAILUSERNAME_;//'service@3brush.com';//lixd@hisunsray.com// 你的邮箱
	$mail->Password = _MAILPASSWORD_;//'3Brush21';//'1234567890';你的密码 
	$mail->Subject = $subject; //邮件标题 

	$mail->From = _MAILUSERNAME_;//'service@3brush.com';//lixd@hisunsray.com;  //发件人地址（也就是你的邮箱） 
	$mail->FromName = $fromname;//'三把刷子';//constant("sendmailname");  //发件人姓名 
	$address = $to;//"xyz@163.com";//收件人email 
	$mail->AddAddress($address, "亲");//添加收件人（地址，昵称）
	 
/* test---
	$arr_attachment_path = array(0=>'D:/phpStudy/WWW/agent/Application/Home/Common/mail/a.jpg',
								 1=>'D:/phpStudy/WWW/agent/Application/Home/Common/mail/b.jpg');
*/	if($attach){
                foreach($attach as $attachment_path){
                        if($attachment_path != ''){
                                $mail->AddAttachment($attachment_path); // 添加附件,并指定名称
                        }
                }
        }

	$mail->IsHTML(true); //支持html格式内容 
/*	test---
	$arr_img_path = array(0=>'D:/phpStudy/WWW/agent/Application/Home/Common/mail/a.jpg',
							 1=>'D:/phpStudy/WWW/agent/Application/Home/Common/mail/b.jpg');
*/
        if($img){
            $i = 0;
            foreach($img as $img_path){
                    if($img_path != ''){
                            $img_id = 'img_'.$i++;
                            $mail->AddEmbeddedImage($img_path, $img_id);
                            $body .= '</br> <img alt="eee" src="cid:'.$img_id.'"/>';
                    }
            }
        }
	
	
	$mail->Body = $body;
	//发送邮件
	$ret = $mail->Send();
	if(!$ret) { 
		 $resp = array('status'=>1006,"desc"=>err_info(1006));
	} else { 
		$resp = array('status'=>0,"desc"=>err_info(0));
	} 
	return $resp;
}