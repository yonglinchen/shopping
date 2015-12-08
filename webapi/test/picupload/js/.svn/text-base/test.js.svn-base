document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");
$(function(){
	var options = {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: './images/avatar.png'
	}
	var cropper = $('.imageBox').cropbox(options);
	$('#uploadfile').on('change', function(){//上传图片
            $(".info-tip-dialog").show();
            
            if( navigator.userAgent.indexOf("MSIE")>0 && 
                (navigator.userAgent.indexOf("MSIE 6.0") > 0 
                || navigator.userAgent.indexOf("MSIE 7.0") > 0 
                ||navigator.userAgent.indexOf("MSIE 8.0") > 0 
                || navigator.userAgent.indexOf("MSIE 9.0") > 0) ) {//ie浏览器 6 7 8 9
                
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
                        $(".imageBox").css({"background-image": "url("+data.out_data.url+")"},{"background-size": "500px 500px"}
                            ,{"background-position": "-50px -50px"},{"background-repeat": "no-repeat"});

                        options.imgSrc = data.out_data.url;
                        cropper = $('.imageBox').cropbox(options);
                    } else {//服务器请求失败
                       console.log("页面接口访问服务器君出错!");
                    }
                }); 
            } else {//html5浏览器
                var reader = new FileReader();
                reader.onload = function(e) {
                        options.imgSrc = e.target.result;
                        cropper = $('.imageBox').cropbox(options);
                }
                reader.readAsDataURL(this.files[0]);
                this.files = [];
            }
            $(".info-tip-dialog").hide();
	})
	$('#btnCrop').on('click', function(){
		var img = cropper.getDataURL();
		$('.cropped').html('');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>\n\
                    <input type="button" class="cutingsure" onclick="handlefile();" value="确定"/>');
	})
	$('#btnZoomIn').on('click', function(){
		cropper.zoomIn();
	})
	$('#btnZoomOut').on('click', function(){
		cropper.zoomOut();
	});
});


function handlefile() {
    $(".info-tip-dialog").show();
    
    var localfilename = "uploadfile";
    var filebase64 = $(".cropped>img").attr("src");
    var jsondata = {};
    var dealdata = {'servicecode':'9003', 'filebase64' : filebase64.substr(filebase64.indexOf(',') + 1)};
    jsondata.service = dealdata;
    
    apiFileupload(localfilename, filebase64, jsondata, function(data, status){
        $(".info-tip-dialog").hide();
        data = JSON.parse(data);
        console.log(data);
        if(status == "success"){//服务器请求成功
            $(".upload-display").html("");
            $(".upload-display").append('<img src="'+ data.out_data.url +'">');
        } else {//服务器请求失败
           console.log("页面接口访问服务器君出错!");
        }
    });
}

