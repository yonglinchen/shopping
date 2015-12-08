<?php //提交短信

function sendmsg_zx($connect,$content){
//    print_r("$connect:".$connect.',code:'.$code.',timeout'.$timeout);exit;
    $data['status']=0;
    $post_data = array();
    $post_data['userid'] = 306;
    $post_data['account'] = 'sanbashuazihy6';
    $post_data['password'] = 'mkidoamk';
    $post_data['content'] = $content;//('尊敬的用户，您的验证码为'.$code.'，'.$timeout.'分钟内有效，请在页面输入验证码并完成手机注册。'); //短信内容需要用urlencode编码下
    $post_data['mobile'] = $connect;//'15811346821';
    $post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
    $url='http://hy6.nbark.com:7602/sms.aspx?action=send';
    $o='';
    foreach ($post_data as $k=>$v)
    {
       $o.="$k=".urlencode($v).'&';
    }
    $post_data=substr($o,0,-1);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
    $result = curl_exec($ch);
}
?>