<?php
require_once("def.php");
require_once("imysql.php");
require_once("ilog.php");
require_once("fun.php");

function httpclient($url){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_HEADER, 0);
   $output = curl_exec($ch);
   curl_close($ch);
   $arr_out = json_decode($output);
   return $arr_out;
}

function http_send($_url, $_body)
{
    $errno = 0;
    $errstr = '';
    $timeout = 10;

    $fp = fsockopen(_IP_,_PORT_,$errno,$errstr,$timeout);
    if(!$fp)
            return FALSE;

    $_head = "POST /".$_url." HTTP/1.1\r\n";
    $_head .= "Host: "._IP_.":"._PORT_."\r\n";
    $_head .= "Content-Type: Text/plain\r\n";

    if(!$_body)
            $body_len = 0;
    else
            $body_len = strlen($_body);

    $send_pkg = $_head."Content-Length:".$body_len."\r\n\r\n".$_body;
    ilog(iLOG_INFO, "    -----> http_send url: ".$_url);
    ilog(iLOG_INFO, "    -----> http_send body: ".$_body);

    if(fputs($fp,$send_pkg)===FALSE)
            return FALSE;

    //设置3s超时	
    stream_set_timeout($fp,3);
    while(!feof($fp))
    {
            ilog(iLOG_INFO, "    -----> rsp: ".fgets($fp, 128));
    } 

    if($fp)
            fclose($fp);
    return TRUE;
}
?>