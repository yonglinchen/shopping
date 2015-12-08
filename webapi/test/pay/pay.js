/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//console.log("_ROOT_URL_:"+_ROOT_URL_);
document.write("<script type='text/javascript' src='" + _ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");



$(function() {
    //绑定两个事件
    $("#createorder").bind('click', function() {
        var array1 = new Array();
        for (var i = 0; i < 3; i++) {
            array1[i] = {
                'i': i,
                'k': i * 10,
                'good_id': i,
                'number': i * 10
            }
        }
//       JSON.stringify(array);
        var ret = createorder(array1, 1);
//       console.log(ret);return;
        apiInterface(ret, function(status, data) {
            if (status == 0) {
                var outd = data.out_data;
                console.log(outd.pay_channel)
                $("#createorder").next().text(data.desc + ',支付方式为：' + outd.pay_channel + ',订单号：' + outd.order_no);
                $("#order_no").attr('value', outd.order_no)
            } else {
                console.log(data)
                $("#createorder").next().text(data.desc)
            }
        })
    });
    //支付
    $("#sendmsg").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        var ret = payorder(order_no, 'alipay', 'CMB');
//        var ret = payorder(order_no, 'alipaybank', 'CMB');

    });
    
    $("#sendbank").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        var ret = payorder(order_no, 'alipaybank', 'CMB');
    });
    
    //app web支付
    $("#webpay").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        var ret = payorder(order_no, 'alipayweb', '');
    });
    //app支付
    $("#apppay").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        var ret = payorderapp(order_no, 'alipayapp', '');
        apiInterface(ret, function(status, data) {
            if (status == 0) {
                console.log(data)
                $("#apppay").next().text(data.ali_pay_info);
                var alipayarr = data.ali_pay_info.split('&');
                var realdata = '';
                for(var i = 0;i<alipayarr.length;i++){
                    var temparr = alipayarr[i].split('=');
                    if(temparr[0]=='sign'){
                        $("#appverifysign").attr('sign',temparr[1]);
                        break;
                    }
                    else{
                        if(i>0){
                            realdata = realdata + '&';
                        }
                        realdata = realdata +  alipayarr[i];
                    }
                }
//                $("#order_no").attr('value', outd.order_no)
                $("#appverifysign").attr('realdata',realdata);
            } else {
                console.log(data)
                $("#apppay").next().text(data.desc)
            }
        })
    });
        //wxapp支付
    $("#appwxpay").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        var ret = payorderapp(order_no, 'wxapp', '');
        apiInterface(ret, function(status, data) {
            if (status == 0) {
                console.log(data)
                $("#appwxpay").next().text(data);
//                $("#order_no").attr('value', outd.order_no)
            } else {
                console.log(data)
                $("#appwxpay").next().text(data.desc)
            }
        })
    });
    
    //微信对账
    $("#wxcheck").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        order_no = '1449312428868';
        var ret = checkorder(order_no, 'wxapp');
//        console.log(ret);return;
        apiInterface(ret, function(status, data) {
            if (status == 0) {
                console.log(data)
                $("#wxcheck").next().text(data.ali_pay_info);
//                $("#order_no").attr('value', outd.order_no)
            } else {
                console.log(data)
                $("#wxcheck").next().text(data.desc)
            }
        })
    });
    //微信回调
     $("#wxcallback").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        var message = {
            "order_no": order_no,
        };
        var ret = JSON.stringify(message);
        apiSendAjax('http://www.testlxd.com/webapi/pay/mobilepay/wxpay/interface/appnotify.php', 
            ret, true, function(status, data) {
        //检查是否有单独的错误码，如果有，替换掉data.desc
            console.log(data)
         });
    });
        //app 支付宝回调
     $("#alicallback").bind('click', function() {
        var order_no = $("#order_no").attr('value');
        var message = {
            "order_no": order_no,
        };
        var ret = JSON.stringify(message);
        apiSendAjax('http://www.testlxd.com/webapi/pay/mobilepay/alipaysdk/notify_url.php', 
            ret, true, function(status, data) {
        //检查是否有单独的错误码，如果有，替换掉data.desc
            console.log(data)
         });
    });

    //app 支付宝验签
     $("#appverifysign").bind('click', function() {
        var sign = $("#appverifysign").attr('sign');
        var realdata = $("#appverifysign").attr('realdata');
        var message = {
            'inter_num':"0047",
            "sign": sign,
            'realdata':realdata
        };
        var ret = JSON.stringify(message);
        console.log(ret)
        apiInterface(ret, function(status, data) {
            if (status == 0) {
                console.log(data) 
            } else {
                console.log(data)
                $("#appverifysign").next().text(data.ret)
            }
        })
    });

});
