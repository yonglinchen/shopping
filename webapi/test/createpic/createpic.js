/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
document.write("<script type='text/javascript' src='" + _ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");

$(function() {
    //绑定两个事件
    $("#sendmsg").bind('click', function() {
        var value = $("#inputtext").val();
        createPic('destimg', value);
    })
    $("#sendmsgserver").bind('click', function() {
        $("#sendmsgserver").next().text('');
        var value = $("#inputtextserver").val();
//        console.log(value);return;
        var ret =  createPicServer( value,100,100);
        apiInterface(ret,function(status,data){
            if(status==0){
                $("#sendmsgserver").next().text(data.fileurl);
            }
            else{
                $("#sendmsgserver").next().text(data.desc);
            }
        })
        
    })


});
