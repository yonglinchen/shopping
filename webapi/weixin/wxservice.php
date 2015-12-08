<?php
/*
 * 该文件定义一些后台接口，用于访问微信接口 
 * web/app client---> wxservice.php 文件接口------->微信服务器
 */

/* 下载媒体素材接口
 * @param {String} 		url   	  
 *  "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token="  图片素材下载
 *  "http://api.weixin.qq.com/cgi-bin/media/get?access_token="       视频/音频临时素材下载
 * @param {String} 		$type 	        
 * @param {String} 		mediaId             下载媒体素材id
 * @param {String} 		savePath            存储媒体素材的文件名,包括绝对路径
 * @returns｛bool｝          result              true 成功，false 失败
*/

function downloadMedia($type, $mediaId, $savePath)
{
    $access_token=$this->GetToken();
    if($type==self::MSGTYPE_IMAGE)
    {
        $url="http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=";
    }
    elseif($type==self::MSGTYPE_VOICE or $type==self::MSGTYPE_VIDEO)
    {
        $url="http://api.weixin.qq.com/cgi-bin/media/get?access_token=";
    }
    else 
    {
        $this->DebugLog('the format is not support,type='.$type, __METHOD__);
        return false;
    }
    $ch = curl_init();
    $surl =  $url.$access_token . "&media_id=" . $mediaId;
    curl_setopt($ch, CURLOPT_URL, $surl);		
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $response = curl_exec($ch);
    $result = false;
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE) ;
    if ($status == '200') {
        if('' != $response){
            if(file_exists($savePath)){
                    unlink($savePath);
            }
            $file = fopen($savePath, "a");
            fwrite($file, $response);
            fclose($file);
            $result = true;
        }	
    }
    curl_close($ch);
    return $result;
}

/**
 * @param type $url
 * https://api.weixin.qq.com/cgi-bin/media/upload?access_token=   临时素材上传接口
 * @param type $access_token                                     微信访问接口使用的token值
 * @param type $type                                             分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）
 * @param type $filename                                         媒体素材文件名 @D:/wamp/www/webapi/weixin/voice.amr
 * return   JSON 数据 如：  "status":"200","data":"{\"errcode\":40001,\"errmsg\":\"invalid credential, access_token is invalid or not latest hint: [41.K9a0306ent2]\"}"}
 *     status 200 表示HTTP 成功 其他值HTTP 失败，文件是否上传成功 看errcode  
 */
 function uploadMedia($type,$filename){
    $post_string = array(
        'file1'=>'@'.$filename
        ); 
    $url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token=';
    $access_token=$this->GetToken();
    $surl =  $url.$access_token ."&type=" . $type;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $surl);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if($type==self::MSGTYPE_IMAGE)
    {
        curl_setopt($ch, CURLINFO_CONTENT_TYPE , 'image/jpeg');
    }
    $response = curl_exec($ch);  
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE) ;
    curl_close($ch);
    $result=array();
    if ($status == '200') {
        if('' != $response){
           $result=array("status"=>"200","data"=>json_decode($response,true));
           $this->DebugLog('respose='.json_encode($result), __METHOD__);
           return $result ;

        }	
    }
    $result=array("status"=>"1","data"=>"上传失败");
    $this->DebugLog('upload file('.$filename.') type='.$type.' respose='.json_encode($result), __METHOD__);
    return $result;
}

function TestdownloadMedia(){
    $access_token = "kP6fuJ9eB3QF0Nsl9eN1ZOqGnkRwJc-ooYpfuKCZSnBC1NPLacdt3OxV_BT8yuYlbT9SC6Igy03wUoiEchaEpdZAmsHSsOHabgoIneu_smoHGIdAFAUTV";
    $storeName ="./voice.amr";
    $mediaid="VtiQK7GY_GtLGZFXv1rCC-Fa5nKfp0FP2BfkJ04f-fakeYl5v1eyElZHyZa4BInv";
    $url="http://api.weixin.qq.com/cgi-bin/media/get?access_token=";  
    $ret = downloadMedia($url,$access_token,$mediaid, $storeName);
    if(false == $ret){
            $resp = array('status' => 'failed');
    }else{
            $resp = array('status' => 'success', 'url' => $storeName);
    }
    echo json_encode($resp);
}

function TestUploadMedia(){
      
    $access_token = "kP6fuJ9eB3QF0Nsl9eN1ZOqGnkRwJc-ooYpfuKCZSnBC1NPLacdt3OxV_BT8yuYlbT9SC6Igy03wUoiEchaEpdZAmsHSsOHabgoIneu_smoHGIdAFAUTV";
    $type="voice";
    $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=";  
    $filename ="D:/wamp/www/webapi/weixin/voice.amr";
    $ret = uploadMedia($url,$access_token,$type,$filename);
    if(false == $ret){
            $resp = array('status' => 'failed');
    }else{
            $resp = array('status' => 'success', 'url' => $type);
    }
    echo json_encode($resp);
}
  
 
 TestUploadMedia();
 //TestdownloadMedia();
 
 

 

