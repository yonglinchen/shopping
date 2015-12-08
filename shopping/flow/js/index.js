/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1000";
    service = JSON.stringify(service);
    
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            $(".dginfo_h2").text(data.data[0].goods_name);
            $(".dginfo_weight").text(data.data[0].goods_weight);
            $(".shop_price").text(data.data[0].shop_price);
            $(".market_price").text(data.data[0].market_price);
            $(".goodnum").val(data.data[0].goods_number);
        } else {
            console.log(data);            
        }
    });  
});

