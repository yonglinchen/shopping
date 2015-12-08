/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//console.log("_ROOT_URL_:"+_ROOT_URL_);
document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");

 function logout(){
    userlogout('http://www.baidu.com');
 }
 
$(function(){
    //绑定两个事件
   $("#sendmsg").bind('click',function(){
       $("#sendmsg").next().text('');
       var account = $("#account").val();
       if(account.length<5 || account.length>20){
           $("#account").next().text('用户名长度有误');
           return;
       }
        $("#account").next().text('');
       var passwd = $("#passwd").val();
        if(!passwd || passwd.length<6 || passwd.length>16){
           $("#passwd").next().text('密码长度有误');
           return;
       }
        $("#passwd").next().text('');
        var passwdangin = $("#passwdangin").val();
        if( !passwdangin ||  passwdangin.length<6 || passwdangin.length>16){
           $("#passwdangin").next().text('密码长度有误');
           return;
       }
       if(passwd!=passwdangin){
           $("#passwdangin").next().text('两次密码不相同');
           return;
       }
       $("#passwdangin").next().text('');
       var tel = $("#tel").val(); 
       if(!apiIsTel(tel)){
             $("#tel").next().text('手机号有误');
           return;
       }
       $("#tel").next().text('');
       var ret = userreg(account, hex_md5(passwd),'',tel,2,'');
       apiInterface(ret,function(status,data){
           if(status==0){
               $("#sendmsg").next().text('注册成功');
           }
           else{
               $("#sendmsg").next().text(data.desc);
           }
       })
   })
     //绑定邮箱注册
   $("#sendmail").bind('click',function(){
       $("#sendmail").next().text('');
       var account = $("#accountmail").val();
       if(account&&(account.length<5 || account.length>20)){
           $("#accountmail").next().text('用户名长度有误');
           return;
       }
        $("#accountmail").next().text('');
       var passwd = $("#passwdmail").val();
        if(!passwd || passwd.length<6 || passwd.length>16){
           $("#passwdmail").next().text('密码长度有误');
           return;
       }
        $("#passwdmail").next().text('');
        var passwdangin = $("#passwdanginmail").val();
        if( !passwdangin ||  passwdangin.length<6 || passwdangin.length>16){
           $("#passwdanginmail").next().text('密码长度有误');
           return;
       }
       if(passwd!=passwdangin){
           $("#passwdanginmail").next().text('两次密码不相同');
           return;
       }
       $("#passwdanginmail").next().text('');
       var mail = $("#mail").val(); 
       if(!apiCheckMail(mail)){
             $("#mail").next().text('邮箱格式有误');
           return;
       }
       $("#mail").next().text('');
       var ret = userreg(account,hex_md5(passwd),mail,'',1,'');
       apiInterface(ret,function(status,data){
           if(status==0){
               var outdata = data.out_data;
               var userid = outdata.userid;
               var ret2 = activeuser(mail,'test/userreg/activeusercheck.html',userid);//发送验证邮件
               apiInterface(ret2,function(status2,data2){
                   if(status2==0){
                        $("#sendmail").next().text('注册邮件已发送，请进入邮箱激活');
                   }
                   else{
                       $("#sendmail").next().text('邮件发送失败');
                   }
                   
               });
           }
           else{
               $("#sendmail").next().text(data.desc);
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
       var rememberpwd = document.getElementById('rememberpwd').checked;
       var ret = userlogin(account,hex_md5(passwd),'key1',rememberpwd,7*86400);
//       console.log(ret);return;
       apiInterface(ret,function(status,data){
           if(status==0){
               $("#logsendmsg").next().text('登录成功');
           }
           else{
               $("#logsendmsg").next().text(data.desc);
           }
       })
   })
   
   //修改密码
   $("#mfsendmsg").bind('click',function(){
        $("#mfsendmsg").next().text('');
       var passwd = $("#mfpasswd1").val();
        if(!passwd || passwd.length<6 || passwd.length>16){
           $("#mfpasswd1").next().text('密码长度有误');
           return;
       }
        $("#mfpasswd1").next().text('');
        var passwdangin = $("#mfpasswd2").val();
        if( !passwdangin ||  passwdangin.length<6 || passwdangin.length>16){
           $("#mfpasswd2").next().text('密码长度有误');
           return;
       }
       $("#mfpasswd2").next().text('');
        var ret = modifypwd (hex_md5(passwd),hex_md5(passwdangin));
       console.log(ret);
       apiInterface(ret,function(status,data){
           console.log(data)
           if(status==0){
               $("#mfsendmsg").next().text('更改成功');
           }
           else{
               $("#mfsendmsg").next().text(data.desc);
           }
       })
   })
   
});
