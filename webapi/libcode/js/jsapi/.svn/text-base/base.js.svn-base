
/**  JS 中调试信息 强制要求 使用 console.log 函数
 * 如果调试需要console.log输出调试信息,关闭 所有 typeof console.log 的定义, 这种方式适合PC 版本调试
 * 如果调试需要alert弹筐,请把如下代码放开, 这种方式适合手机版开发调试
if('function' === typeof console.log){
	console.log = function(param){
            alert(param);
        };
}
 * 发布版本 关闭日志调试日志时 ,把下面的代码放开
if('function' === typeof console.log){
	console.log = function(){
        };
}

// 下属定义适用 alert弹筐 提示调试信息
if('function' === typeof console.log){
	console.log = function(param){
            alert(param);
        };
}
*/

/**
 * 获取 web 根目录地址 
 * @returns {unresolved}
 */
function getOrigin(){
    var pathName = window.document.location.pathname.toLowerCase();
    var location = window.document.location+"";
    location = location.toLowerCase();
    pathName = pathName.substr(0,pathName.indexOf("/",2)+1);
    location = location.split(pathName)[0]+pathName;
    console.log("_ROOT_URL_:"+location);
    return location;
 }
 // _ROOT_URL_ 如: http://www.songshuzizhao.com/webapi/
 var _ROOT_URL_ =getOrigin();

/*
 * 获取文件的当前路劲
 */
function getCurrPath(){
    var location = window.document.location+"";
    var pos = location.lastIndexOf("/");
    location = location.substr(0,pos+1);
    console.log("getCurrPath:"+location);
    return location;
}

/**
 * json对象转字符串形式
 */
function apiJson2str(o) {
    var arr = [];
    var fmt = function(s) {
        if (typeof s == 'object' && s != null)
            return apiJson2str(s);
        return /^(string|number)$/.test(typeof s) ? "'" + s + "'" : s;
    }
    for (var i in o)
        arr.push("'" + i + "':" + fmt(o[i]));
    return '{' + arr.join(',') + '}';
}


/**产生随机数
 * @param {type} Min  随机数最小值
 * @param {type} Max 随机数最大值
 * @returns {Number}
 */
function apiRandomNum(Min,Max)
{   
    var Range = Max - Min;   
    var Rand = Math.random();   
    return(Min + Math.round(Rand * Range));   
}   

/**
 *  产生随机字符串 
 * @param {type} length  随机字符串的长度
 * @returns {String}
 */
