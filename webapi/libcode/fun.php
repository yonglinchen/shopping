<?php
require_once('ihttp.php');
require_once("HttpClient.class.php");

$_NODE_SERVER_URL = "http://123.57.174.232:7144/do";

if(!defined('_NODE_SERVER_URL'))
    define('_NODE_SERVER_URL', $_NODE_SERVER_URL);

//支持中文的json编码.
function Array2Json_chn($array)
{
    arrayRecursive($array, 'urlencode', true);
    $jsonw = stripslashes(json_encode($array));
    $jsonw = urldecode($jsonw);
	
    return  $jsonw;
}

function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    static $recursive_counter = 0;
    if (++$recursive_counter > 1000) {
        //die('possible deep recursion attack');
        die_err("err_json");
    }
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter--;
}

function StrSplit($str)
{
	if($str == NULL)
		return NULL;
		
	$result = array();
	
	$arr = explode('&', $str);
	if(!$arr)
		return NULL;
		
	foreach($arr as $key)
	{
		$value = explode('=', $key);
		if($value != NULL)
		{
		    $result[$value[0]] = $value[1];
		}
	}
		
	return $result;
}

//json,base64,qes
function json_qes_base64($array)
{
	$json_data = json_encode($array);
	
	if(_QES == 0)//非加密
		return $json_data;

	ilog(iLOG_INFO, "    -----> send to(before encrypt): ".$json_data);
	
	global $g_key;
	ilog(iLOG_INFO, "    -----> encode g_key: ".$g_key);
	
	$qes_data = encrypt($json_data,$g_key);
	if(!$qes_data)
		die_err("err_encrypt", __LINE__);
		
	$base64_data = base64_encode($qes_data);

	return $base64_data;
}

function qes_base64_Decode($data)
{
	if(_QES == 0)//不做加密
		return $data; 
		
	global $g_key;
	ilog(iLOG_INFO, "    -----> decode g_key ".$g_key);
	
	$base64_decode_data = base64_decode($data);
	if(!$base64_decode_data)
		die_err("err_decrypt", __LINE__);

	$base64_qes_decode_data = decrypt($base64_decode_data,$g_key);
	if(!$base64_qes_decode_data)
		die_err("err_decrypt", __LINE__);
		
	return trim($base64_qes_decode_data);
} 

function arr_key_value($key, $array, $line="-", $default_val=0, $die=1)
{
    if ($array && array_key_exists($key, $array)){
        return $array[$key];
    }
    else{
        if($die == 1){
            ilog(iLOG_WARNING, "    -----> arr_key_value() die:".$key, $line);
            die_err("err_invalid_param", $line);  // 错误码：非法参数
        }
        return $default_val;
    }
}

function arr_key_value_login($key, $array)
{
    if ($array && array_key_exists($key, $array)){
        return $array[$key];
    }
    else{
       return 0;
    }
}

function ifile_name($file)
{
	$pos = strrpos($file,"/");
	if($pos)
		return substr($file, $pos+1);
	else
		return $file;
}

function iecho($arry, $line="-", $encryp=false)
{
	global $log;
	if($encryp)
		echo json_qes_base64($arry);
	else
		echo json_encode($arry);
		
	if($log)
	{
		$log->tag_line($line);
		$log->log(iLOG_INFO, "---------> send to(OK): ".Array2Json_chn($arry));
	}
	die;
}

function ilog($rank, $_log, $line="-")
{
	global $log;
	
	if(!$log)	
	{
		$log = new iLog(0, 'qst', iLOG_INFO);
		if($log) $log->start();
		set_ilog(ifile_name(__FILE__));
	}
	if($log)	
	{
		$log->tag_line($line);
		$log->log($rank, $_log);
	}
}

function set_ilog($file)
{
	global $log;
	if($log)	$log->tag_file($file);
}
//校验客户端的请求携带的端口是否与服务器的端口匹配
function mergefile($temp_file, $targetFile, $start_byte, $end_byte)
{
        if(file_exists($temp_file))//非第一个包
	ilog(iLOG_INFO, "  mergefile  -----> curr_filesize:".filesize($temp_file), __LINE__);
        if(file_exists($targetFile))//非第一个包
	ilog(iLOG_INFO, "  mergefile  -----> target_filesize:".filesize($targetFile), __LINE__);
	
	//存在,读写方式打开,不存在,创建
	if($start_byte == 0 || !file_exists($targetFile))
		$handle = fopen($targetFile, 'wb');
	else
		$handle = fopen($targetFile, 'rb+');
		
	//起始字节不该比之前上传的文件size大
	if($start_byte > filesize($targetFile))
		return false;
		
	if(fseek($handle, $start_byte) < 0)
		return false;
		
	$tem_handle = fopen($temp_file, 'rb');
	$content = fread($tem_handle, filesize($temp_file));
	fclose($tem_handle);
	
	fwrite($handle, $content);
	fclose($handle);
	
	unlink($temp_file);//删除临时文件
	
	return true;
}
//获取文件后缀名
function get_extend($file_name)  
{
	$extend = explode(".", $file_name);
	$va = count($extend) - 1;
	return $extend[$va];
}

