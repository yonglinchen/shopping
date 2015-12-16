$(function(){
    //读取订单数据信息
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1009";
    service = JSON.stringify(service);
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            $("#payPriceId").text("￥"+data.data.total);
            var addressList = data.data.addressList; //读取地址数据
            var Default = null;
            for(var _j=0; _j<addressList.length; _j++){
                addressList[_j].status == 1 ? Default = 'item-selected' : Default = '';
                $("#consignee-list").append('<li class="ui-switchable-panel panel_li'+addressList[_j].address_id+'"><div class="consignee-item '+Default+'"><input type="hidden" value="'+addressList[_j].address_id+'" class="address_id"><span><font class="addr-name">'+addressList[_j].consignee+'</font> <font class="per_province">'+addressList[_j].province+'</font></span><b></b></div><div class="addr-detail"><span class="addr-name">'+addressList[_j].consignee+' </span><span class="addr-info"><font class="per_province">'+addressList[_j].province+'</font> <font class="per_city">'+addressList[_j].city+'</font> <font class="per_district">'+addressList[_j].district+'</font> <font class="per_address">'+addressList[_j].address+' </font></span><input type="hidden" class="per_email" value="'+addressList[_j].email+'"><span class="addr-tel">'+addressList[_j].mobile+'</span></div><div class="op-btns" style="display:none;"><a href="javascript:;" class="ftx-05 setdefault-consignee" title="'+addressList[_j].address_id+'">设为默认地址</a><a href="javascript:;" class="ftx-05 edit-consignee" onclick="use_EditConsignee(this)" title="'+addressList[_j].address_id+'">编辑</a><a href="javascript:;" class="ftx-05 del-consignee" onclick="use_delete(this)" title="'+addressList[_j].address_id+'">删除</a></div></li>');
            }
            var paymentList = data.data.paymentList;  //读取支付方式
            var Default2 = null;
            for(var _i=0; _i<paymentList.length; _i++){
                _i == 0 ? Default2 = 'item-selected' : Default2 = '';
                $("#payment-list").append('<li style="cursor: pointer;"><div class="payment-item '+Default2+' online-payment"><input type="hidden" value="'+paymentList[_i].pay_id+'">'+paymentList[_i].pay_name+'</div></li>');
            }
            var goodlist = data.data.cartGoodList;  //读取购买商品清单
            for(var i=0; i<goodlist.length; i++){
                $(".goods-list").append('<div class="goods-item"><div class="p-img"><a target="_blank" href=""><img src="images/'+goodlist[i].good_img+'" alt=""></a></div><div class="goods-msg"><div class="goods-msg-gel"><div class="p-name"><a href="#" target="_blank">'+goodlist[i].goods_name+'</a></div><div class="p-price"><strong class="jd-price">￥'+goodlist[i].goods_price+'</strong><span class="p-num">x'+goodlist[i].goods_number+'</span><span class="p-state">有货</span></div></div></div><div><i class="p-icon p-icon-w"></i><span class="ftx-04">7天无理由退货</span></div></div>');
            }
            console.log(data);            
        } else {
            console.log(data);
        }
    }); 
    
    //三级联动接口
    var currentProvince = null;
    var currentCity = null;
    var currentDistrict = null;
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1005";
    service = JSON.stringify(service);
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            var currentProvince = data.data[0]['child'];
            for(var i=0; i<currentProvince.length; i++){
                $(".vip_select1").append('<option _index="'+i+'" value="'+currentProvince[i]['region_id']+'">'+currentProvince[i]['region_name']+'</option>');
                
            }
            $(".vip_select1").change(function(){
                $(".vip_select2").html("");
                $(".vip_select3").html("");
                $(".vip_select2").append('<option value>请选择</option>');
                $(".vip_select3").append('<option value>请选择</option>');
                currentCity = currentProvince[$(this).find("option:selected").attr("_index")]['child'];
                for(var j=0; j<currentCity.length; j++){
                    $(".vip_select2").append('<option _index="'+j+'" value="'+currentCity[j]['region_id']+'">'+currentCity[j]['region_name']+'</option>');
                }
             })
             $(".vip_select2").change(function(){
                $(".vip_select3").html("");
                $(".vip_select3").append('<option value>请选择</option>');
                currentDistrict = currentCity[$(this).find("option:selected").attr("_index")]['child']; 
                for(var m=0;m<currentDistrict.length; m++){
                    $(".vip_select3").append('<option value="'+currentDistrict[m]['region_id']+'">'+currentDistrict[m]['region_name']+'</option>');
                }
             });
            console.log(data.data[0]);
            
