<?php
//测试的业务操作
require_once("upload.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/serviceInterface.php");
/*
 * 业务上传文件
 */
function serviceHandle($body_arr){ 
    $servicecode  = $body_arr['servicecode']; 
    $path = ICMethod::getFilePath($servicecode);  
    $filerule = ICMethod::getFilename($servicecode);
    
    $PHP_SELF = $_SERVER['SCRIPT_NAME'];
    $webrooturl = 'http://' . $_SERVER['HTTP_HOST'] . substr($PHP_SELF, 0, strrpos($PHP_SELF, '/') + 1);
    $fileCallback =  array("flag"=>true,"error"=>"","filename"=>"");    //上传文件回调信息

    if (isset($body_arr["filebase64"]) && $body_arr["filebase64"] != "null") {//文件以base64方式上传
        $info = base64upload($path, $filerule . ".png", $body_arr["filebase64"]);
        if(!empty($info["error"])){
            $fileCallback["flag"] = false;
            $fileCallback["error"] = $info["error"];
        } else {
            $fileCallback["filename"] .= "," . $webrooturl . $path . $info["filename"];
        }
    } else {
        $files = dealFiles($_FILES);//处理文件，把上传的文件（单、多文件）内容解析为可处理的数组
        if(count($files) > 0){
            foreach($files as $key => $file){//单文件或多文件上传
                if($file["error"]>0){//错误发生
                    /*
                     * 1 : 上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值.
                     * 2 : 上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。
                     * 3 : 文件只有部分被上传
                     * 4 : 没有文件被上传
                     */
                    switch ($file["error"])
                    {
                    case 1:
                       $fileCallback["error"] = "上传的文件超过了php.ini 中 upload_max_filesize 选项限制的值";
                        break;  
                    case 2:
                        $fileCallback["error"] = "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
                        break;
                    case 3:
                        $fileCallback["error"] = "文件只有部分被上传";
                        break;
                    case 4:
                        $fileCallback["error"] = "没有文件被上传";
                        break;
                    default:
                        $fileCallback["error"] = "未知错误.error code = " . $file["error"];
                    }

                    $fileCallback["flag"] = false; 
                    break;
                }

                if(empty($file["name"])){
                    $fileCallback["error"] = "上传文件名为空";
                    $fileCallback["flag"] = false; 
                    break;
                }

                $extend = get_extend_new($file['name']);
                $filename =  (count($files) == 1 ? $filerule : ($filerule . $key)) . ($extend == "" ? "" : "." .  $extend);
                $info = fileUpload($path, $filename, $file);//文件上传

                if(!empty($info["error"])){
                    $fileCallback["flag"] = false;
                    $fileCallback["error"] = $info["error"];
                    break;
                } else {
                    $fileCallback["filename"] .= "," . $webrooturl . $path . $info["filename"];
                }
            }
        }else {
            $fileCallback["error"] = "无上传文件，检查Appache配置";
            $fileCallback["flag"] = false; 
        }
    }
    $fileCallback['body'] = $body_arr;  
    $fileCallback['realfileurl'] = dirname(dirname(dirname(__FILE__))).'/'.$path.$info["filename"];
    return ICMethod::jsonCallbackHandle($fileCallback);
}
