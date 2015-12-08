<?php
require_once('wx_config.php');

//function WX_callback($code){
	$code = $_REQUEST['code'];
	echo $code."111111111";exit;
	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".SECRET
	."&code=".$code."&grant_type=authorization_code";
	//"https://open.weixin.qq.com/connect/user.lvgou.com?
	//code=01195db03de268a79508645e8682a9fB&state=";
	//return $url;
	//header('Location: '.$url);
//}
?>
