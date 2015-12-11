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

/**
 * 用户购物车商品列表
 * @returns {undefined}
 */
function userCartCoodList(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1002";
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
 * 删除用户购物车商品
 * @returns {undefined}
 */
function deleteCartCoodList(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1003";
    service.goods_id = "2,3";
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
 * 用户购物车商品数量更改
 * @returns {undefined}
 */
function updateCartCoodNumber(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1004";
    service.goods_id = "2";
    service.goods_number = "12";
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
 * 地区联动展示
 * @returns {undefined}
 */
function districtShow(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1005";
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
 * 新增收货人地址
 * @returns {undefined}
 */
function addUserAddr(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1006";
    service.consignee = "永林";//收货人
    service.country = "1";//国家（1）中国
    service.province = "22";//省
    service.city = "297";//市
    service.district = "2453";//区
    service.address = "莱州市22";//详细地址
    service.mobile = "15001209007";//电话
    service.email = "15001209007@163.com";//邮箱
    service.type = "0";//新增
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
 * 编辑收货人地址
 * @returns {undefined}
 */
function editUserAddr(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1006";
    service.address_id = "5";
    service.consignee = "永林";//收货人
    service.country = "1";//国家（1）中国
    service.province = "22";//省
    service.city = "297";//市
    service.district = "2453";//区
    service.address = "莱州市22";//详细地址
    service.mobile = "15001209007";//电话
    service.email = "15001209007@163.com";//邮箱
    service.type = "1";//编辑
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
 * 删除收货人地址
 * @returns {undefined}
 */
function deleteUserAddr(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1007";
    service.address_id = "5";
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
 * 设置收货人地址
 * @returns {undefined}
 */
function setUserAddr(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1008";
    service.address_id = "3";
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
 * 订单信息展示
 * @returns {undefined}
 */
function showOrder(){
    var service = {};  
    service.inter_num = "0050";   
    service.servicecode = "1009";
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