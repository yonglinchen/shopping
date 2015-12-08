<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getsystime(){
    date_default_timezone_set('PRC');
    $time = time();
    $format = date("Y-m-d H:i:s",$time);
    $status=0;
    $ret['status'] = $status;
    $ret['desc'] = '成功';
    $ret['out_data']['time'] = $time;//秒数
    $ret['out_data']['format'] = $format; //格式化时间
//    print_r(json_encode($ret));exit;
    return $ret;
}

