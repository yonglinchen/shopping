<?php

require_once("publicInterface.php");

/* 当前项目的接口配置文件.仅供当前项目使用.
  接口编号=>存储过程名.从1000开始.1999结束.不能超出此范围
 */
$IPRIVATE = array(
    "1000" => "", //项目的接口第一个编号	
    "1999" => ""//项目的接口最大编号
);
$GLOBALS["_INTERFACE"] = $GLOBALS["IPUBLICE"] + $GLOBALS["IPRIVATE"];

class ICMethod {

    static public $time;
    static private $rootpath;
    static private $filedirectory;

    /*
     * 逐层创建文件夹
     * 按照年月日规则
     */

    public static function createfolder($path, $type) {
        $timenow = ICMethod::$time;

        $time_year = date("Y", $timenow);
        $time_month = date("m", $timenow);
        $time_day = date("d", $timenow);
        $timepath = $time_year . '/' . $time_month . '/' . $time_day . '/';
        if ($type) {
            $dest_dir = ICMethod::$rootpath . ICMethod::$filedirectory . $path . $timepath;
            ICMethod::createFolders($dest_dir);
        } else {
            $dest_dir = ICMethod::$filedirectory . $path . $timepath;
        }
        return $dest_dir;
    }

    /**
     * 递归创建文件夹
     * @param type $path
     */
    private static function createFolders($path) {
        // 递归创建
        if (!file_exists($path)) {
            ICMethod::createFolders(dirname($path)); // 取得最后一个文件夹的全路径返回开始的地方
            mkdir($path, 0777);
        }
    }

    public static function getFilePath($servicecode) {
        ICMethod::$time = time();
        ICMethod::$rootpath = dirname(dirname(__FILE__)).'/';
        ICMethod::$filedirectory = 'uploadfile/'; //在项目根目录下
        $path = "";
        switch ($servicecode) {
            case "9003":
                $path = 'fileupload/';
                $realpath = ICMethod::createfolder($path, 0); //第二个参数：是否拼根目录 ，0不拼接，1拼接
                break;
            case "9004":
                $path = 'createpic/';
                $realpath = ICMethod::createfolder($path, 1); //第二个参数：是否拼根目录 ，0不拼接，1拼接
                break;
            case "9005":
                $path = 'photopic/';
                $realpath = ICMethod::createfolder($path, 0); //第二个参数：是否拼根目录 ，0不拼接，1拼接
                break;
            default:
                $path = '';  //上传根目录 具体业务是需要修改
                $realpath = ICMethod::createfolder($path, 1); //第二个参数：是否拼根目录 ，0不拼接，1拼接
                break;
        }
        return $realpath;
    }

    public static function getFilename($servicecode) {
        $filename = "";
        switch ($servicecode) {
            case '9003':
            case '9004':
                $filename = ICMethod::$time . '_' . rand(10000, 99999);
                break;
            case '9005':
                $filename = ICMethod::$time . '_' . rand(10000, 99999);
                break;
            default:
                $filename = 'temp';  //上传根目录 具体业务是需要修改
                break;
        }
        return $filename;
    }

    /**
     * json 数据回调处理
     * @param type $fileCallback  array("flag"=>true,"error"=>"","filename"=>"");
     */
    public static function jsonCallbackHandle($fileCallback) {
        if (!$fileCallback["flag"]) {
            $resp_arr['status'] = "423";
            $resp_arr["desc"] = $fileCallback["error"];
        } else {
            //成功处理
            //$resp_arr = exec_procedure($fileCallback['body'], 'p_update_userinfo');
            $resp_arr["out_data"]["url"] = substr($fileCallback["filename"], 1);
            $resp_arr["out_data"]["realurl"] = $fileCallback["realfileurl"];
        }
        return $resp_arr;
    }

    /*
     * 打包文件
     * $datalist：文件数组
     * $filename：最终文件路径+文件名，如：D:/wamp/wwwuploadfile/createpic/2015/11/24/1448335997_66497.rar
     */
    private static function zlib($datalist, $filename) {
        if (!file_exists($filename)) {
            //重新生成文件   
            $zip = new \ZipArchive(); //使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释   
            if ($zip->open($filename, \ZIPARCHIVE::CREATE) !== TRUE) {
                exit('无法打开文件，或者文件创建失败');
            }
            foreach ($datalist as $val) {
                if (file_exists($val)) {
                    $zip->addFile($val, basename($val)); //第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下   
                }
            }
            $zip->close(); //关闭   
        }
        if (!file_exists($filename)) {
            exit("无法找到文件"); //即使创建，仍有可能失败。。。。   
        }
//        header("Cache-Control: public"); 
//        header("Content-Description: File Transfer"); 
//        header('Content-disposition: attachment; filename='.basename($filename)); //文件名   
//        header("Content-Type: application/zip"); //zip格式的   
//        header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件    
//        header('Content-Length: '. filesize($filename)); //告诉浏览器，文件大小   
//        @readfile($filename);
    }

    /*
     * 删除文件
     * $files：文件详细地址的数组
     */

    private static function unlinkFiles($files) {
        foreach ($files as $file) {
            \unlink($file);
        }
    }

}

?>