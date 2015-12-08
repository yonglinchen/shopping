<?php
//header("Content-type:text/html;charset=utf-8");
session_start();

include_once( dirname(__FILE__).'/api/config.php' );
include_once( dirname(__FILE__).'/api/saetv2.ex.class.php' );

function WB_login(){
	$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY);
	$code_url = $o->getAuthorizeURL(WB_CALLBACK_URL);

	return $code_url;
}
$state = $_GET['state'];
setSessonUserData('login_type', $state);
WB_login();