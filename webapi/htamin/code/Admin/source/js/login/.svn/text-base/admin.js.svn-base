//获取所有角色
function getall_role() {
    var account = $("#inputUsername").val();
    var passwd =$("#inputPassword").val();
    var rememberpwd = 0;
    var ret = getallRole(account, hex_md5(passwd), 'key1', rememberpwd, 7 * 86400);
    apiInterface(ret, function (status, data) {
        if (status == 0) {
            location = "admin.php";
        }
        else {
            ui_alert(data['desc'], function () {
            });
        }
    });
}


