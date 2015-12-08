<?php

require_once("def.php");
require_once("fun.php");
require_once("errcode.php");
require_once("ilog.php");


/**
 * 获取请求行URL
 * @return type
 */
function  getRequestURL()
{
    return $_SERVER["REQUEST_URI"];
}
/**
 * 获取HTTP body
 * @return type
 */
function  getRequestBody()
{
    $data = file_get_contents("php://input");
    if($data == NULL){//文件上传时的参数获取
        $data = isset($_POST['service'])?$_POST['service']:NULL;
    }
    if($data==NULL){
        $internum = isset($_GET['inter_num'])?$_GET['inter_num']:NULL;
        $data['inter_num'] = $internum;
        switch($internum){
            case '0039':
                $data['url'] = $_GET['url'];
                break;
            case "0043":
            case "0044":
                $data['order_no'] = $_GET['order_no'];
                $data['channel'] = $_GET['channel'];
                $data['paybank'] = $_GET['paybank'];
                break;
            default :
                break;                
        }
        $data = json_encode($data);
    }
    ilog(3, "REQ:".$data, __LINE__);
    return $data;
}

/**
 * 根据JSON 格式数据 拼装 mySql 存储过程语句
 * @param type $sql         输出参数
 * @param type $json_arr    JSON 数据
 * @param type $param      
 */
function addString(&$sql,$json_arr,$param)
{        
   if(array_key_exists($param, $json_arr))
    {
        $sql =    $sql.'"'. $json_arr[$param].'",';
    }
    else {
        $sql =    $sql.'"",';
    }       
}
/*
将JSON数据的每一个KEY 对应的VALUE值转换成存储过程
输入参数
*/
function addStrings(&$sql,$json_arr,$param)
{
    foreach ($param as $value)
    {
        if(array_key_exists($value, $json_arr))
        {
                $sql =    $sql.'"'. $json_arr[$value].'",';
        }
        else {
                $sql =    $sql.'"",';
        } 
    }
}

function addsubString(&$sql,$param)
{
    $sql = $sql . $param;
}

function addInt(&$sql,$json_arr,$param)
{
    if(array_key_exists($param, $json_arr))
    {
        $sql =    $sql. $json_arr[$param].',';
    }
    else {
        $sql =    $sql.'-1,';
    }
}   

/*
将存储过程返回的结果集和出参的字符串(KEY=VALUE)转换成
JSON格式数据，如{"status":"0","desc":"\u6210\u529f","out_data":{"id":"33333","appid":"tttt"},"data":[]}
$record: 为返回结果集
$result：为输出参字符串
*/
function clt_json_encode($record, $result)
{
    $resp_arr = array(
            'status'=>$result["@vo_result"],
            'desc'=>err_info($result["@vo_result"]),
            'out_data'=>str2array($result["@vo_data"],',','='),
            'data'=>$record
            );

    return $resp_arr;
}

/*
将 "key=111,key2=222" 的字符串 转换成数组
该函数用于执行存储过程输出参数数据转换成数组
*/
function str2array($str, $delimiter1, $delimiter2)
{
    if(!$str) return '';
    $arr = array();
    $tmp0 = explode($delimiter1, $str);
    foreach ($tmp0 as $key => $value){
        $tmp1 = explode($delimiter2, $value);
        $arr[$tmp1[0]] = $tmp1[1];
    }
    return $arr;
}

/*
将数组转换成 KEY~VALUE,KEY~VALUE 格式的字符串
该字符串作为执行存储过程的输入参数
*/
function array2str(&$body, $body_arr)
{
    $body="'";
    foreach($body_arr as $key1 =>$value1)
    {
      $body .= $key1."~".$value1 .",";          
    }
    $body = substr($body, 0,-1);
    $body.="'";
}

/*
执行存储过程
* vi_body:传入的body数组
* procedure:存储过程名
* type:类别，如果非1，代表不单独建立数据库连接 
 * $dbconn:如果type=2，则要传数据库句柄
返回:数组array(status,desc,data)
*/
function exec_procedure($body_arr, $procedure,$type=1,$dbconn=0){
    unset($body_arr["inter_num"]);
    //构建存储过程参数
    addsubString($sql, "CALL ".$procedure."(");
    array2str($body, $body_arr);
    addsubString($sql , $body);
    addsubString($sql , ",@vo_data, @vo_result)");
    ilog(iLOG_INFO, "    -----> ".$sql, __LINE__);
    // 执行存储过程
    $Records = array();
    $result = array();  
    if($type!=1 && $dbconn){
        db_query_no_conn($dbconn,$sql, $Records, array("@vo_data", "@vo_result"), $result);
    }else{
        db_query($sql, $Records, array("@vo_data", "@vo_result"), $result);
    }
    ilog(iLOG_INFO, " status--->".$result["@vo_result"], __LINE__);

    #数组转换{"status":"0","desc":"\u6210\u529f"
    //,"out_data":{"id":"33333","appid":"tttt"},"data":[]} 格式的JSON 包
    $resp_arr = clt_json_encode($Records, $result);
    return $resp_arr;
}
?>