function get_extend_new($file_name){
    $extend = explode(".", $file_name);
    if(count($extend) == 1){
        return "";
    }else {
        $va = count($extend) - 1;
    }
    return $extend[$va];
}


//联系人数组转成逗号分隔
function arr_2_str($arr, $fuhao)
{
	$str = NULL;
	foreach($arr as $tmp)
	{
		$str .= $tmp.$fuhao;
	}
	if($str)
	{
		$str = substr($str, 0, -1);
	}
	else
		die_err("err_json", __LINE__); // 错误码：status为空
		
	return $str;
}

function get_photo_path($fatherfolder, $file) {
        $pic_type = intercept_path($file, 2, 1); //substr($file, 0,5);
        $pic_time = intercept_path($file, 2, 2); //substr($file, 5,10);

        $pic_year = date("Y", $pic_time);
        $pic_month = date("m", $pic_time);
        $pic_day = date("d", $pic_time);
        $pic_hour = date("H", $pic_time);

        $path = $pic_type . '/' . $pic_year . '/' . $pic_month . '/' . $pic_day . '/' . $pic_hour;
        $source = $fatherfolder . '/' . $path . '/' . $file;

        return __ROOT__ . '/' . $source;
    }
function intercept_path($filename, $type, $param) {
    if ($type == 1) {//相册、头像（：分类(5)+时间戳(10) +用户ID(9)+5位随机数）
        switch ($param) {
            case 1:
                return(substr($filename, 0, 5));
                break;
            case 2:
                return(substr($filename, 5, 10));
                break;
            case 3:
                return(substr($filename, 15, 9));
                break;
            case 4:
                return(substr($filename, 24));
                break;
            default:
                return -1;
                break;
        }
    } else if ($type == 2) { //商品、广告栏（：分类(5)+时间戳(10) +5位随机数）
        switch ($param) {
            case 1:
                return(substr($filename, 0, 5));
                break;
            case 2:
                return(substr($filename, 5, 10));
                break;
            case 3:
                return(substr($filename, 15));
                break;
            default:
                return -2;
                break;
        }
    }
}
function mysql_db_safe($string){
        
        $escapeString = mysql_real_escape_string($string);
        if ($escapeString == "") {
            return mysql_escape_string($string);
        } else {
            return $escapeString;
        }
         
        return $string;
    }
function strlenEx($str) {
    return ((\strlen($str) + \mb_strlen($str, 'UTF8'))/2);
}

 /**
    * 到Node.JS消息通知接口
    * 
    * @param type $url
    * @param type $msgType
    * @param type $targetId
    * @param type $body
    * @return type
    */
function to_NodeJS_notice($data){
    $return_arr = HttpClient::quickPost(_NODE_SERVER_URL, $data);

    return $return_arr[1];
}

//发送邮件
function sendmail($to, $message){
	$subject = "";
	$from = "86185234@qq.com";
	
	$headers = 'From: '.$from."\r\n".
			   "MIME-Version: 1.0\r\n" .
			   "Content-Type: text/html; charset=UTF-8; format=flowed\r\n".
			   "Content-Transfer-Encoding: 8Bit\r\n" .
			   'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
}

/**
 * 处理文件，把上传的文件（单、多文件）内容解析为可处理的数组
 * @param type $files
 * @return type
 */
function dealFiles($files) {
    $fileArray  = array();
    $n          = 0;
    foreach ($files as $key=>$file){
        if(is_array($file['name'])) {
            $keys       =   array_keys($file);
            $count      =   count($file['name']);
            for ($i=0; $i<$count; $i++) {
                $fileArray[$n]['key'] = $key;
                foreach ($keys as $_key){
                    $fileArray[$n][$_key] = $file[$_key][$i];
                }
                $n++;
            }
        }else{
           $fileArray[0] = $file;
           break;
        }
    }
   return $fileArray;
}
?>