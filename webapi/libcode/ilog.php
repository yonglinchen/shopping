<?php
require_once("fun.php");

if(!defined('iLOG_INFO'))       define('iLOG_INFO', 3);
if(!defined('iLOG_WARNING'))    define('iLOG_WARNING', 2);
if(!defined('iLOG_ERROR'))      define('iLOG_ERROR', 1);	
if(!defined('iLOG_DEFAULT'))    define('iLOG_DEFAULT', 0);

class iLog
{
    var $iLog_file;
    var $iLog_user;
    var $iLog_key;
    var $iLog_fpath;
    var $iTag_file;
    var $iTag_line;
    var $iTag_logroot;
    var $iTag_rank;
    var $iTag_size;

    function __construct($user, $api_k, $rank='iLOG_INFO'){
        $this->iLog_user = $user;
        $this->iLog_key = $api_k;
        $this->iTag_logroot = _LOG_PATH_;//"../log/";
        $this->iLog_fpath = $this->iTag_logroot."web.log";
        $this->iTag_file = "-";
        $this->iTag_line = "-";
        $this->iTag_rank = $rank;
        $this->iTag_size = 10000000; // 10M
    }

    function start(){
        if(file_exists($this->iLog_fpath)){
            if($this->check_file())
                $this->iLog_file = fopen($this->iLog_fpath,"a");
            else{
                $this->do_update_file();
                $this->do_creat_file();
            }
        }
        else{
            if(!file_exists($this->iTag_logroot))
                    mkdir($this->iTag_logroot, 0777, true);
            $this->do_creat_file();
        }
    }

    function stop(){
        if($this&& $this->iLog_file)fclose($this->iLog_file);
    }

    function tag_file($file){
        if($this) $this->iTag_file = $file;
    }

    function tag_line($line){
        if($this) $this->iTag_line = $line;
    }

    function set_rank($rank){
        if($this) $this->iTag_rank = $rank;
    }

    function log($rank,$log,$tag=NULL){
        if(!$this)	return;

        if($rank > $this->iTag_rank)	return;
        date_default_timezone_set('PRC'); //默认是格林威治时间，与北京时间差8个小时使用此参数，用北京时间
        $date = date('Y-m-d H:i:s',time());
        if($tag==NULL)
                $tag = "file:".$this->iTag_file."(line:".$this->iTag_line.")";
        switch($rank)
        {
        case iLOG_INFO:
                $rank_tag = "info";
                break;
        case iLOG_WARNING:
                $rank_tag = "warn";
                break;
        case iLOG_ERROR:
                $rank_tag = "err!";
                break;
        case iLOG_DEFAULT:
                $rank_tag = "info";
                break;							
        }
//		$w_str = "[".$date."]"." [ext:".$this->iLog_user."] [api_k:".$this->iLog_key."] [".$tag."] ".$log."\r\n";
        $w_str = "[".$date."][".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']."][".$rank_tag."] ".$log."\r\n";

        if($this->iLog_file && flock($this->iLog_file, LOCK_EX))
        {
                fwrite($this->iLog_file,$w_str);
                flock($this->iLog_file,LOCK_UN);
        }
    }

    function check_file(){
        if(filesize($this->iLog_fpath) > $this->iTag_size)
                return FALSE;
        else
                return TRUE;
    }

    function do_creat_file(){
        $this->iLog_file = fopen($this->iLog_fpath,"w");
        $version = _VERSION;
        $this->log(iLOG_DEFAULT, "********************************************************************");
        $this->log(iLOG_DEFAULT, "                WEB Log version: ".$version);
        $this->log(iLOG_DEFAULT, "********************************************************************");
    }

    function rename_file($old_name, $new_name){
        if(file_exists($old_name)) rename($old_name, $new_name);
    }

    function do_update_file(){
        $file_1 = $this->iTag_logroot."web.1";
        $file_2 = $this->iTag_logroot."web.2";
        $file_3 = $this->iTag_logroot."web.3";
        $file_4 = $this->iTag_logroot."web.4";
        if(file_exists($file_4))
                unlink($file_4);
        $this->rename_file($file_3, $file_4);
        $this->rename_file($file_2, $file_3);
        $this->rename_file($file_1, $file_2);
        $this->rename_file($this->iLog_fpath, $file_1);
    }
}
// 设置全局日志对象
$log = NULL; // 全局日志对象	
// 日志级别(从低到高)：iLOG_INFO,iLOG_WARNING,iLOG_ERROR
$api_k = 'QST';
$log = new iLog(0, $api_k, iLOG_INFO);  // 若要关闭日志，只需要把此行注释掉
if($log) $log->start();
//set_ilog(ifile_name(__FILE__));
ilog(iLOG_INFO, "<--------- start --------->", __LINE__);
?>