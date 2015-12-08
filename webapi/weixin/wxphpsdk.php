<?php
require_once(dirname(__FILE__)."/libcode/def.php");
/*
 * 
 * 
 */
class WXPHPSDK {
    private $appId;
    private $appSecret;
    public function __construct($appId, $appSecret) {
      $this->appId = $appId;
      $this->appSecret = $appSecret;  
    }
    private function httpclient($url){
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_HEADER, 0);
       $output = curl_exec($ch);
       curl_close($ch);
       $arr_out = json_decode($output);
       return $arr_out;
    }
    /**
     * 获取微信授权码
     * @param type $calbackUrl   重定向的URL 地址
     * @param type $isScope     SCOPE 模式,1snsapi_userinfo ,0 表示snsapi_base
     * @param type $wxState     用户自定义state参数
     */
    public function wxGetAuthorizationCode($calbackUrl,$isScope,$wxState){
       
        $REDIRECT_URI=$calbackUrl ;//$URL.'/index2.php';
        $scope="";
         if($isScope =='1'){
              $scope='snsapi_userinfo';//需要授权
         }
         else {
             $scope='snsapi_base';
         }
        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid;
        $url=$url.'&redirect_uri='.urlencode($REDIRECT_URI);
        $url=$url.'&response_type=code&scope='.$scope;
        $url=$url.'&state='.$wxState.'#wechat_redirect';
        header("Location:".$url);
     }
 
     /**
      * 获取微信用户的 openid,nickname 昵称, headimgurl 头像
      * @return JSON
      */
    public function wxWebLogin(){
       $code = $_GET["code"];
       $url= "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->appSecret."&code=$code&grant_type=authorization_code";
       $arr = httpclient($url);
       
       $url="https://api.weixin.qq.com/sns/userinfo?access_token=$arr->access_token&openid=$arr->openid&lang=zh_CN";
       $arr1 = httpclient($url);
       $out = json_decode($arr1);
       
       $resp = array('openid' => $arr->openid,'nickname'=>urldecode($out->nickname),'headimgurl'=>$out->headimgurl);
       return json_encode($resp);
    }

}