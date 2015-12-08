<?php
require_once("def.php");

function imysql_connect_db(){
    $con = mysql_pconnect(_HOST_, _USER_, _PSW_, 1, _MULTI_RESULTS_);
    if (!$con) {
        die_err("err_mysql_con", __LINE__, mysql_error(),ifile_name(__FILE__));  // 错误码：接连数据库失败
        return NULL;
    }
    $selected = mysql_select_db(_DB_,$con);
    if (!$selected) {
        die_err("err_mysql_sel", __LINE__, mysql_error(),ifile_name(__FILE__));  // 错误码：选择数据库失败
        return NULL;
    }
    return $con;
}

function imysql_close($_con){
    if($_con) mysql_close($_con);
}

/**
 * 执行sql语句，调用存储过程，返回多个出参值数组
 * @param type $_sql        调用存储过程的sql语句
 * @param type $_out_arr    调用存储过程的出参数组
 * @param type $num         调用存储过程的出参数量，缺省值1
 * @return array            返回调用存储过程的出参值数组
 * 示范： $sql = "call database.function('"ids"',@out1,@out2)";
        out_arr = array("@out1","@out2"); 
        num = 2;
        imysql_query_out($sql,out_arr,num);
        $out1 = arry[0], $out2 = arry[1];
 */
function imysql_query_out($_sql, $_out_arr, $num=1)
{
    $con = imysql_connect_db();
    mysql_query("set names 'utf8'");//输出中文
    if ($con){
        $count = 0;
        $res_query = mysql_query($_sql);
        if($res_query == NULL)
            die_err("err_query_fail", __LINE__, mysql_error(),ifile_name(__FILE__));  // 错误码：执行sql语句失败
        $arry = array();
        while($count < $num){
            $out_result = mysql_query('select '.$_out_arr[$count].';');
            if(!$out_result)
                    die_err("err_null_out", __LINE__, mysql_error(),ifile_name(__FILE__)); // 错误码：获取出参失败
            $out_arry = mysql_fetch_array($out_result);
            $result = $out_arry[$_out_arr[$count++]];
            array_push($arry, $result);
        }
        imysql_close($con);
        return $arry;
    }
    die_err("err_mysql_con", __LINE__, mysql_error(),ifile_name(__FILE__)); // 错误码：接连数据库失败	
}

// 此接口不建议使用，改用imysqli_query_out_result
function imysql_query_result($_sql){
    $con = imysql_connect_db();
    mysql_query("set names 'utf8'");//输出中文
    if($con){
        $result = mysql_query($_sql);
        imysql_close($con);
        if($result == NULL)
            die_err("err_null_result", __LINE__, mysql_error(),ifile_name(__FILE__));  // 错误码：获取结果集失败
        return $result;
    }
    die_err("err_mysql_con", __LINE__, mysql_error(),ifile_name(__FILE__));  // 错误码：接连数据库失败
    return NULL;
}
// 此接口不建议使用，改用imysqli_query_out_result
function imysql_insert_result($_sql)
{
    $con = imysql_connect_db();
    mysql_query("set names 'utf8'", $con);//输出中文
    if($con){
        $result = mysql_query($_sql, $con);
        if ($result == 0) {
            return mysql_insert_id($con);
        }
        imysql_close($con);
        if($result == NULL)
                die_err("err_null_result", __LINE__, mysql_error(),ifile_name(__FILE__));  // 错误码：获取结果集失败
        return $result;
    }
    die_err("err_mysql_con", __LINE__, mysql_error(),ifile_name(__FILE__));  // 错误码：接连数据库失败
    return NULL;
}

