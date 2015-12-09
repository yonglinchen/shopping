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
            //alert(data.data[0].images[0].good_img);
            $(".dginfo_h2").text(data.data[0].goods_name);
            $(".dginfo_weight").text(data.data[0].goods_weight);
            $(".shop_price").text(data.data[0].shop_price);
            $(".market_price").text(data.data[0].market_price);
            $(".goodnum").val(data.data[0].goods_number);
            
            $(".default_img").attr("src","images/"+data.data[0].images[0].good_img);
                $(".default_img").attr("jqimg","images/"+data.data[0].images[0].good_img);
            var imgList = data.data[0].images;
            for(var _i = 0;_i<imgList.length;_i++){
                //alert(data.data[0].images[_i].good_img);
                $(".list-h").css("width","310px");
                $(".list-h").append('<li><img src="images/'+data.data[0].images[_i].good_img+'" style="border: 1px solid rgb(204, 204, 204); padding: 2px;" /></li>');
            }
           
        } else {
            console.log(data);            
        }
    });  
});

