/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
document.write("<script type='text/javascript' src='" + _ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");
var url = window.location.href;
var mark = '';
var email = '';
var userid = '';

$(function() {
    mark = getvaluebykey(url, 'mark');
    email = getvaluebykey(url, 'email');
    userid = getvaluebykey(url, 'userid');
    var ret = rtpasswdcheck(email, 1, mark);
    apiInterface(ret, function(status, data) {
        console.log(data);
        if (status == 0) {
            $("#wrong").text('验证成功，请设置密码');
            $(".updatepwd").show();
        }
        else {
            $("#wrong").text(data.desc);
        }
    });

    $("#updatepasswd").bind('click',function(){
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
        var ret = set_newpwd(email,passwd,1);
        apiInterface(ret,function(status,data){
           if(status==0){ 
                $("#updatepasswd").next().text('更改成功');
           }
           else{
                $("#updatepasswd").next().text(data.desc);
           }
       })
    })
    
});