/**********************************************************************
函数名：imysqli_query_out_result

函数说明：执行sql语句，调用存储过程，返回结果集和多个出参值数组

入参：$_sql - 调用存储过程的sql语句
     $_out_arr - 调用存储过程的出参数组
	 $num - 调用存储过程的出参数量，缺省值1
出参：$_arr_out - 出参值数组
     $_arr_result - 结果集数值数组

示范： $sql = "call database.function('"ids"',@out1,@out2)";
      out_arr = array("@out1","@out2");
	  arr_out = array();
	  arr_result = array();
	  num = 2;
	  imysqli_query_out_result($sql,out_arr,num,arr_out,arr_result);
	  $out1 = arry[0], $out2 = arry[1];
	  foreach($arr_result as $row)
	  {
	      //... do something ...
	  }
***********************************************************************/
function imysqli_query_out_result($sql, $_out_arr, &$_arr_out, &$_arr_result, $num=1)
{
    $mysqli = new mysqli(_HOST_, _USER_, _PSW_, _DB_);
    if (mysqli_connect_errno()){
        die_err("err_mysql_con", __LINE__, mb_convert_encoding(mysqli_connect_error(),'utf-8','gb2312'),ifile_name(__FILE__));  // 错误码：接连数据库失败
    }
    $mysqli->query("set names 'utf8'");//输出中文
    $mysqli->autocommit(FALSE);
    $arry = array();
    $result_arr = array();
    if ($mysqli->multi_query($sql)){
        if ($result = $mysqli->store_result()){
            while ($row = $result->fetch_row()){
                array_push($_arr_result, $row);
            }
            $result->close();			
        }
        while($mysqli->next_result()){         	 
                $result = $mysqli->store_result();
        }
    }
    else{
        die_err("err_query_fail", __LINE__, mysqli_error($mysqli),ifile_name(__FILE__));
    }
    $mysqli->commit();
    $count = 0;
    while($count<$num){
        if ($result2 = $mysqli->query("select ".$_out_arr[$count].";")){
            while ($row = $result2->fetch_row()){
                    $out = $row[0];
            }
            array_push($_arr_out, $out);
            $count++;	
            $result2->close();
        }
        else{
            die_err("err_null_out", __LINE__, mysqli_error($mysqli),ifile_name(__FILE__)); // 错误码：获取出参失败
        }
    }
    $mysqli->close();
}

/*
 * 建立一个连接句柄
 */
function create_conn(){
    $mysqli = new mysqli(_HOST_, _USER_, _PSW_, _DB_);
    if (mysqli_connect_errno()) {
        die_err("err_mysql_con", __LINE__, mb_convert_encoding(mysqli_connect_error(),'utf-8','gb2312'),ifile_name(__FILE__));  // 错误码：接连数据库失败
    }
    return $mysqli;
}
/*
 * 执行存储，不包括数据库的连接，释放
 */

function db_query_no_conn($mysqli,$sql, &$select_result, $out_arg = NULL, &$out_value = NULL)
{
    $mysqli->query("set names 'utf8'");//输出中文
    $mysqli->autocommit(FALSE);
    $arry = array();
    $result_arr = array();
    if ($mysqli->multi_query($sql)) {
        if ($result = $mysqli->store_result()) {
            while (!is_null($select_result) && $row = $result->fetch_assoc()) {
                array_push($select_result, $row);
            }
            $result->close();			
        }
        while($mysqli->more_results() && $mysqli->next_result()) {         	 
            $result = $mysqli->store_result();
        }
    } else {
        die_err("err_null_out", __LINE__,mysqli_error($mysqli),ifile_name(__FILE__)); 
    }
    $mysqli->commit();
    $num = count($out_arg);
    $i = 0;
    while ($i < $num) {
        $result2 = $mysqli->query("select ".$out_arg[$i]." ;");
        if ($result2){
            while ($row = $result2->fetch_assoc()) {
                $out_value = array_merge($out_value, $row);
            }
            $i++;	
            $result2->close();
        } else {
            die_err("err_null_out", __LINE__, mysqli_error($mysqli),ifile_name(__FILE__)); 
        }
    }
}

/*
 * 关闭mysql连接
 */
function close_conn($mysqli){
    $mysqli->close();
}

/* $sql 查询的sql语句，$select_result语句数据的结果集
 * $out_arg 为存储过程的输出参数名
 */

function db_query($sql, &$select_result, $out_arg = NULL, &$out_value = NULL)
{
    $mysqli = new mysqli(_HOST_, _USER_, _PSW_, _DB_);
    if (mysqli_connect_errno()) {
        die_err("err_mysql_con", __LINE__, mb_convert_encoding(mysqli_connect_error(),'utf-8','gb2312'),ifile_name(__FILE__));  // 错误码：接连数据库失败
    }
    $mysqli->query("set names 'utf8'");//输出中文
    $mysqli->autocommit(FALSE);
    $arry = array();
    $result_arr = array();
    if ($mysqli->multi_query($sql)) {
        if ($result = $mysqli->store_result()) {
            while (!is_null($select_result) && $row = $result->fetch_assoc()) {
                array_push($select_result, $row);
            }
            $result->close();			
        }
        while($mysqli->more_results() && $mysqli->next_result()) {         	 
            $result = $mysqli->store_result();
        }
    } else {
        die_err("err_null_out", __LINE__,mysqli_error($mysqli),ifile_name(__FILE__)); 
    }
    $mysqli->commit();
    $num = count($out_arg);
    $i = 0;
    while ($i < $num) {
        $result2 = $mysqli->query("select ".$out_arg[$i]." ;");
        if ($result2){
            while ($row = $result2->fetch_assoc()) {
                $out_value = array_merge($out_value, $row);
            }
            $i++;	
            $result2->close();
        } else {
            die_err("err_null_out", __LINE__, mysqli_error($mysqli),ifile_name(__FILE__)); 
        }
    }
    $mysqli->close();
}
?>