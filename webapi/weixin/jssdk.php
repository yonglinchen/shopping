<?php
require_once(dirname(__FILE__)."/libcode/def.php");
$jssdk = new JSSDK(_APPID_, _SECRET_);
$signPackage = $jssdk->GetSignPackage(_TICKET_);

class JSSDK {
  private $appId;
  private $appSecret;
  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;  
  }

  public function getSignPackage($ticket) {
    $jsapiTicket =  file_get_contents($ticket);
    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $timestamp = time();
    $nonceStr = $this->createNonceStr();
    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
    $signature = sha1($string);
    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {  
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }
  
}
?>
<script>
var __root__ = '<?php echo _ROOT_URL_;?>';
document.write('<script type="text/javascript"  src='+ __root__+'weixin/js/jweixin-1.0.0.js />');
document.write('<script type="text/javascript"  src='+ __root__+'weixin/js/wxjssdk.js />');
</script>
<script>
    wx.config({
     debug: true,
     appId: '<?php echo $signPackage["appId"];?>',
     timestamp: <?php echo $signPackage["timestamp"];?>,
     nonceStr: '<?php echo $signPackage["nonceStr"];?>',
     signature: '<?php echo $signPackage["signature"];?>',
     jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
     ]
   });   
    wx.ready(function () {
        //1 判断当前版本是否支持指定 JS 接口，支持批量判断
        //console.log("wx.ready");
   });
   wx.error(function (res) {
      //alert(res.errMsg);
    });
</script>
