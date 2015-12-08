$(function () {
    $(".jqzoom").jqueryzoom({
        xzoom: 400,
        yzoom: 400,
        offset: 10,
        position: "right",
        preload: 1,
        lens: 1
    });

    $("#spec-list").jdMarquee({
        deriction: "left",
        width: 371,
        height: 56,
        step: 2,
        speed: 4,
        delay: 10,
        control: true,
        _front: "#spec-right",
        _back: "#spec-left"
    });
    $("#spec-list img").bind("mouseover", function () {
        var src = $(this).attr("src");
        $("#spec-n1 img").eq(0).attr({
            src: src.replace("\/n5\/", "\/n1\/"),
            jqimg: src.replace("\/n5\/", "\/n0\/")
        });
        $(this).css({
            "border": "2px solid #ff6600",
            "padding": "1px"
        });
    }).bind("mouseout", function () {
        $(this).css({
            "border": "1px solid #ccc",
            "padding": "2px"
        });
    });
})

function addToCart(){
    var send_url = rooturl+"/code/dealCartFlow.php";
    var arrList={"action":"addToCart", "goodId":1, "userId":1};//业务测试
    arrList = JSON.stringify(arrList);
    apiSendAjax(send_url, arrList, true,function(status,data) {
        console.log(data);
        if(parseInt(status) == 0){
            window.location.href=rooturl + "/flow/addToCart.html";
        } else{
            window.location.href=rooturl + "/flow/errorToCart.html";
        }
    });   
}