document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");
/**
 * 
 * 文件上传实例
 */
$(function(){
    $('#uploadfile').on('change', function (event) {
        $(".info-tip-dialog").show();
        var localfilename = "uploadfile";
        var filebase64 = "null";
        var jsondata = {};
        var dealdata = {'servicecode':'9003'};
        jsondata.service = dealdata;

        apiFileupload(localfilename, filebase64, jsondata, function(data, status){
            $(".info-tip-dialog").hide();
            console.log(data);
            data = JSON.parse(data);
            if(status == "success"){//服务器请求成功
                $(".upload-display").html("");
                $(".upload-display").append('<img src="'+ data.out_data.url +'" realsrc="'+data.out_data.realurl+'">');
            } else {//服务器请求失败
               console.log("页面接口访问服务器君出错!");
            }
        });
    });
});

function downfile(){
//    console.log(1)
    var fileurl  = $(".upload-display img").attr('realsrc');
    var filearr = fileurl.split('.');
    var count = filearr.length;
    var filetype = filearr[count-1];
    var filename = '测试.'+filetype;
    downloadfile(fileurl,filename);return;
    
}