function apiRandomNonceStr(length){
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var maxPos = chars.length;
    var str = '';
    for (i = 0; i < length; i++) {
        str += chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return str;
}

/**
 *  产生10位时间戳 函数 
 * @returns {String}
 */
function apiTimestamp(){
    var now = new Date();
    var timestamp =now.getMonth()+""+now.getDay()+""+now.getHours()+""+now.getMinutes()+""+now.getMilliseconds();
    return timestamp;
}
/*
功能: 判断是否有滚动条
参数: param 0 表示垂直滚动条判断，1  表示水平滚动条判断
 */

function apiIsScroll(param)
{
   if(param==0){
        if (document.documentElement.clientHeight < document.documentElement.offsetHeight-4){
             return true;
        }
        return false ;
    }
    else{
        if (document.documentElement.clientWidth < document.documentElement.offsetWidth-4){
            return true;
        }
        return false;
    }
}

/**
 * 浏览器窗口发生改变事件
 * @param  callback 回调函数定义成 function()，具体的实现具体的业务来实现
 * @returns {void}
 * 
 */
function apiOnSize(callback)
{
   window.onresize =function(){
       callback();
    } 
}

/*
 * 判断输入字符串是否符合手机号规范
 * str： 手机号
 */
function apiIsTel(str) {  
    if(str==""){
        return false;
    }
    if( ! /^1[3|5|7|8][0-9](\d{8})$/.test(str) ) {  
       return false;
    }
    return true;
} 

/*
 * 判断输入字符串是否为邮箱
 * mail： 字符串
 */
function apiCheckMail(mail) {
    if(mail==""){
        return false;
    }
    if( ! /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(mail) ) {  
       return false;
    }
    return true;
}
/**
 * 银行卡号合法性校验
 * Luhn检验数字算法（Luhn Check Digit Algorithm），也叫做模数10公式，是一种简单的算法，用于验证银行卡、信用卡号码的有效性的算法
 * Luhm校验规则：16位银行卡号（19位通用）:
 * 
 * 1.将去除最后一位校验位的 15（或18）位卡号从右依次编号 1 到 15（18），位于奇数位号上的数字乘以 2。
 * 2.将奇位乘积的个十位全部相加，再加上所有偶数位上的数字。
 * 3.将加法和加上校验位能被 10 整除。
 * 
 * @param {type} bankno 银行卡号
 * @returns {Boolean}  true 合法卡号  false  非法卡号
 */
function apiIdentityBankcard(bankno){
    if(bankno==""){
        return false; 
    }else{      
        if (bankno.length < 16 || bankno.length > 19) {
            return false;
        }
        var num = /^\d*$/;  //全数字
        if (!num.exec(bankno)) {
            return false;
        }
        //开头6位
        var strBin="10,18,30,35,37,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,58,60,62,65,68,69,84,87,88,94,95,98,99";    
        if (strBin.indexOf(bankno.substring(0, 2))== -1) {
            return false;
        }
        var lastNum=bankno.substr(bankno.length-1,1);//取出最后一位（与luhm进行比较）
    
        var first15Num=bankno.substr(0,bankno.length-1);//前15或18位
        var newArr=new Array();
        for(var i=first15Num.length-1;i>-1;i--){    //前15或18位倒序存进数组
            newArr.push(first15Num.substr(i,1));
        }
        var arrJiShu=new Array();  //奇数位*2的积 <9
        var arrJiShu2=new Array(); //奇数位*2的积 >9
        
        var arrOuShu=new Array();  //偶数位数组
        for(var j=0;j<newArr.length;j++){
            if((j+1)%2==1){//奇数位
                if(parseInt(newArr[j])*2<9)
                arrJiShu.push(parseInt(newArr[j])*2);
                else
                arrJiShu2.push(parseInt(newArr[j])*2);
            }
            else //偶数位
            arrOuShu.push(newArr[j]);
        }
        
        var jishu_child1=new Array();//奇数位*2 >9 的分割之后的数组个位数
        var jishu_child2=new Array();//奇数位*2 >9 的分割之后的数组十位数
        for(var h=0;h<arrJiShu2.length;h++){
            jishu_child1.push(parseInt(arrJiShu2[h])%10);
            jishu_child2.push(parseInt(arrJiShu2[h])/10);
        }        
        
        var sumJiShu=0; //奇数位*2 < 9 的数组之和
        var sumOuShu=0; //偶数位数组之和
        var sumJiShuChild1=0; //奇数位*2 >9 的分割之后的数组个位数之和
        var sumJiShuChild2=0; //奇数位*2 >9 的分割之后的数组十位数之和
        var sumTotal=0;
        for(var m=0;m<arrJiShu.length;m++){
            sumJiShu=sumJiShu+parseInt(arrJiShu[m]);
        }
        
        for(var n=0;n<arrOuShu.length;n++){
            sumOuShu=sumOuShu+parseInt(arrOuShu[n]);
        }
        
        for(var p=0;p<jishu_child1.length;p++){
            sumJiShuChild1=sumJiShuChild1+parseInt(jishu_child1[p]);
            sumJiShuChild2=sumJiShuChild2+parseInt(jishu_child2[p]);
        }      
        //计算总和
        sumTotal=parseInt(sumJiShu)+parseInt(sumOuShu)+parseInt(sumJiShuChild1)+parseInt(sumJiShuChild2);
        
        //计算Luhm值
        var k= parseInt(sumTotal)%10==0?10:parseInt(sumTotal)%10;        
        var luhm= 10-k;
        
        if(lastNum==luhm && lastNum.length != 0){
            return true;
        }
        else{
            return false;
        }        
    }
    return true;
}
/*
 * 根据邮箱名，检测邮箱服务器
 * 如果匹配不出来，则返回空
 */
function gethttpbyemail(emailmsg) {
    var arr = emailmsg.split("@");
    var arrhttp = arr[1];
    var httpmsg = '';
    switch (arrhttp) {
    case '126.com':
        httpmsg = 'http://www.126.com/';
        break;
    case '163.com':
        httpmsg = 'http://mail.163.com/';
        break;
    case 'qq.com':
        httpmsg = 'https://mail.qq.com/';
        break;
    case 'sina.cn':
        httpmsg = 'http://mail.sina.com.cn/';
        break;
    case 'sohu.com':
        httpmsg = 'http://mail.sohu.com/';
        break;
    case 'outlook.com':
    case 'hotmail.com':
        httpmsg = 'http://windows.microsoft.com/zh-cn/hotmail/home';
        break;
    case 'gmail.com':
        httpmsg = 'http://mail.google.com/';
        break;
    case '@yahoo.com':
    case '@yahoo.com.cn':
        httpmsg = 'https://cn.overview.mail.yahoo.com/';
        break;
    case '@21cn.com':
        httpmsg = 'http://mail.21cn.com/w2/';
        break;
    case '@tom.com':
        httpmsg = 'http://web.mail.tom.com/webmail/login/index.action';
        break;
    case '@etang.com':
        httpmsg = 'http://mail.etang.com/login.htm';
        break;
    case '@eyou.com':
        httpmsg = 'http://www.eyou.com/';
        break;
    case '@56.com':
        httpmsg = 'http://www.56.com/logout.html';
        break;
    case '@x.cn':
        httpmsg = 'http://mail.x.cn/aiwmWeb/mail/login.action';
        break;
    case '@chinaren.com':
        httpmsg = 'http://mail.chinaren.com/';
        break;
    case '@sogou.com':
        httpmsg = 'http://mail.sogou.com/';
        break;
    case '@inbox.com':
        httpmsg = 'http://www.inbox.com/';
        break;
    case '@msn.com':
        httpmsg = 'https://login.live.com/';
        break;
    default:
        httpmsg = '';
        break;
    }
    return httpmsg;
}
/**
 * 邮箱合法性校验
 * @param {type} mail
 * @returns {Boolean}
 */
function apiIdentityMail(mail) {
    if (mail == "") {
        return false;
    }
    if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(mail)) {
        return false;
    }
    return true;
}

