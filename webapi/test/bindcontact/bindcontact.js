/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
document.write("<script type='text/javascript' src='" + _ROOT_URL_ + "libcode/js/serviceInterface.js'></script>");

/*
 * 绑定验证短信验证码的按钮
 */
function checktel() {
    var name = $("#tel").val();
    var code = $("#code").val();
    var ret = securitybindcheck(name, code, 2);
    apiInterface(ret, function(status, data) {
        console.log(data);
        if (status == 0) {
            $("#tel").next().text('成功');
        }
        else {
            $("#tel").next().text(data.desc);
        }
    });
}
/*
 * 发送邮件
 */
function sendmail() {
    var name = $("#email").val();
    console.log(name);
    if (!name || !apiCheckMail(name)) {
        $("#email").next().text("邮箱格式有误");
        return;
    }
    //调用发送短信的接口
    var ret = securitybind(name, 3, 1, 'test/bindcontact/bindcheck.html');
    apiInterface(ret, function(status, data) {
        console.log(data);
        var datadata = data.data;
        if (status == 0) {

        }
        else {
            console.log(data.desc)
            var info = data.status == 1002 ? (",重发还剩：" + datadata[0].leftsecond + "s") : '';
            $("#tel").next().text(data.desc + info);
        }
    })

}

$(function() {
    //绑定两个事件
    $("#tel").bind({
        blur: function() {
            var name = $("#tel").val();
            if (!name) {
                $("#tel").next().text("请输入手机号");
                return;
            }
            if (!apiIsTel(name)) {
                $("#tel").next().text("手机号码有误");
                return;
            }
            ;
            $("#tel").next().empty();
        },
        focus: function() {
            $("#tel").next().empty();
        }
    })

    //绑定两个事件
    $("#email").bind({
        blur: function() {
            var name = $("#email").val();
            if (!name) {
                $("#email").next().text("请输入邮箱");
                return;
            }
            if (!apiCheckMail(name)) {
                $("#email").next().text("邮箱格式有误");
                return;
            }
            ;
            $("#email").next().empty();
        },
        focus: function() {
            $("#email").next().empty();
        }
    })

    $("#sendmsg").bind('click', function() {
        var name = $("#tel").val();
        if (!name || !apiIsTel(name)) {
            $("#tel").next().text('手机号码有误');
            return;
        }
        $("#tel").next().empty();
        //调用发送短信的接口
        var ret = securitybind(name, 3, 2, '');
        apiInterface(ret, function(status, data) {
            console.log(data);
            var datadata = data.data;
            if (status == 0) {
                //设置定时器
                $("#tel").next().text("验证码已发送，为：" + datadata[0].code)
                setMsgTimer('sendmsg', 3 * 60, 'blue');
            }
            else {
                console.log(data.desc)
                var info = data.status == 1002 ? (",重发还剩：" + datadata[0].leftsecond + "s") : '';
                $("#tel").next().text(data.desc + info);
            }
        })
    })


});
