<?php
require_once('wx_config.php');
// $state = 'f3602be4bbb74f808372322233da98fc';//该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验


//function WX_login(){
	$url = "https://open.weixin.qq.com/connect/qrconnect?"
	."appid=".APPID."&redirect_uri=".urlencode(REDIRECT_URI).
	"&response_type=code&scope=snsapi_login";
	
	//return $url;
	header('Location: '.$url);
//}
?>
