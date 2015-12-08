<?php

//require_once("../../API/qqConnectAPI.php");
require_once(dirname(dirname(dirname(__FILE__)))."/API/qqConnectAPI.php");
function QQ_login(){
	$qc = new QC();
	$qc->qq_login();
}
$state = $_GET['state']; //1登录  2绑定
setSessonUserData('login_type', $state);
QQ_login();
