<?php
/*
http入口文件.所有的客户端请求都到此文件处理
*/
require_once("./InterfaceImpt.php");

$body_arr = json_decode(getRequestBody(), true);//获取包体json数组
//将请求的json数组传入.
$resp_arr = base_fun($body_arr);
//打印输出结果.并写日志
header("Access-Control-Allow-Origin: *");
iecho($resp_arr, __LINE__);
?>