<?php
require_once(dirname(__FILE__) ."/Upload.class.php");

/**
 * 文件不是以base64方式上传
 * @param type $path
 * @param type $filename
 * @param type $file
 * @return type
 */
function fileupload($path, $filename, $file) {
    header("Expires: Mon, 26 Jul 1990 05:00:00"); //表示永远过期
    header("Last-Modified: " . date("D, d M Y H:i:s"));
    header("Cache-Control: no-store, no-cache, must-revalidate"); //不使用缓存
    header("Cache-Control: post-check=0, pre-check=0", false); //不使用缓存
    header("Pragma: no-cache"); //不使用缓存

    $upload = new Upload(); // 实例化上传类
    $upload->rootPath = $path; // 设置附件上传根目录
    $upload->savePath = ""; // 设置附件上传（子）目录
    $var_extend = explode(".", $filename);
    if(count($var_extend) == 1){
        $upload->saveName = $filename;
    } else {
        $varExt = "." . $var_extend[count($var_extend) - 1];
        $varlength = 0 - strlen($varExt);

        $upload->saveName = substr($filename, 0, $varlength);
    }
   
    $upload->autoSub = false;
    
    // 上传文件 
    $fileCallback = array("flag"=>true,"error"=>"","filename"=>$filename);
    $flag = $upload->uploadOne($file);
    if(!$flag){
       $fileCallback["flag"] = false;
       $fileCallback["error"] = $upload->getError();
    }
    
    return $fileCallback;
}

/**
 * 文件以base64方式上传
 * @param type $path
 * @param type $filename
 * @param type $resp_arr
 * @param type $webrooturl
 * @param type $filebase64
 */
function base64upload($path, $filename, $filebase64) {
    header("Expires: Mon, 26 Jul 1990 05:00:00"); //表示永远过期
    header("Last-Modified: " . date("D, d M Y H:i:s"));
    header("Cache-Control: no-store, no-cache, must-revalidate"); //不使用缓存
    header("Cache-Control: post-check=0, pre-check=0", false); //不使用缓存
    header("Pragma: no-cache"); //不使用缓存

    $fileCallback = array("flag"=>true,"error"=>"","filename"=>$filename);
    if (!empty($filebase64)) {
        $IMG = base64_decode($filebase64);
        if (!file_exists($path)) {
            mkdir($path);
        }

        system("chmod -R 777 " . $path);

        if(!file_put_contents($path . $filename, $IMG)){
            $fileCallback["flag"] = false;
            $fileCallback["error"] = "图片上传失败";
        }   
    }   else {
        $fileCallback["flag"] = false;
        $fileCallback["error"] = "图片上传失败";
    }
    return $fileCallback;
}
