/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
//console.log("_ROOT_URL_:"+_ROOT_URL_);
document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");
 
 function checktel(){
    var tel = $("#tel").val();
     if(!tel || !apiIsTel(tel)){
         $("#tel").next().text('手机格式有误');
         return;
     }
      $("#tel").next().text('');
    var code = $("#code").val();
    var ret = rtpasswdcheck(tel,2,code);
     apiInterface(ret,function(status,data){
           if(status==0){ 
                $("#sendmsg").next().text('验证成功');
                $(".updatepwd").show();
           }
           else{
                $("#sendmsg").next().text(data.desc);
           }
       })
 }
 
 //更改密码
 function updatepasswd(){
     $("#updatepasswd").next().text('');
       var passwd = $("#passwd1").val();
        if(!passwd || passwd.length<6 || passwd.length>16){
           $("#passwd1").next().text('密码长度有误');
           return;
       }
        $("#passwd1").next().text('');
        var passwdangin = $("#passwd2").val();
        if( !passwdangin ||  passwdangin.length<6 || passwdangin.length>16){
           $("#passwd2").next().text('密码长度有误');
           return;
       }
       if(passwd!=passwdangin){
            $("#passwd2").next().text('密码不匹配');
           return;
       }
       $("#passwd2").next().text('');
       var tel = $("#tel").val();
        var ret = set_newpwd(tel,hex_md5(passwd),2);
        apiInterface(ret,function(status,data){
           if(status==0){ 
                $("#updatepasswd").next().text('更改成功');
           }
           else{
                $("#updatepasswd").next().text(data.desc);
           }
       })
 }
 
 function sendemal(){
     $("#sendemal").next().text('');
     $("#email").next().text('');
       var email = $("#email").val();
        if(!email || !apiCheckMail(email)){
           $("#email").next().text('邮箱格式有误');
           return;
       }
       var ret = retrievepasswd (email,1,'test/retrivepasswd/rtpasswdcheck.html');
       apiInterface(ret,function(status,data){
           if(status==0){
               setMsgTimer('sendemal',180,'gray');
               $("#sendemal").next().text('发送成功，查看邮箱');
           }
           else{
               $("#sendemal").next().text(data.desc);
           }
       })
 }
 
 
 
 
$(function(){
    //绑定两个事件
   $("#sendmsg").bind('click',function(){
       $("#sendmsg").next().text('');
        $(".updatepwd").hide();
       var tel = $("#tel").val();
       if(!tel || !apiIsTel(tel)){
           $("#tel").next().text('手机格式有误');
           return;
       }
        $("#tel").next().text('');
       var ret = retrievepasswd(tel,2,'');
       apiInterface(ret,function(status,data){
           if(status==0){
               var data0 = data.data[0];
               setMsgTimer('sendmsg',180,'gray');
               $("#sendmsg").next().text('发送成功，验证码为：'+data0.code);
           }
           else{
               var msg='';
               if(data.status==1002){
                   msg = ',下次生成剩余时间：'+data.data[0].leftsecond+"s";
               }
               $("#sendmsg").next().text(data.desc+msg);
           }
       })
   })
   
   //登录
   $("#logsendmsg").bind('click',function(){
        $("#logsendmsg").next().text('');
       var account = $("#logaccount").val();
       if(account.length<5 || account.length>20){
           $("#logaccount").next().text('用户名长度有误');
           return;
       }
        $("#logaccount").next().text('');
       var passwd = $("#logpasswd").val();
        if(!passwd || passwd.length<6 || passwd.length>16){
           $("#logpasswd").next().text('密码长度有误');
           return;
       }
       $("#logpasswd").next().text('');
       var ret = userlogin(account,hex_md5(passwd),'key1');
       console.log(ret);
       apiInterface(ret,function(status,data){
           if(status==0){
               $("#logsendmsg").next().text('登录成功');
           }
           else{
               $("#logsendmsg").next().text(data.desc);
           }
       })
   })
   
   
   
});
