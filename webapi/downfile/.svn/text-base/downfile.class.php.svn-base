<?php
header("Content-type:text/html;charset=utf-8");
$fileurl = $_GET['fileurl']; //  路径
$filename = $_GET['filename']; //真名字
//用以解决中文不能显示出来的问题 
$file_sub_path = $_SERVER['DOCUMENT_ROOT'];
$file_path = /* $file_sub_path. */$fileurl;
//首先要判断给定的文件存在与否
if (!file_exists($file_path)) {
    echo "没有该文件";
    return;
}
$fp = fopen($file_path, "r");
$file_size = filesize($file_path);
//下载文件需要用到的头
Header("Content-type: application/octet-stream");
Header("Accept-Ranges: bytes");
Header("Accept-Length:" . $file_size);
$file_name_arr = explode('\\', $fileurl);
$count = count($file_name_arr);
$real_file_name = $file_name_arr[$count - 1];
$real_file_name = $filename;
//print_r($real_file_name);exit;
$real_file_name = mb_convert_encoding($real_file_name, 'gb2312', 'utf-8');
Header("Content-Disposition: attachment; filename=" . $real_file_name);
$buffer = 1024;
$file_count = 0;
//向浏览器返回数据
while (!feof($fp) && $file_count < $file_size) {
    $file_con = fread($fp, $buffer);
    $file_count+=$buffer;
    echo $file_con;
}
fclose($fp);
?>