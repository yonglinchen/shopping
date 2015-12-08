//var webroot = "http://123.57.174.232/interface_ceshi/";
var webroot = "http://123.57.174.232/interface/";
(function () {
    U = {
        F2S: function (func) {
            return "" + func;
        },
        S2F: function (funcstr) {
            return eval("f=" + funcstr);
        },
        S2J: function (s) {
            return eval('(' + s + ')');
        },
        getUrlVars: function () {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        },
        getUrlVar: function (name) {
            return U.getUrlVars()[name];
        },
        equalFunction: function (fn1, fn2) {//对比两个函数是否完全相等
            var type1 = typeof (fn1), type2 = typeof (fn2);
            if (type1 !== type2 || type1 !== 'function') {
                return false;
            }
            if (fn1 === fn2) {
                return true;
            }
            var reg = /^function[\s]*?([\w]*?)\([^\)]*?\){/;
            var str1 = fn1.toString().replace(reg, function ($, $1) {
                return $.replace($1, "");
            });
            var str2 = fn2.toString().replace(reg, function ($, $1) {
                return $.replace($1, "");
            });
  //          console.log(str1, str2);
            if (str1 !== str2) {
                return false;
            }
            return true;
        },
        randomString: function (len) {
            len = len || 32;
            var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
            var maxPos = $chars.length;
            var pwd = '';
            for (i = 0; i < len; i++) {
                pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
            }
            return pwd;
        },
        currDateTime: function () {
            var date = new Date();
            var time = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + (date.getMinutes() < 10 ? ('0' + date.getMinutes()) : date.getMinutes()) + ":" + (date.getSeconds() < 10 ? ('0' + date.getSeconds()) : date.getSeconds());
            return time;
        },
        currTime: function () {
            var date = new Date();
            var time = date.getHours() + ':' + (date.getMinutes() < 10 ? ('0' + date.getMinutes()) : date.getMinutes());
            return time;
        },
        getOS: function () {
            var browser = {
                versions: function () {
                    var u = navigator.userAgent, app = navigator.appVersion;
                    return {
                        trident: u.indexOf('Trident') > -1, //IE内核
                        presto: u.indexOf('Presto') > -1, //opera内核
                        webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                        gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                        mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/), //是否为移动终端
                        ios: !!u.match(/(i[^;]+\;(U;)? CPU.+Mac OS X)/), //ios终端
                        android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                        iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                        iPad: u.indexOf('iPad') > -1, //是否iPad
                        webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                    };
                }(),
                language: (navigator.browserLanguage || navigator.language).toLowerCase()
            }
            if (browser.versions.android) {
                return "Android";
            } else if (browser.versions.iPhone) {
                return "iPhone";
            } else if (browser.versions.iPad) {
                return "iPad";
            } else {
                return "Web";
            }
        }
    };
})();

function initShareSdk(){
    // init sdk sharesdk申请的应用id
    if(U.getOS() == "Android"){
        $sharesdk.open("9c933175d944", true);
        // set platform config
        var wxConf = {};
        wxConf["app_key"] = "wxa5489488e6eab766";
        wxConf["app_secret"] = "63f09ddb3b17f4191a7ae694264e2b80";
        wxConf["BypassApproval"] = "false";
        wxConf["Enable"] = "true";

        $sharesdk.setPlatformConfig($sharesdk.platformID.WeChatSession, wxConf);
        $sharesdk.setPlatformConfig($sharesdk.platformID.WeChatTimeline, wxConf);
        //$sharesdk.setPlatformConfig($sharesdk.platformID.WeChatFav, wxConf);
    } else {
        $sharesdk.open("9c93881237ec", true);
        // set platform config
        var wxConf = {};
        wxConf["app_key"] = "wxa5489488e6eab766";
        wxConf["app_secret"] = "63f09ddb3b17f4191a7ae694264e2b80";
        //wxConf["BypassApproval"] = "true";
        wxConf["Enable"] = "true";

        $sharesdk.setPlatformConfig($sharesdk.platformID.WeChatSession, wxConf);
        $sharesdk.setPlatformConfig($sharesdk.platformID.WeChatTimeline, wxConf);
        //$sharesdk.setPlatformConfig($sharesdk.platformID.WeChatFav, wxConf);
    } 
}

