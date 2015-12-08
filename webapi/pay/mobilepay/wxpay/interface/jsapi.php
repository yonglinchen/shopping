<?php 
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//
$_GOODS=$_GET['goods'];
$_SELLER=$_GET['seller'];
$_FEE=$_GET['fee'];
$_CALLBACK=$_GET['callback'];

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);
$logHandler->write("11111111111111111");

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        //echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($_GOODS);
$input->SetAttach($_SELLER);
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
//$input->SetTotal_fee("1");
$vfee = $_FEE * 100;
$input->SetTotal_fee($vfee);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("dlzp");
$input->SetNotify_url(WxPayConfig::MCHID."/wxpay/interface/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall(){
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                <?php echo $jsApiParameters; ?>,
                function(res){
                    WeixinJSBridge.log(res.err_msg);
                    var _url ="<?php echo $_CALLBACK; ?>";
                    var _bool = _url.indexOf("?");
                    if(res.err_msg == "get_brand_wcpay_request:ok"){
                        //支付成功
                        if(_bool > 0){
                            _url += '&errcode=0&errmsg=' + res.err_msg;
                        }else{
                            _url += '?errcode=0&errmsg=' + res.err_msg;
                        }
                        window.location.href=_url;
                        //关闭当前页
//                        WeixinJSBridge.invoke('closeWindow',{},function(res){
//                        });                       
                    }else{
                        //支付失败
                        if(_bool > 0){
                            _url += '&errcode=1&errmsg=' + res.err_msg;
                        }else{
                            _url += '?errcode=1&errmsg=' + res.err_msg;
                        }
 //                       WeixinJSBridge.invoke('closeWindow',{},function(res){
 //                       }); 
                        window.location.href=_url; 
                            
                    }
                }
            );
	}
	function callpay(){	
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
	}
    </script>
    <script type="text/javascript">
	//获取共享地址
	function editAddress(){
            WeixinJSBridge.invoke(
                'editAddress',
                <?php echo $editAddress; ?>,
                function(res){
                    var value1 = res.proviceFirstStageName;
                    var value2 = res.addressCitySecondStageName;
                    var value3 = res.addressCountiesThirdStageName;
                    var value4 = res.addressDetailInfo;
                    var tel = res.telNumber;
                    alert(value1 + value2 + value3 + value4 + ":" + tel);
                }
            );
	}
    </script>
</head>
<body style="margin: 0;padding: 0;">
    <br/>
    <p style="color:#000;font-size:20px;text-align: center;"><?php echo $_GOODS ?></p>
    <p style="color:#000;font-size:50px;text-align: center;">￥<?php echo sprintf("%0.2f", $vfee/100);?></p>
    <div class="" style="border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;line-height: 40px;font-size:18px;">
        <p style="zoom:1;clear:both;width: 90%;margin: 0 auto;padding-top: 20px;">收款方<span style="float: right;"><?php echo $_SELLER ?></span></p>
        <p style="zoom:1;clear:both;width: 90%;margin: 0 auto;padding-bottom: 20px;">商品<span style="float: right;"><?php echo $_GOODS ?></span></p>
    </div>
    <br/><br/>
    <div align="center">
            <button style="width:90%; height:50px; border-radius: 5px;background-color:green; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
    </div>
</body>
</html>