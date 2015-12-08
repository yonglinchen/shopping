<?php
/* *
 * 配置文件
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
	
 * 提示：如何获取安全校验码和合作身份者id
 * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
 * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
 * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”
	
 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

$alipay_config = array(
		//合作身份者id，以2088开头的16位纯数字
		'partner'	=> '2088011992057121',//星路
		//$alipay_config['partner']		= '2088811294695780';//松鼠
		
		//安全检验码，以数字和字母组成的32位字符
		'key'			=> 'kbe9yio4otinjn5vfst7ysmptivz21pq',//xinglu
		//$alipay_config['key']			= 'wbwf5967tryqqztdz5kalmprcs8w5wr8';//songshu
		
		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		
		//签名方式 不需修改
		'sign_type'    =>  strtoupper('MD5'),
		
		//字符编码格式 目前支持 gbk 或 utf-8
		'input_charset' => strtolower('utf-8'),
		
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		'cacert'    => getcwd().'\\cacert.pem',
		
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		'transport'    => 'http',
		
		'private_key_path'	=> 'key/rsa_private_key.pem',
		
		//支付宝公钥（后缀是.pen）文件相对路径
		//如果签名方式设置为"0001"时，请设置该参数
		'ali_public_key_path' => 'key/alipay_public_key.pem'
	);
$alipay = array(
	 'payment_type' => '1',
	 
	 //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
	 'seller_email'=>'allstarway@126.com',
	 
	 //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
	 'notify_url'=>'http://'.$_SERVER['HTTP_HOST'].'/xinglu/index.php/recharge/index/update_order', 
	
	 //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
	 'return_url'=>'http://'.$_SERVER['HTTP_HOST'].'/xinglu/index.php/recharge/index/update_order',
	 'show_url' => 'http://'.$_SERVER['HTTP_HOST'].'/taobao/return_url.php',//商品展示地址
	 
	 //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
	 'successpage'=>'User/myorder?ordtype=payed',   
	 
	 //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
	 'errorpage'=>'User/myorder?ordtype=unpay'
	 );
?>