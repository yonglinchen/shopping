/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");
 
 
 //绑定验证短信验证码的按钮
   function checkcode(){
        var name=$("#contact").val();
        var code = $("#code").val(); 
        var ret= checkCode(code,2,name);
         apiInterface(ret,function(status,data){
            console.log(data);
            if(status==0){
                $("#contact").next().text('成功');
            }
            else{
                $("#contact").next().text(data.desc);
            }
        });
   }
 
$(function(){
    //绑定两个事件
    $("#contact").bind({
        blur:function(){
            var name=$("#contact").val();
            if(!name){
                $("#contact").next().text("请输入手机号");
                return;
            }
            if(!apiIsTel(name)){
                $("#contact").next().text("手机号码有误");
                return;
            };
            $("#contact").next().empty();
        },
        focus:function(){
            $("#contact").next().empty();
        }
    })
            
   $("#sendmsg").bind('click',function(){
        var name=$("#contact").val();
        if(!name || !apiIsTel(name)){
             $("#contact").next().text('手机号码有误');
             return;
        }
        $("#contact").next().empty();
        //调用发送短信的接口
        var ret = send_sms(name,3);
        apiInterface(ret,function(status,data){
            console.log(data);
            var datadata = data.data;
            if(status==0){
                //设置定时器
                $("#contact").next().text("验证码已发送，为："+datadata[0].code)
                setMsgTimer('sendmsg',180,'blue');
            }
            else{
                $("#contact").next().text(data.desc+",重发还剩："+datadata[0].leftsecond+"s")
            }
        })
   })
   
   
});
