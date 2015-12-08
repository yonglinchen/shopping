//登录

function login() {
    var account = $("#inputUsername").val();
    var passwd =$("#inputPassword").val();
    var rememberpwd = 0;
    var ret = userlogin(account, hex_md5(passwd), 'key1', rememberpwd, 7 * 86400);
    apiInterface(ret, function (status, data) {
        if (status == 0) {
            location = "../user/userManage.php";
        }
        else {
            ui_alert(data['desc'], function () {
            });
        }
    });
}


