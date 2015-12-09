/**
 * 展示商品信息
 * @returns {undefined}
 */
function showGoodsInfo(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1000";
    service = JSON.stringify(service);
    
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            console.log(data);
            $("#jsonRecode").html("success!" + "<br/>"); 
            $("#jsonRecode").html(JSON.stringify(data));
        } else {
            console.log(data);
            $("#jsonRecode").html("error!" + "<br/>"); 
            $("#jsonRecode").html(JSON.stringify(data));
        }
    });  
}

/**
 * 商品添加到购物车
 * @returns {undefined}
 */
function addToCart(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1001";
    service.goods_id = "1";
    service.user_id = "1";
    service.goods_number = "1";
    service.rec_type = "0";
    service = JSON.stringify(service);
    
    var send_url = rooturl + "/../webapi/index.php";
    apiSendAjax(send_url, service, true, function (status, data) {
        if(status == 0){
            console.log(data);
            $("#jsonRecode").html("success!" + "<br/>"); 
            $("#jsonRecode").html(JSON.stringify(data));
        } else {
            console.log(data);
            $("#jsonRecode").html("error!" + "<br/>"); 
            $("#jsonRecode").html(JSON.stringify(data));
        }
    });  
}

