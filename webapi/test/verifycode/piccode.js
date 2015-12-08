/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
//console.log("_ROOT_URL_:"+_ROOT_URL_);
document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");


//验证验证码函数
function checkcode(){
    var codeinfo = $("#codeinfo").val();
    var ret = checkPicCode(codeinfo);
    apiInterface(ret,function(status,data){
        if(status==0){
            $("#notice").attr('src','dui.png'); 
        }
        else{
            $("#notice").attr('src','warning.png'); 
        }
    })
}
$(function(){
    //页面加载，默认生成一个图片验证码
    getPicCode('piccode',35,4,0,1);
});
