<?php
    require_once("../libcode/comFun.php");
    //根据HTTP BODY JSON包格式进行解析
    $body =comFun::getRequestBody(); 
    $body_arr = json_decode($body,true);    
    comFun::array2str($body,$body_arr);
    //构建存储过程参数
    comFun::addsubString($sql , "CALL p_clt_info_ext(");
    comFun::addsubString($sql , $body);
    comFun::addsubString($sql , ",@vo_data,@vo_result)");
    ilog(iLOG_INFO, "    -----> ".$sql, __LINE__);
    // 执行存储过程
    $setRecords = array();
    $result = array();  
    db_query($sql, $setRecords, array("@vo_data","@vo_result"), $result);
  
    //查询结果集合打包成 JSON 比如 {"status":"0","data":[]}
    comFun::clt_json_encode($setRecords,$setRecords,$result["@vo_result"]);
	iecho($setRecords, __LINE__)
?>
