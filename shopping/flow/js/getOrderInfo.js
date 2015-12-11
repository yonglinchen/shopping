$(function(){
    //读取订单数据信息
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1002";
    service = JSON.stringify(service);
    
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            for(var i=0; i<data.data.length; i++){
                $(".goods-list").append('<div class="goods-item"><div class="p-img"><a target="_blank" href=""><img src="//img14.360buyimg.com/N4/jfs/t2233/183/845842268/89174/ef977bf2/56309006N498d80df.jpg" alt=""></a></div><div class="goods-msg"><div class="goods-msg-gel"><div class="p-name"><a href="#" target="_blank">'+data.data[i].goods_name+'</a></div><div class="p-price"><strong class="jd-price">￥'+data.data[i].goods_price+'</strong><span class="p-num">x'+data.data[i].goods_number+'</span><span class="p-state">有货</span></div></div></div><div><i class="p-icon p-icon-w"></i><span class="ftx-04">7天无理由退货</span></div></div>');
            }
            console.log(data);
        } else {
            console.log(data);
        }
    });
    
    
    //添加收货人地址
    $(".save").click(function(){ 
        var vip_name = $(".vip_name").val();//姓名
        if($.trim(vip_name) == ''){
            $(".vip_name_span").show();
            $(".vip_name").focus();
            return false;
        }else{
            $(".vip_name_span").hide();
        }

        var vip_select1 = $(".vip_select1").val();//地区信息
        if($.trim(vip_select1) == ''){
            $(".vip_select_span").show();
            $(".vip_select1").focus();
            return false;
        }else{
            $(".vip_select_span").hide();
        }
        var vip_select2 = $(".vip_select2").val();
        if($.trim(vip_select2) == ''){
            $(".vip_select_span").show();
            $(".vip_select2").focus();
            return false;
        }else{
            $(".vip_select_span").hide();
        }
        var vip_select3 = $(".vip_select3").val();
        if($.trim(vip_select3) == ''){
            $(".vip_select_span").show();
            $(".vip_select3").focus();
            return false;
        }else{
            $(".vip_select_span").hide();
        }
        var vip_site = $(".vip_site").val();//详细地址
        if($.trim(vip_site) == ''){
            $(".vip_site_span").show();
            $(".vip_site").focus();
            return false;
        }else{
            $(".vip_site_span").hide();
        }

        var vip_tel = $(".vip_tel").val(); //电话
        if($.trim(vip_tel) == ''){
            $(".vip_tel_span2").hide();
            $(".vip_tel_span1").show();
            $(".vip_tel").focus();
            return false;
        }else{
            $(".vip_tel_span1").hide();
        }
        var reg = /^\d{11}$/;
        if(!reg.test(vip_tel)) {
            $(".vip_tel_span1").hide();
            $(".vip_tel_span2").show();
            $(".vip_tel").focus();
            return false;
        }else{
            $(".vip_tel_span2").hide();
        }

        var vip_email = $(".vip_email").val(); //邮箱
        if($.trim(vip_email) == ''){
            $(".vip_email_span2").hide();
            $(".vip_email_span1").show();
            $(".vip_email").focus();
            return false;
        }else{
            $(".vip_email_span1").hide();
        }
        var reg2= /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
        if(!reg2.test(vip_email)) {
            $(".vip_email_span1").hide();
            $(".vip_email_span2").show();
            $(".vip_email").focus();
            return false;
        }else{
            $(".vip_email_span2").hide();
        }

        $('.mask').fadeOut(100);
        $('.collect').slideUp(200);
        $("#consignee-list").append('<li class="ui-switchable-panel"><div class="consignee-item"><span>姬单单 北京</span><b></b></div><div class="addr-detail"><span class="addr-name" title="姬单单">姬单单</span><span class="addr-info">北京 朝阳区 四环到五环之间 北京市朝阳区望京福码大厦A座18层</span><span class="addr-tel">132****7353</span></div><div class="op-btns" style="display:none;"><a href="javascript:;" class="ftx-05 setdefault-consignee">设为默认地址</a><a href="javascript:;" class="ftx-05 edit-consignee" onclick="use_NewConsignee()">编辑</a><a href="javascript:;" class="ftx-05 del-consignee">删除</a></div></li>');
    
    });
    
    //设置默认地址背景颜色以及文字显示与隐藏
    $(".op-btns").hide();
    $(".ui-switchable-panel").live("mousemove",function(){
        $(this).addClass("li_hover");
        $(this).find(".op-btns").show();
        if($(this).find(".consignee-item").hasClass("item-selected")){
            $(this).find(".op-btns .setdefault-consignee").html("");
        }else{
            $(this).find(".op-btns .setdefault-consignee").html("设置默认地址");
        }
    });
    $(".ui-switchable-panel").live("mouseout",function(){
        $(this).removeClass("li_hover");
        $(this).find(".op-btns").hide();
    });
	
    //收货人信息 
    $(".consignee-item").live("click",function(){
        if($(this).hasClass("item-selected")){
            //$(this).siblings(".op-btns").find(".setdefault-consignee").html("");
        }else{
            $(this).parent("li").siblings(".ui-switchable-panel").find("div").removeClass("item-selected");
            $(this).addClass("item-selected");
            $(this).siblings(".op-btns").find(".setdefault-consignee").html("");
        }
    });	
	
    //点击设置默认地址
    $(".setdefault-consignee").live("click",function(){
        if($(this).parent().siblings(".consignee-item").hasClass("item-selected")){
        }else{
            $(this).parent().parent().siblings(".ui-switchable-panel").find(".consignee-item").removeClass("item-selected");
            $(this).parent().siblings(".consignee-item").addClass("item-selected");
        }
    });
    //点击编辑
    $(".edit-consignee").click(function(){
//		alert("这是编辑");
    });
    //点击删除
    $(".del-consignee").live("click",function(){
        $(this).parent("div").parent("li").remove();
    });
	
    //鼠标放到支付方式上面的时候
    $('.online-payment').hover(function(){
        $(this).addClass('payment-item-hover');
    },function(){
        $(this).removeClass('payment-item-hover');
    }); 
    //选择支付方式 
    $("#payment-list li").click(function(){
        $("#payment-list .item-selected").removeClass("item-selected");
        $(this).find(".payment-item").addClass("item-selected");	
    });

    //点击提交按钮
    $(".checkout-submit").click(function(){
        location.href = 'pay.html';
    });
});
/*新增收货地址*/
function use_NewConsignee(){	
    $('.mask').fadeIn(100);      //弹出窗口
    $('.popover_3').slideDown(200);
    $('.close').click(function(){
        $('.mask').fadeOut(100);
        $('.collect').slideUp(200);
    });
}
