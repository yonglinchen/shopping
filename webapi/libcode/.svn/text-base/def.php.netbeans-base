<?php
    require_once("errcode.php");
    require_once("ver.php");
    //根路径
    if(!defined('_ROOT_URL_'))          define('_ROOT_URL_', "http://192.168.111.23/webapi/");
    //DB 配置
    if(!defined('_MULTI_RESULTS_'))     define('_MULTI_RESULTS_', 131072);
    if(!defined('_HOST_'))              define ('_HOST_','192.168.110.78');	
    if(!defined('_USER_'))              define ('_USER_','livedb');	
    if(!defined('_PSW_'))               define ('_PSW_','hexin');	
    if(!defined('_DB_'))                define ('_DB_','qstdb');
    //ihttp 配置
    if(!defined('_IP_'))                define('_IP_', '127.0.0.1');	
    if(!defined('_PORT_'))              define('_PORT_', 8000);	
    //日志
    if(!defined('_LOG_PATH_'))          define('_LOG_PATH_', './log/');
    //发送邮件相关
    if(!defined('_MAILCALLBACK_'))      define ('_MAILCALLBACK_','http://192.168.111.23/webapi/');
    if(!defined('_MAILHOST_'))          define ('_MAILHOST_','smtp.exmail.qq.com');
    if(!defined('_MAILUSERNAME_'))      define ('_MAILUSERNAME_','service@3brush.com');
    if(!defined('_MAILPASSWORD_'))      define ('_MAILPASSWORD_','3Brush21'); 
    if(!defined('_MAILSUBJECT_'))       define ('_MAILSUBJECT_','骑士团'); 
    //短信主题
    if(!defined('_MESSAGESUBJECT_'))    define ('_MESSAGESUBJECT_','骑士团'); 
    //微信公众号开发定义
    if(!defined('_APPID_'))             define ('_APPID_','wx7a51fda500a2cd2e');
    if(!defined('_SECRET_'))            define ('_SECRET_','3b0b111752d6ebe82ac51c86ce6b8701'); 
    if(!defined('_TICKET_'))            define ('_TICKET_','/var/www/web/Application/wxchat/update_token/jsapi_ticket.json'); 
    //微信支付
    if(!defined('_WXAPPID_'))           define ('_WXAPPID_','wxf92e622f0985ef8a');  //开户邮件中的（公众账号APPID或者应用APPID）
    if(!defined('_WXMCHID_'))           define ('_WXMCHID_','1263121101');  ;//开户邮件中的商户号
    if(!defined('_WXKEY_'))             define ('_WXKEY_','master20151201000000000000000000');  
    if(!defined('_WXAPPSECRET_'))       define ('_WXAPPSECRET_','e256d3510fe202a01ad764f2020e7e16'); 
    if(!defined('_WXAPPURL_'))          define ('_WXAPPURL_','http://www.dalaozhaopin.com');
    if(!defined('_WXNOTIFYURL_'))       define ('_WXNOTIFYURL_','http://192.168.111.23/webapi/');
    //阿里支付宝帐号
    if(!defined('_ALIPAYPARTNER_'))     define ('_ALIPAYPARTNER_','2088021294822480'); 
    if(!defined('_ALIPAYKEY_'))         define ('_ALIPAYKEY_','t08v5xiawop1ldx3lppv9tdrj3fm25cy'); 
    if(!defined('_ALIPAYRTURL_'))       define ('_ALIPAYRTURL_',_MAILCALLBACK_.'pay/pc_pay/alipay/return_url.php'); 
    if(!defined('_ALIPAYNTURL_'))       define ('_ALIPAYNTURL_',_MAILCALLBACK_.'pay/pc_pay/alipay/notify_url.php'); 
    if(!defined('_ALIPAYGOODURL_'))     define ('_ALIPAYGOODURL_',_MAILCALLBACK_); 
    if(!defined('_ALIPAYROOTURL_'))     define ('_ALIPAYROOTURL_',_MAILCALLBACK_); 
    if(!defined('_ALIPAYSELLEREMIAL_')) define ('_ALIPAYSELLEREMIAL_','pay@3brush.com'); //收款方的支付宝账号  三把刷子
    //阿里支付宝帐号  银行端口
    if(!defined('_ALIPAYBANKRTURL_'))   define ('_ALIPAYBANKRTURL_',_MAILCALLBACK_.'pay/pc_pay/alipaybank/return_url.php'); 
    if(!defined('_ALIPAYBANKNTURL_'))   define ('_ALIPAYBANKNTURL_',_MAILCALLBACK_.'pay/pc_pay/alipaybank/notify_url.php'); 
    //阿里web移动支付
    if(!defined('_ALIPAYWEBRTURL_')) define ('_ALIPAYWEBRTURL_',_MAILCALLBACK_.'pay/mobilepay/alipayweb/return_url.php'); 
    if(!defined('_ALIPAYWEBNTURL_')) define ('_ALIPAYWEBNTURL_',_MAILCALLBACK_.'pay/mobilepay/alipayweb/notify_url.php'); 
    //阿里app移动支付
    if(!defined('_ALIPAYAPPNTURL_')) define ('_ALIPAYAPPNTURL_',_MAILCALLBACK_.'pay/mobilepay/alipaysdk/notify_url.php'); 
    
    //支付主体
    if(!defined('_PAYSUBJECT_'))        define ('_PAYSUBJECT_','支付主题骑士团'); //支付主题
    if(!defined('_PAYSUCCESSURL_'))     define ('_PAYSUCCESSURL_',_MAILCALLBACK_); //支付成功后的跳转地址

?>