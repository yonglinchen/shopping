/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
document.write("<script type='text/javascript' src='" + _ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");


$(function() {
    var url = window.location.href;
    var mark = getvaluebykey(url, 'mark');
    var email = getvaluebykey(url, 'email');
    var userid = getvaluebykey(url, 'userid');
    var ret = securitybindcheck(email, mark, 1);
    apiInterface(ret, function(status, data) {
        console.log(data);
        if (status == 0) {
            $(".wrongcss").text('成功');
        }
        else {
            $(".wrongcss").text(data.desc);
        }
    });


});
