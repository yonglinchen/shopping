$(function(){
    //添加收货人地址
    $(".save").click(function(){
    $('.mask').fadeOut(100);
    $('.collect').slideUp(200);
    $("#consignee-list").append('<li class="ui-switchable-panel ui-switchable-panel-selected" selected="selected"><div class="consignee-item"><span limit="3">姬单单 北京</span><b></b></div><div class="addr-detail"><span class="addr-name" limit="6" title="姬单单">姬单单</span><span class="addr-info" limit="45">北京 朝阳区 四环到五环之间 北京市朝阳区望京福码大厦A座18层</span><span class="addr-tel">132****7353</span></div><div class="op-btns"><a href="javascript:;" class="ftx-05 setdefault-consignee hide">设为默认地址</a><a href="javascript:;" class="ftx-05 edit-consignee onclick="use_NewConsignee()"">编辑</a><a href="javascript:;" class="ftx-05 del-consignee hide">删除</a></div></li>')
    });
    //设置默认地址背景颜色以及文字显示与隐藏
    $(".op-btns").hide();
    $(".ui-switchable-panel").mousemove(function(){
        $(this).addClass("li_hover");
        $(this).find(".op-btns").show();
        if($(this).find(".consignee-item").hasClass("item-selected")){
            $(this).find(".op-btns .setdefault-consignee").html("");
        }else{
            $(this).find(".op-btns .setdefault-consignee").html("设置默认地址");
        }
    });
    $(".ui-switchable-panel").mouseout(function(){
        $(this).removeClass("li_hover");
        $(this).find(".op-btns").hide();
    });
	
    //收货人信息 
    $(".consignee-item").click(function(){
        if($(this).hasClass("item-selected")){
            //$(this).siblings(".op-btns").find(".setdefault-consignee").html("");
        }else{
            $(this).parent("li").siblings(".ui-switchable-panel").find("div").removeClass("item-selected");
            $(this).addClass("item-selected");
            $(this).siblings(".op-btns").find(".setdefault-consignee").html("");
        }
    });	
	
    //点击设置默认地址
    $(".setdefault-consignee").click(function(){
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
    $(".del-consignee").click(function(){
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
function use_NewConsignee(){	
    $('.mask').fadeIn(100);      //弹出窗口
    $('.popover_3').slideDown(200);
    $('.close').click(function(){
        $('.mask').fadeOut(100);
        $('.collect').slideUp(200);
    });
}
