
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1002";
    service = JSON.stringify(service);
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            var num_ = 0;
            var price_ = 0;
            for(var i = 0;i<data.data.length;i++){
                $('#cart-list').append('\
                    <div class="cart-item-list cart-item-list'+data.data[i].goods_id+'" id="cart-item-list-01">\n\
                        <div class="cart-tbody" id="vender_74726">\n\
                            <div class="item-list">\n\
                                <div class="item-single  item-item item-selected " class="product">\n\
                                    <div class="item-form">\n\
                                        <div class="cell p-checkbox">\n\
                                            <div class="cart-checkbox">\n\
                                                <input p-type="1211545593_1" type="checkbox" checked="checked" remove_ids="'+data.data[i].goods_id+'" name="checkItem" value="1211545593_1" data-bind="cbid" class="jdcheckbox" clstag="clickcart|keycount|xincart|cart_checkOn_sku">\n\
                                                <label  class="checked">勾选商品</label>\n\
                                                <span class="line-circle"></span>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="cell p-goods">\n\
                                            <div class="goods-item">\n\
                                                <div class="p-img">\n\
                                                    <a href="http://item.jd.com/1211545593.html" target="_blank">\n\
                                                        <img alt="" src="images/'+data.data[i].good_img+'">\n\
                                                    </a>\n\
                                                </div>\n\
                                                <div class="item-msg">\n\
                                                    <div class="p-name">\n\
                                                        <a href="http://item.jd.com/1211545593.html" target="_blank">'+data.data[i].goods_name+'</a>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="cell p-props p-props-new"></div>\n\
                                        <div class="cell p-price p-price_00">\n\
                                            <strong class="goods_number">'+data.data[i].goods_price+'</strong>\n\
                                        </div>\n\
                                        <div class="cell p-quantity">\n\
                                            <div class="quantity-form">\n\
                                                <a href="javascript:void(0);" class="decrement" ids="'+data.data[i].goods_id+'"  id="decrement'+data.data[i].goods_id+'">-</a>\n\
                                                <input type="text" class="itxt" readonly value="'+data.data[i].goods_number+'" id="changeNum'+data.data[i].goods_id+'" />\n\
                                                <a href="javascript:void(0);" class="increment" ids="'+data.data[i].goods_id+'" id="increment'+data.data[i].goods_id+'">+</a>\n\
                                            </div>\n\
                                            <div class="ac ftx-03 quantity-txt">有货</div>\n\
                                        </div>\n\
                                        <div class="cell p-sum">\n\
                                            <strong class="strongNum'+data.data[i].goods_id+'">'+(data.data[i].goods_number*data.data[i].goods_price).toFixed(2)+'</strong>\n\
                                        </div>\n\
                                        <div class="cell p-ops">\n\
                                            <a class="remove" remove_ids="'+data.data[i].goods_id+'" data-name="惠齿h2ofloss hf-7C标准型冲牙器家用电动洗..." data-more="removed_199.00_1" class="cart-remove" href="javascript:void(0);">删除</a>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="item-line"></div>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                    </div>');
                var num_ = num_+ parseInt(data.data[i].goods_number);
                var price_ = price_+ parseFloat($(".strongNum"+data.data[i].goods_id).text());
            }
            $(".amount-sum_em").text(num_);
            $(".sumPrice_em").text(price_.toFixed(2));
            //增加商品数
            $(".increment").live("click", function() {
                $(this).parent().parent().siblings(".p-checkbox").find("input[name='checkItem']").attr({checked:"checked"});
                    
                var goods_number = parseFloat($(this).parent().parent().siblings(".p-price_00").find(".goods_number").text());//单价
                var ids = $(this).attr("ids");
                var itxtVal = parseInt($(this).siblings(".itxt").val());//数量
                var itxtVal_1 = itxtVal+1;
                var num_1 = parseInt($(".amount-sum_em").text())+1;
                var price_1 = parseFloat($(".sumPrice_em").text())+goods_number;
                var service = {};  
                service.inter_num = "0050";   
                service.servicecode = "1004";
                service.goods_id = ids;
                service.goods_number = itxtVal_1;
                service = JSON.stringify(service);
                var send_url = rooturl + "/../webapi/index.php";
                apiSendAjax(send_url, service, true, function (status, data) {
                    if(status == 0){
                        $("#changeNum"+ids).val(itxtVal_1);
                        $(".strongNum"+ids).text((itxtVal_1*goods_number).toFixed(2));
                        $(".amount-sum_em").text(num_1);
                        $(".sumPrice_em").text(price_1.toFixed(2));
                    } else { }
                }); 
            })
            //减少商品数
            $(".decrement").live("click", function() {
                $(this).parent().parent().siblings(".p-checkbox").find("input[name='checkItem']").attr({checked:"checked"});
                var goods_number = parseFloat($(this).parent().parent().siblings(".p-price_00").find(".goods_number").text());//单价
                var ids = $(this).attr("ids");
                var itxtVal = parseInt($(this).siblings(".itxt").val());//数量
                if(itxtVal==1){
                    $("#changeNum"+ids).attr("disabled","disabled");//数量不小于1
                    return false; 
                };
                $("#changeNum"+ids).val(itxtVal-1);
                var num_1 = parseInt($(".amount-sum_em").text())-1;
                var price_1 = parseFloat($(".sumPrice_em").text())-goods_number;
                var service = {};  
                service.inter_num = "0050";   
                service.servicecode = "1004";
                service.goods_id = ids;
                service.goods_number = itxtVal-1;
                service = JSON.stringify(service);
                var send_url = rooturl + "/../webapi/index.php";
                apiSendAjax(send_url, service, true, function (status, data) {
                    if(status == 0){
                        $(".strongNum"+ids).text(((itxtVal-1)*goods_number).toFixed(2));
                        $(".amount-sum_em").text(num_1);
                        $(".sumPrice_em").text(price_1.toFixed(2));
                        //alert(123);
                        //$('.cart-warp').load();
                        //alert(123);
                    } else { }
                }); 
            });
            //删除商品
            $(".remove").live("click",function(){
                var remove_ids = $(this).attr("remove_ids");
                var text_0 = parseInt($(".amount-sum_em").text());
                var text_1 = $(this).parent().siblings(".p-quantity").find(".itxt").val();
                var text_2 = $(this).parent().siblings(".p-sum").find(".strongNum"+remove_ids).text();
                var text_4 = parseFloat($(".sumPrice_em").text()).toFixed(2);
                $(this).parents(".cart-item-list"+remove_ids).remove();
                $(".amount-sum_em").text(text_0 - text_1);
                $(".sumPrice_em").text((text_4 - text_2).toFixed(2));
                var service = {};  
                service.inter_num = "0050";   
                service.servicecode = "1003";
                service.goods_id = remove_ids;
                service = JSON.stringify(service);
                var send_url = rooturl + "/../webapi/index.php";
                apiSendAjax(send_url, service, true, function (status, data) {
                    if(status == 0){
                        //console.log(data);
                    } else { }
                }); 
            });
            //删除选中的商品
            $(".remove-batch").on("click",function(){
                $("input[name='checkItem']:checked").each(function(){
                    var remove_ids = $(this).attr("remove_ids");
                    $(this).parents(".cart-item-list").remove();
                    var service = {};  
                    service.inter_num = "0050";   
                    service.servicecode = "1003";
                    service.goods_id = remove_ids;
                    service = JSON.stringify(service);
                    var send_url = rooturl + "/../webapi/index.php";
                    apiSendAjax(send_url, service, true, function (status, data) {
                        if(status == 0){
                            window.location.reload();
                        } else { }
                    }); 
                })
            });
        }  else { }
    }); 
    //全选按钮的操作
    $("#toggle-checkboxes_up,#toggle-checkboxes_down").on("click",function(){
        this.checked?$("input[type='checkbox']").each(function(){this.checked=true;}):$("input[type='checkbox']").each(function(){this.checked=false;});
    });
    //勾选按钮的操作
    $("input[name='checkItem']").live("click",function(){
        var text_0 = parseInt($(".amount-sum_em").text());
        var text_1 = parseFloat($(".sumPrice_em").text());
        var text_2 = parseFloat($(this).parent().parent().siblings(".p-sum").find("strong").text());
        var text_3 = parseInt($(this).parent().parent().siblings(".p-quantity").find(".itxt").val());
        if($(this).attr("checked")== null){
            $(".amount-sum_em").text(text_0 - text_3);
            $(".sumPrice_em").text((text_1 - text_2).toFixed(2));
        }else{
            $(".amount-sum_em").text(text_0 + text_3);
            $(".sumPrice_em").text(parseFloat(text_1 + text_2).toFixed(2));
        }
        $("#toggle-checkboxes_up,#toggle-checkboxes_down").removeAttr("checked");
        //window.location.reload();
    }); 
    //结算链接   
    $(".submit-btn").on("click",function(){
        window.location.href= "getOrderInfo.html";
    });