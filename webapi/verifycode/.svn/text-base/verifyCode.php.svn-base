<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(dirname(__FILE__) . "/Verify.class.php");

function verify_code($body_arr) {
    $fontSize = isset($body_arr['fontSize']) && $body_arr['fontSize'] != 'undefined' ? $body_arr['fontSize'] : 36;
    $length = isset($body_arr['length']) && $body_arr['length'] != 'undefined' ? $body_arr['length'] : 4;
    $useNoise = isset($body_arr['useNoise']) && $body_arr['useNoise'] != 'undefined' ? $body_arr['useNoise'] : 1;
    $useCurve = isset($body_arr['useCurve']) && $body_arr['useCurve'] != 'undefined' ? $body_arr['useCurve'] : 0;

    if (!isset($_SESSION)) {
        session_start();
    }
    $config = array(
        'fontSize' => $fontSize, // 验证码字体大小
        'length' => $length, // 验证码位数
        'useNoise' => $useNoise, // 关闭验证码杂点
        'useCurve' => $useCurve,
    );
    $code = $body_arr['code']; //isset($_POST['inputcode'])?$_POST['inputcode']:'';
    //print_r($code);
    //echo $_SESSION["verify_code"];exit;

    $Verify = new Verify($config);

    if ($Verify->authcode(strtoupper($code)) == $_SESSION['verify_code']) {
        $data['status'] = 0;
    } else {
        $data['status'] = 1003;
    }
    //print_r($data);exit;
    return $data;
}
