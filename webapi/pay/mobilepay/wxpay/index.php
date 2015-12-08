<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付样例</title>
    <style type="text/css">
        ul {
            margin-left:10px;
            margin-right:10px;
            margin-top:10px;
            padding: 0;
        }
        li {
            width: 32%;
            float: left;
            margin: 0px;
            margin-left:1%;
            padding: 0px;
            height: 100px;
            display: inline;
            line-height: 100px;
            color: #fff;
            font-size: x-large;
            word-break:break-all;
            word-wrap : break-word;
            margin-bottom: 5px;
        }
        a {
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:link{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:visited{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:hover{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:active{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
    </style>
<!--    <script src="../js/jquery-1.9.1.min.js"></script>
    <script>
        var var_data = {};
        var_data.openid = "11";
        var_data = JSON.stringify(var_data);
        $(function(){
            $("#jscose").on("click", function(){alert("xxxxxxxxxxxx");
                $.post('http://www.dalaozhaopin.com/dlzp/wxpay/wpay/jsapi.php',var_data,function(data){
                    alert("suc11cess");
                    alert(data);
                },function(){
                    alert("error");
                    alert(var_data);
                });
            });
        });
    </script>-->
</head>
<body>
	<div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a id="jscose" href="http://192.168.111.23/webapi/pay/mobilepay/wxpay/interface/jsapi.php?goods=直播入场券&seller=高阳&fee=0.01&callback=http://www.dalaozhaopin.com/wxpay/test.php?states=1">JSAPI支付</a></li>
            <li style="background-color:#698B22"><a href="http://paysdk.weixin.qq.com/example/micropay.php">刷卡支付</a></li>
            <li style="background-color:#8B6914"><a href="http://paysdk.weixin.qq.com/example/native.php">扫码支付</a></li>
            <li style="background-color:#CDCD00"><a href="http://paysdk.weixin.qq.com/example/orderquery.php">订单查询</a></li>
            <li style="background-color:#CD3278"><a href="http://paysdk.weixin.qq.com/example/refund.php">订单退款</a></li>
            <li style="background-color:#848484"><a href="http://paysdk.weixin.qq.com/example/refundquery.php">退款查询</a></li>
            <li style="background-color:#8EE5EE"><a href="http://paysdk.weixin.qq.com/example/download.php">下载订单</a></li>
        </ul>
	</div>
</body>
</html>