/**
 * 身份证号合法性验证
 * 
 * 支持15位和18位身份证号   支持地址编码、出生日期、校验位验证
 * 
根据〖中华人民共和国国家标准 GB 11643-1999〗中有关公民身份号码的规定，公民身份号码是特征组合码，由十七位数字本体码和一位数字校验码组成。排列顺序从左至右依次为：六位数字地址码，八位数字出生日期码，三位数字顺序码和一位数字校验码。
    地址码表示编码对象常住户口所在县(市、旗、区)的行政区划代码。
    出生日期码表示编码对象出生的年、月、日，其中年份用四位数字表示，年、月、日之间不用分隔符。
    顺序码表示同一地址码所标识的区域范围内，对同年、月、日出生的人员编定的顺序号。顺序码的奇数分给男性，偶数分给女性。
    校验码是根据前面十七位数字码，按照ISO 7064:1983.MOD 11-2校验码计算出来的检验码。

出生日期计算方法。
    15位的身份证编码首先把出生年扩展为4位，简单的就是增加一个19或18,这样就包含了所有1800-1999年出生的人;
    2000年后出生的肯定都是18位的了没有这个烦恼，至于1800年前出生的,那啥那时应该还没身份证号这个东东，⊙﹏⊙b汗...
下面是正则表达式:
 出生日期1800-2099  (18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])
 身份证正则表达式 /^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i            
 15位校验规则 6位地址编码+6位出生日期+3位顺序号
 18位校验规则 6位地址编码+8位出生日期+3位顺序号+1位校验位
 
 校验位规则     公式:∑(ai×Wi)(mod 11)……………………………………(1)
                公式(1)中： 
                i----表示号码字符从由至左包括校验码在内的位置序号； 
                ai----表示第i位置上的号码字符值； 
                Wi----示第i位置上的加权因子，其数值依据公式Wi=2^(n-1）(mod 11)计算得出。
                i 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1
                Wi 7 9 10 5 8 4 2 1 6 3 7 9 10 5 8 4 2 1

 * @param {type} code
 * @returns {Boolean}
 */
function apiIdentityCardno(code) { 
    var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
    var tip = "";
    var pass= true;
    if(!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)){
        tip = "身份证号格式错误";
        pass = false;
    }
    else if(!city[code.substr(0,2)]){
        tip = "地址编码错误";
        pass = false;
    }
    else{
        //18位身份证需要验证最后一位校验位
        if(code.length == 18){
            code = code.split('');
            //∑(ai×Wi)(mod 11)
            //加权因子
            var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
            //校验位
            var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
            var sum = 0;
            var ai = 0;
            var wi = 0;
            for (var i = 0; i < 17; i++)
            {
                ai = code[i];
                wi = factor[i];
                sum += ai * wi;
            }
            var last = parity[sum % 11];
            if(parity[sum % 11] != code[17]){
                tip = "校验位错误";
                pass =false;
            }
        }
    }
    if(!pass) alert(tip);
    return pass;
}

/**
 * 验证中文姓名
 * @param {type} realname
 * @returns {Boolean}
 */
function apiIdentityRealname(realname){
    if(!(/^[\u4e00-\u9fa5]{2,4}$/).test(realname)){
        return false;
    } else {
        return true;
    }
}
/**
 * 根据日期返回星期
 * @param {type} dateStr    日期字符串 格式为:YYYY-MM-DD h:m:s 2008-08-08 08:08:08
 * @returns {星期}
 */
function getWeekDay(dateStr){
    var weekDay = ["星期天", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
    //var dateStr = "2008-08-08 08:08:08"
    var myDate = new Date(Date.parse(dateStr.replace(/-/g, "/"))); 
    return weekDay[myDate.getDay()];
}