//            alert(data.data[0]['child'][0]['region_name']);
        } else {
            console.log(data);
        }
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
            var address_id = $(this).find(".address_id").val();
            var service = {};  
            service.inter_num = "0050";   
            service.servicecode = "1008";
            service.address_id = address_id;
            service = JSON.stringify(service);
            var send_url = rooturl + "/../webapi/index.php";
            apiSendAjax(send_url, service, true, function (status, data) {
                if(status == 0){
                    console.log(data);
                } else {
                    console.log(data);
                }
            });
            $(this).parent("li").siblings(".ui-switchable-panel").find("div").removeClass("item-selected");
            $(this).addClass("item-selected");
            $(this).siblings(".op-btns").find(".setdefault-consignee").html("");
        }
    });	
	
    //点击设置默认地址
    $(".setdefault-consignee").live("click",function(){
        if($(this).parent().siblings(".consignee-item").hasClass("item-selected")){
        }else{
            var address_id2 = $(this).parent().siblings(".consignee-item").find(".address_id").val();
            var service = {};  
            service.inter_num = "0050";   
            service.servicecode = "1008";
            service.address_id = address_id2;
            service = JSON.stringify(service);
            var send_url = rooturl + "/../webapi/index.php";
            apiSendAjax(send_url, service, true, function (status, data) {
                if(status == 0){
                    console.log(data);
                } else {
                    console.log(data);
                }
            });
            $(this).parent().parent().siblings(".ui-switchable-panel").find(".consignee-item").removeClass("item-selected");
            $(this).parent().siblings(".consignee-item").addClass("item-selected");
        }
    });
	
    //鼠标放到支付方式上面的时候
    $('.online-payment').live("mousemove",function(){
        $(this).addClass('payment-item-hover');
    }); 
    //选择支付方式 
    $("#payment-list li").live("click",function(){
        $("#payment-list .item-selected").removeClass("item-selected");
        $(this).find(".payment-item").addClass("item-selected");	
    });

    //点击提交按钮
    $(".checkout-submit").click(function(){
        location.href = 'pay.html';
    });
    
    $(".save").click(function(){        
        if(!common_reg()){
            return false;
        }
        /*新增收货地址 接口*/
        var service = {};
        var name = $(".vip_name").val();
        var Province = $(".vip_select1").val();
        var City = $(".vip_select2").val();
        var District = $(".vip_select3").val();
        var address = $(".vip_site").val();
        var tel = $(".vip_tel").val();
        var email = $(".vip_email").val();
        service.inter_num = "0050";   
        service.servicecode = "1006";
        service.consignee = name;//收货人
        service.country = "1";//国家（1）中国
        service.province = Province;//省
        service.city = City;//市
        service.district = District;//区
        service.address = address;//详细地址
        service.mobile = tel;//电话
        service.email = email;//邮箱
        service.type = "0";//新增
        service = JSON.stringify(service);
        var send_url = rooturl + "/../webapi/index.php";
        apiSendAjax(send_url, service, true, function (status, data) {
            if(status == 0){                
                $('.mask').fadeOut(100);
                $('.collect').slideUp(200);
                var Province2 = $(".vip_select1").find("option:selected").text();
                var City2 = $(".vip_select2").find("option:selected").text();
                var District2 = $(".vip_select3").find("option:selected").text();
                $("#consignee-list").append('<li class="ui-switchable-panel panel_li'+data.data.address_id+'"><div class="consignee-item"><input type="hidden" value="'+data.data.address_id+'" class="address_id"><span><font class="addr-name">'+name+'</font> <font class="per_province">'+Province2+'</font></span><b></b></div><div class="addr-detail"><span class="addr-name">'+name+' </span><span class="addr-info"><font class="per_province">'+Province2+'</font> <font class="per_city">'+City2+'</font> <font class="per_district">'+District2+'</font> <font class="per_address">'+address+' </font></span><input type="hidden" class="per_email" value="'+email+'"><span class="addr-tel">'+tel+'</span></div><div class="op-btns" style="display:none;"><a href="javascript:;" class="ftx-05 setdefault-consignee" title="'+data.data.address_id+'">设为默认地址</a><a href="javascript:;" class="ftx-05 edit-consignee" onclick="use_EditConsignee(this)" title="'+data.data.address_id+'">编辑</a><a href="javascript:;" class="ftx-05 del-consignee" onclick="use_delete(this)" title="'+data.data.address_id+'">删除</a></div></li>');
                console.log(data);
            } else {
                console.log(data);
            }
        }); 
    });  
    
});
/*新增收货地址*/
function use_NewConsignee(){
    $(".collect input[type='text']").attr("value","");
    $(".vip_select1").find("option:selected").removeAttr("selected");
    $(".vip_select2").html("");
    $(".vip_select2").append('<option value>请选择</option>');
    $(".vip_select3").html("");
    $(".vip_select3").append('<option value>请选择</option>');
    $(".poptit span").text("新增收货人地址");
    $(".edit_message").hide();
    $(".save").show();
    $('.mask').fadeIn(100);      //弹出窗口
    $('.popover_3').slideDown(200);
    $('.close').click(function(){
        $('.mask').fadeOut(100);
        $('.collect').slideUp(200);
    });
}
/*删除收货人地址*/
function use_delete(obj){
    var delete_address_id = $(obj).attr("title");
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1007";
    service.address_id = delete_address_id;
    service = JSON.stringify(service);
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            console.log(data);
        } else {
            console.log(data);
        }
    });
    $(".panel_li"+delete_address_id).remove();
}
/*编辑收货人地址信息*/
function use_EditConsignee(obj){
    $(".poptit span").text("编辑收货人地址");
    $(".save").hide();
    $(".edit_message").show();
    $('.mask').fadeIn(100);      //弹出窗口
    $('.popover_3').slideDown(200);
    $('.close').click(function(){
        $('.mask').fadeOut(100);
        $('.collect').slideUp(200);
    });
    var address_id = $(obj).attr("title");
    alert(address_id);
    var per_name = $(".panel_li"+address_id).find(".addr-detail").children(".addr-name").text();
    var per_province = $(".panel_li"+address_id).find(".addr-info").children(".per_province").text();
    var per_city = $(".panel_li"+address_id).find(".per_city").text();
    var per_district = $(".panel_li"+address_id).find(".per_district").text();
    var per_address = $(".panel_li"+address_id).find(".per_address").text();
    var per_tel = $(".panel_li"+address_id).find(".addr-tel").text();
    var per_email = $(".panel_li"+address_id).find(".per_email").val(); 
    
    $(".vip_name").val(per_name);
    $(".vip_select1 option").each(function (){
        if($(this).text()==per_province){$(this).attr('selected',true); $(".vip_select1").change(); return false;}}
    );
    $(".vip_select2 option").each(function (){
	if($(this).text()==per_city){$(this).attr('selected',true); $(".vip_select2").change(); return false;}}
    );
    $(".vip_select3 option").each(function (){
	if($(this).text()==per_district){$(this).attr('selected',true); return false;}}
    );
    $(".vip_site").val(per_address);
    $(".vip_tel").val(per_tel);
    $(".vip_email").val(per_email);
    $(".edit_message").unbind().click(function(){
        if(!common_reg()){
            return false;
        }
        var vip2_name = $(".vip_name").val();
        var vip2_select1 = $(".vip_select1").val();
        var vip2_select1_text = $(".vip_select1").find("option:selected").text();
        var vip2_select2 = $(".vip_select2").val();
        var vip2_select2_text = $(".vip_select2").find("option:selected").text();
        var vip2_select3 = $(".vip_select3").val();
        var vip2_select3_text = $(".vip_select3").find("option:selected").text();
        var vip2_site = $(".vip_site").val();
        var vip2_tel = $(".vip_tel").val();
        var vip2_email = $(".vip_email").val();
        var service = {};  
        service.inter_num = "0050";   
        service.servicecode = "1006";
        service.address_id = address_id;
        service.consignee = vip2_name;//收货人
        service.country = "1";//国家（1）中国
        service.province = vip2_select1;//省
        service.city = vip2_select2;//市
        service.district = vip2_select3;//区
        service.address = vip2_site;//详细地址
        service.mobile = vip2_tel;//电话
        service.email = vip2_email;//邮箱
        service.type = "1";//编辑
        service = JSON.stringify(service);
        var send_url = rooturl + "/../webapi/index.php";
        apiSendAjax(send_url, service, true, function (status, data) {
            if(status == 0){
                $(".panel_li"+address_id).find(".addr-name").text(vip2_name);
                $(".panel_li"+address_id).find("span .addr-name").text(vip2_name);
                $(".panel_li"+address_id).find("span .per_province").text(vip2_select1_text);
                $(".panel_li"+address_id).find(".per_province").text(vip2_select1_text);
                $(".panel_li"+address_id).find(".per_address").text(vip2_site);
                $(".panel_li"+address_id).find(".per_city").text(vip2_select2_text);
                $(".panel_li"+address_id).find(".per_district").text(vip2_select3_text);
                $(".panel_li"+address_id).find(".per_address").text(vip2_site);
                $(".panel_li"+address_id).find(".addr-tel").text(vip2_tel);
                $(".panel_li"+address_id).find(".per_email").val(vip2_email);
                $('.mask').fadeOut(100);
                $('.collect').slideUp(200);
                console.log(data);
            } else {
                console.log(data);
            }
        });
    });
}
/*公共的表单验证*/
function common_reg(){
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
    
    return true;
}