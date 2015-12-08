<?php
include_once("./Verify.class.php");
$fontSize = isset($_GET['fontSize'])&&$_GET['fontSize']!='undefined'?$_GET['fontSize']:36;
$length = isset($_GET['length'])&&$_GET['length']!='undefined'?$_GET['length']:4;
$useNoise = isset($_GET['useNoise'])&&$_GET['useNoise']!='undefined'?$_GET['useNoise']:1;
$useCurve = isset($_GET['useCurve'])&&$_GET['useCurve']!='undefined'?$_GET['useCurve']:0;
$config =    array(
    'fontSize'    =>    $fontSize,    // 验证码字体大小
    'length'      =>    $length,     // 验证码位数
    'useNoise'    =>    $useNoise, // 关闭验证码杂点
    'useCurve'    =>    $useCurve,
);
if(!isset($_SESSION)){
    session_start();
}
$Verify = new Verify($config);
$id = $Verify->entry();
echo $id;
?>