function shareWeChatUrl(imageUrl){
    if(imageUrl.indexOf("http://")<0){
        imageUrl = "http://" + imageUrl;
    }
    isShareWeChat = false; 
    if(U.getOS() == "Android"){
        var params = {
            "text" : "",
            "imageUrl" : imageUrl,
            "title" : "测试的标题",
            "titleUrl" : "http://www.yonglinchen.com:54321/mission/module/task/index.html",
            "description" : "测试的描述",
            "site" : "蜜食",
            "siteUrl" : "http://www.yonglinchen.com:54321/mission/module/task/index.html",
            "type" : 1
        };

        //    android调用接口    
        var isSSO = true;
        //$sharesdk.shareContent($sharesdk.platformID.WeChatTimeline, params, isSSO, function (platform, state, shareInfo, error) {
		$sharesdk.showShareView($sharesdk.platformID.WeChatTimeline, params, function (platform, state, shareInfo, error) {
            switch(state){
             case 0:
                $(".info-tip-dialog").hide();
                $(".goto-btn").removeClass("grey");
                $(".error_tip").html(error.error_msg);
                $(".error_dialog").show(); 
                break;
              case 1:
                gotoTask();
                break;
              case 2:
                $(".info-tip-dialog").hide();
                $(".goto-btn").removeClass("grey");
                $(".error_tip").html(error.error_msg);
                $(".error_dialog").show(); 
                break;
              case 3:
                $(".info-tip-dialog").hide();
                $(".goto-btn").removeClass("grey");
                $(".error_tip").html("必须把任务分享到您的朋友圈，否则无法抢任务！");
                $(".error_dialog").show();   
                break;
              default:
                $(".info-tip-dialog").hide();
                $(".goto-btn").removeClass("grey");
                $(".error_tip").html(error.error_msg);
                $(".error_dialog").show(); 
            }
        });
    }else {
        var params = {
        "text" : "",
        "imageUrl" : imageUrl,
        "title" : "测试的标题",
        "titleUrl" : "http://www.yonglinchen.com:54321/mission/module/task/index.html",
        "description" : "测试的描述",
        "site" : "蜜食",
        "siteUrl" : "http://www.yonglinchen.com:54321/mission/module/task/index.html",
        "type" : 1
    };
     
//    ios调用接口
      $sharesdk.shareContent($sharesdk.platformID.WeChatTimeline, params, function (platform, state, shareInfo, error) {
        switch(state){
         case 0:
            $(".info-tip-dialog").hide();
            $(".goto-btn").removeClass("grey");
            $(".error_tip").html(error.error_msg);
            $(".error_dialog").show(); 
            break;
          case 1:
            gotoTask();
            break;
          case 2:
            $(".info-tip-dialog").hide();
            $(".goto-btn").removeClass("grey");
            $(".error_tip").html(error.error_msg);
            $(".error_dialog").show(); 
            break;
          case 3:
            $(".info-tip-dialog").hide();
            $(".goto-btn").removeClass("grey");
            $(".error_tip").html("一定要分享到朋友圈才能抢夺任务哦！");
            $(".error_dialog").show();   
            break;
          default:
            $(".info-tip-dialog").hide();
            $(".goto-btn").removeClass("grey");
            $(".error_tip").html(error.error_msg);
            $(".error_dialog").show(); 
        }
    });
    }
}


/** HTML5判断设备在线离线及监听网络状态变化 **/
$(function(){
    $("body").append('<div class="broken-net-tip">网络未打开，请检查网络情况</div>');
    if(navigator.onLine){
        //网络-在线
        $(".offnet").hide();
        $(".onlinenet").show();
    } else {
        $(".broken-net-tip").show();
        setTimeout(setTimeout('$(".broken-net-tip").fadeOut(1000);',2000));
        //不是个人中心，其他页面需要展示断网提示页面
        var curentUrl = window.location + "";
        if(curentUrl.indexOf("module/personCenter/")<0){
            $(".offnet").show();
            $(".onlinenet").hide();
        }
    }
    
    window.addEventListener("online",online,false);

    function online(){
        //网络-在线
        $(".offnet").hide();
        $(".onlinenet").show();
        window.location.reload();
    }
    
    window.addEventListener("offline",offline,false);
    
    function offline(){$(".broken-net-tip").show(); setTimeout(setTimeout('$(".broken-net-tip").fadeOut(1000);',2000));}
});

/**
 * ios 解决没有安装微信苹果商店审核不通过处理
 * 
 * 当且仅当ios方式，并且为测试版本
 */
function iosNotInstallWechat(){
    var isNeedDeal = false; 
    if(U.getOS() != "Android"){
        var get_is_test_var = get_is_test_ver();
        if(parseInt(get_is_test_var) == 1){
            isNeedDeal = true;
        }   
    }
    
    return isNeedDeal;
}

/**
 * 用户token方式登录
 * @param {type} user
 * @returns {undefined}
 */
function userTokenLogin(){
    var cur_token = get_device_token();
    //用户token方式登录
    var userLogin = {};
    userLogin.inter_num = "1041";
    userLogin.openid = "";
    userLogin.nick = "";
    userLogin.headurl = "";
    userLogin.token = cur_token;
    console.log(userLogin.token);
    userLogin = JSON.stringify(userLogin);

    apiSendAjax(webroot+"index.php",userLogin,true,
        function(data){
            $(".info-tip-dialog").hide();
            if(data.status == 0){
                set_nav_cookie("openid", "");//设置用户的openId
                set_nav_cookie("userId", data.data[0].userid);//设置用户的userId 
                set_nav_cookie("nick", data.data[0].nick);//设置用户的昵称
                
                //用户行为处理
                customDeal();
            } else {
                $(".error_tip").html("查看页面失败");
                $(".error_dialog").show(); 
            }
        },function(data){
            if(data.status==0){
            }
        }
    ); 
}

/**
 * ios加入异常账户切换处理
 * @returns {undefined}
 */
function catchDeal(){
    if(U.getOS() != "Android"){//ios加入异常账户切换处理
        if(iosNotInstallWechat()){
            var var_openid = get_nav_cookie("openid");
            if(var_openid != "" && var_openid != null 
                    && get_nav_cookie("userId") != ""){//第一次切换
                delCookie("openid");//删除用户的openId
                delCookie("userId");//删除用户的userId
                delCookie("nick");//删除用户的nick
            }
        }else {
            if(get_nav_cookie("openid") == ""  && get_nav_cookie("userId") != ""){//清除cookie
                delCookie("openid");//删除用户的openId
                delCookie("userId");//删除用户的userId
                delCookie("nick");//删除用户的nick
                
                window.location.href  = "../login.html";
            }   
        }
    }
}
/**
 * 断网刷新
 * @returns {undefined}
 */
function offnetFlash(){
    //有网返回上一级，没网刷新
    if(navigator.onLine){
        //网络-在线
        window.location.reload();
    } else {
        $(".broken-net-tip").show(); setTimeout(setTimeout('$(".broken-net-tip").fadeOut(1000);',2000));
    }
}
