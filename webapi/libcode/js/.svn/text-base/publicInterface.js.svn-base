

/*-------------------------------------------------------------------------------------------------------------- 
 * 该文件定义所有业务/产品开发可能引用的公共功能接口.
 * 
 */

 

/*
 --------------------------------------------------------------------------------------------------------------------- 
 * ajax提交
  */
function apiSendAjax(url, vars, async, callback) {
    return $.ajax({
        type : "POST",
        url : url,
        data : vars,
        async : async,//异步为true，同步false
        dataType : "json",
        success : function(data){
            callback(data.status,data);
        },
        error : function(xhr, type, exception){  
            console.log(xhr.status +"\n"+xhr.responseText);                   
            callback('-404',"error");
        }
    });
}
/*
 * @param {type} param      JSON格式的接口参数
 * @param {type} callback   回调函数 status 状态码，data JSON格式数据
 * @returns {undefined}
 */
function apiInterface(arg,callback)
{
    var url = _ROOT_URL_ + "index.php";
    apiSendAjax(url, arg, true, function(status, data) {
        //检查是否有单独的错误码，如果有，替换掉data.desc
        if(status!=0){ //失败
            var disdesc = _HTMLERRINFO_[data.status];
            if(disdesc){
                data.desc = disdesc;
            }
        }
        callback(status, data);
    });
} 

/*  判断用户当前位置是否在指定的区域范围内
 * @param {type} longitude 经度 116.474338;
 * @param {type} latitude  纬度  40.000726 ;
 * @returns {0  到达目的位置，1未到达目的位置，其他是百度的错误码}
 */
function apiIsPosition(longitude,latitude)
{
    apiGetLocalPosition(function(status,point){        
        if(status!==0){ 
              console.log("定位错误:"+status);
            return status;
           
        }
        var dstPoint = new BMap.Point(longitude, latitude);
        if(apiIsPointInCircle(point,dstPoint)===true){
            console.log("你到达目标位置");
            return 0;
        }
        console.log("你未到达目标位置");
        return 1;     
    });
}

/**
 *  文件上传（包括图片上传）
 * @param {type} serverurl        请求后台服务器接口
 * @param {type} localfilename    本地input框对应的name，id（相同）
 * @param {type} flag             文件是否为base64的形式上传，默认为false
 * @param {object} objectdata      对象类型数据，根据不同的业务所带参数不同，
 * 如 :  {service: "{"servicecode":"9003"}"}
 * 实现实例:    var objectdata = {};
                var objectdata = {'inter_num':'0030','servicecode':'9003'};
                objectdata.service = JSON.stringify(dealdata);
 * @param {type} callback         回调函数  status == "success" 为成功，status == "error" 为失败
 * @returns {undefined}
 */
function apiFileupload(localfilename, filebase64,objectdata,callback){ 
    objectdata.service.inter_num = '0030'; //默认接口号
    objectdata.service = JSON.stringify(objectdata.service);
    objectdata.filebase64 = filebase64.substr(filebase64.indexOf(',') + 1);
    var url = _ROOT_URL_+"index.php";
    $.ajaxFileUpload({
        url: url,
        type:'post',
        secureuri: false,
        fileElementId: localfilename,
        dataType: 'data',
        data: objectdata,
        success:function(data, status){             //status == success 成功
            callback(data, status);
        },
        error: function(data, status){              //status == error 失败
            //console.log(status);
            callback(data, status);
        }
    });
}

/* 生成验证码
 * @param {int} type 1:邮箱2:手机(联系方式类型)
 * @param {String} contact 联系方式
 * @returns JSON串
 */
function generalCode(type,contact){
    var message={
        "inter_num":"0009",
        "type":type,
        "contact":contact
    };
    return JSON.stringify(message);
}
/* 校验验证码
 * @param {String} code 验证码
 * @param {int} type 1:邮箱2:手机(联系方式类型)
 * @param {String} contact 联系方式
 * @returns JSON串
 */
function checkCode(code, type, contact){
    var message={
        "inter_num":"0010",
        "code":code,
        "type":type,
    	"contact":contact
    };
    return JSON.stringify(message);
}

/* 校验图片验证码
 * @param {String} code 验证码
 * @returns JSON串 
 *  选填项：（从左到右）
 * fontSize 验证码字体大小 
 * length： 验证码位数 
 * useNoise：是否添加杂点  
 * useCurve：是否画混淆曲线  
 */
function checkPicCode(code){
    var message={
        "inter_num":"0028",
        "code":code,
        'fontSize':arguments[1],
        'length':arguments[2],
        'useNoise':arguments[3],
        'useCurve':arguments[4]
    };
    return JSON.stringify(message);
}

/* 产生图片验证码
 * 注意：下面参数的默认值，在php接口里
 * 必填项：
 * imgid：需要产生验证码的图片id
 * 选填项：（从左到右）
 * fontSize 验证码字体大小 ，默认36
 * length： 验证码位数 ，默认4个字
 * useNoise：是否添加杂点  ，默认1
 * useCurve：是否画混淆曲线  ，默认0
 * @returns JSON串
 */
function getPicCode(imgid){
    var message={ 
        'fontSize':arguments[1],
        'length':arguments[2],
        'useNoise':arguments[3],
        'useCurve':arguments[4]
    };
    $("#"+imgid).attr('src',_ROOT_URL_+"verifycode/getCode.php?tm="+Math.random()+"&fontSize="+message['fontSize']
    +"&length="+message['length']+"&useNoise="+message['useNoise']+"&useCurve="+message['useCurve']) ;
}
/* 发送邮件
 * @param {String} 		to 			收件人的邮件地址
 * @param {String} 		host 		转发的邮件服务器
 * @param {String} 		username 	用户名
 * @param {String} 		password 	密码
 * @param {String} 		from 		发件人的邮件地址
 * @param {String} 		fromname 	发件人显示的名字
 * @param {String} 		subject  	邮件标题
 * @param {Json Array} 	attach 		附件的本地绝对路径数组
 * @param {Json Array} 	img	  		邮件中需要预览的图片的本地绝对路径数组 
 * @returns JSON串
 */
function sendemail(to,host,username,password,from,fromname,subject,body,attach,img){
    var message={
        "inter_num":"0029",
        "to":to,//"86185234@qq.com",
        "host":host,//"smtp.exmail.qq.com",
        "username":username,//"service@3brush.com",
        "password":password,//"3Brush21",
        "from":from,//"service@3brush.com",
        "fromname":fromname,//"三把刷子",
        "subject":subject,//subject"[三把刷子]感谢您注册101HR，请验证Email",
        "body":body,//"亲爱的用户，您好！</br>您在访问三把刷子时点击了忘记密码链接，这是一封密码重置确认邮件。<br/><span style='color:red;font-size:15px'>三把刷子 请在24小时内点击下面的链接重置帐户密码:http://127.0.0.1/agent/index.php/Home/Login/getpwd_check_email?code=32234234&to=86185234@qq.com如果以上链接无法点击，请将上面的地址复制到您的浏览器（如IE）的地址栏打开。本邮件由系统自动发出，请勿直接回复！如有疑问或建议，可发送邮件至hi@3brush.com，或致电4000-120-400。-三把刷子团队如果您并未尝试激活邮箱，忽略本邮件，由此给您带来的不便请谅解",
        "attach":attach,//["D:/phpStudy/WWW/web/mail/a.jpg","D:/phpStudy/WWW/web/mail/b.png"],
        "img":img//["D:/phpStudy/WWW/web/mail/a.jpg","D:/phpStudy/WWW/web/mail/b.png"]
    };
    return JSON.stringify(message);
}

/* 生成并发送短信验证码
 * @param 
 * 必填：
 * contact 手机号
 * repeatminutes 短信重发有效期  与页面上的按钮倒计时相同  比如：3分钟
 * 选填：
 * length 短信验证码长度，默认为6位，不可超过10位
 * deadminutes   短信验证码验证有效期，默认为30分钟
 * 
 * @returns JSON串
 */
function send_sms(contact,repeatminutes){    
    var length = arguments[2]&&arguments[2]!='undefined'&&arguments[2]<10?arguments[2]:6;
    var deadminutes = arguments[3]&&arguments[3]!='undefined'?arguments[3]:30;
    var message={
        "inter_num":"0027",
        "contact":contact,
        "length":length,
        "deadminutes":deadminutes,
        "repeatminutes":repeatminutes,
        "type":"2" //用于数据库区分，2为短信   
    };
    return JSON.stringify(message);
}
/* 修改密码
 * @param {String} account 帐号
 * @param {String} old_passwd 旧密码
 * @param {String} new_passwd 新密码
 * @returns JSON串
 */
function modifypwd(old_passwd,new_passwd){
    var message={
        "inter_num":"0003",
        "old_passwd":old_passwd,
        "new_passwd":new_passwd
    };
    return JSON.stringify(message);
}
/* 设置新密码
 * @param {String} contact 帐号，手机号或者邮箱
 * @param {String} passwd 新密码
 * @param {String} type 类型 1邮箱  2手机
 * @returns JSON串
 */
function set_newpwd(contact,passwd,type){
    var message={
        "inter_num":"0004",
         "contact":contact,
         "passwd":passwd,
         'type':type
    };
    return JSON.stringify(message);
}

/* 用户注册
 * @param {String} account 帐号，没有则传空，根据不同类型，产生不同的帐号
 * @param {String} passwd 密码
 * @param {String} email 邮箱，如果没有，传空
 * @param {String} tel 手机号，如果没有，传空
 * @param {String} type   1邮箱 2手机 3，QQ用户，4微信 5微博
 * @param {String} key_val 如果有其它需要存储的信息.可以以key-value的形势,传入. 如：constellation=capricorn,hometown=liaoning
 * @returns JSON串
 */
function userreg(account,passwd,email,tel,type,key_val){
    var newaccount ;
    if(!account){
        if(type=1){
            newaccount = email+"_"+Math.floor(Math.random()*10000);
        }else{
            newaccount = tel;
        }        
    }
    else{
        newaccount = account;
    }
    var message={
        "inter_num":"0011",//接口序号,固定不变.
        "account":newaccount,//帐号
        "pwd":passwd,//密码.
        "email":email,//邮件
        "tel":tel,//电话
        "type":type,//1邮箱 2手机 3，QQ用户，4微信 5微博
        "key_val":key_val //如果有其它需要存储的信息.可以以key-value的形势,传入.
    };
    return JSON.stringify(message);
}

/* 管理后台添加权限
 * @param {String} name 权限名
 * @param {int} value 权限值
 * @param {String} value 权限描述
 * @returns JSON串
 */
function authAdd(name,value,dsp){
    var message={
        "inter_num":"0014",
        "name":name,
        "value":value,
        "dsp":dsp
     };
     return JSON.stringify(message);
}
/* 管理后台删除权限
 * @param {int} value 权限值
 * @returns JSON串
 */
function authDel(value){
    var message={
       "inter_num":"0015",
        "value":value
    };
    return JSON.stringify(message);
}
/* 管理后台获取所有权限
 * @returns JSON串
 */
function getallAuth(){
    var message={
        "inter_num":"0023"
    };
    return JSON.stringify(message);
}
/* 管理后台获取所有角色
 * @returns JSON串
 */
function getallRole(){
    var message={
        "inter_num":"0022"
    };
    return JSON.stringify(message);
}
/* 管理后台根据角色获取权限
 * @param {int} code 角色值
 * @returns JSON串
 */
function getauthByrole(code){
    var message={
       "inter_num":"0024",
        "code":code
    };
    return JSON.stringify(message);
}
/* 管理后角色添加
 * @param {int} code 角色值
 * @param {String} name 角色名
 * @param {String} dsp 角色描述
 * @returns JSON串
 */
function roleAdd(code,name,dsp){
    var message={
       "inter_num":"0016",
        "code":code,
        "name":name,
        "dsp":dsp
    };
    return JSON.stringify(message);
}
/* 角色权限绑定
 * @param {String} code 角色值
 * @param {String} value 权限值
 * @returns JSON串
 */
function role_auth_bind(code,value){
	var message={
		 "inter_num":"0018",
		 "code":code,
		 "value":value
	};
	return JSON.stringify(message);
}
/* 角色权限解绑
 * @param {String} code 角色值
 * @param {String} value 权限值
 * @returns JSON串
 */
function role_auth_unbund(code,value){
	var message={
		"inter_num":"0019",
		"code":code,
		"value":value           
	};
	return JSON.stringify(message);
}
/* 角色删除
 * @param {String} code 角色值
 * @returns JSON串
 */
function role_del(code){
	var message={
		"inter_num":"0017",
		"code":code
	};
	return JSON.stringify(message);
}

/*客户端版本升级
 * @param {String} appid 应用id
 * @param {String} token 应用的token
 * @param {String} uuid 用户id
 * @param {String} os 操作系统(ios,android,wp)
 * @param {String} osver 操作系统版本号(ios,android,wp)
 * @param {String} model 机型
 * @param {String} network 网络类型(3g,2g,4g,wifi)
 * @param {String} model 机型
 * @param {String} area 区域,例如北京
 * @param {String} ver 当前版本号
 * @param {String} mac  机器网卡mac地址,STR,可能取不到或者取到的数据是重复的
 * @param {String} ip  本机地址,STR
 * @param {String} installtime  版本安装时间STR,有可能取不到 YYYYMMDDHHMMSS
 * @param {String} firstruntime 版本首次运行时间STR, YYYYMMDDHHMMSS
 * @returns JSON串
 */
function clt_info(appid,token,uuid,os,osver,ver,model,screen,network,area,mac,ip,installtime,firstruntime){
    var message={
        "inter_num": "0020",
        "appid": appid,//"cn.escene.epplus",
        "token": token,//"f32e3c5d3ef938555da5816e728aaa4b",
        "uuid":	uuid,//"123456789",
        "os": os,//"android",
        "osver":osver,// "8.1.2",
        "ver": ver,//"1.0.0",
        "model": model,//"iPhone",
        "screen": screen,//"640*960",
        "network": network,//"wifi",
        "area": area,//"北京" 
        'mac':mac,
        'ip':ip,
        'installtime': installtime,
        'firstruntime':firstruntime
     };
     return JSON.stringify(message);
}


/*
 * 在固定的按钮上面展示倒计时
 * 并且添加相应属性，置为不可点击
 * 必选项：
 * divid：标签id
 * second：倒计时开始时间,单位：秒
 * initcolor：倒计时结束,背景颜色（按钮起始颜色）
 * 可选项：
 * backcolor：背景色，倒计时开始，背景色，默认为灰色
 * buttontext：按钮文字，默认为‘发送验证码’
 */
function setMsgTimer(divid,second,initcolor){
    //如果没传背景色，默认为灰色
    var backcolor = arguments[3]&&arguments[3]!='undefined'?arguments[3]:'gray';
    var buttontext = arguments[4]&&arguments[4]!='undefined'?arguments[4]:'发送验证码';
    console.log(backcolor+'   '+buttontext)
    var jdivid = $("#"+divid);
    starttimer(jdivid,second,initcolor,backcolor,buttontext);
}
function starttimer(jdivid,validtime,initcolor,backcolor,buttontext){
     if (validtime === 0) {
        jdivid.attr("disabled",false);
        jdivid.text(buttontext);
        jdivid.css("background-color",initcolor);
    } else {
        jdivid.attr("disabled", true);
        jdivid.text(validtime+ "秒后再次获取") ;
        jdivid.css("background-color",backcolor);
        validtime--;
        setTimeout(function () {
            starttimer(jdivid,validtime,initcolor,backcolor,buttontext);
        }, 1000);
    }
}

/*
 * html2pdf
 * 参数：
 * dest:注意：这里定位到webapi/....，php需要拼接上物理目录,
 * d_filename：目的文件名
 * sourcehtmlfile：源html文件
 */
function html2pdf(dest,d_filename,sourcehtmlfile){
    var message={
            "inter_num":"0032",
            "dest":dest,
            "d_filename":d_filename,
            "sourcehtmlfile":sourcehtmlfile
    };
    return JSON.stringify(message);
}




/* 产生图片 
 * 字体：黑体
 * 北京：白色
 * 字色：黑色
 * 
 * 注意：下面参数的默认值，在php接口里
 * 必填项：
 * imgid：需要图片的id
 * 选填项：（从左到右）
 * str:需要生成在图片上的文字，无则生成空白的图片
 * imgwidth 宽 ，默认300
 * imgheigth：高，默认300
 * @returns JSON串
 */
function createPic(imgid){
    var message={ 
        'str':arguments[1],
        'imgwidth':arguments[2],
        'imgheigth':arguments[3]
    };
//    console.log(message);return;
    $("#"+imgid).attr('src',_ROOT_URL_+"createpic/createpictohtml.php?imgwidth="+
           message['imgwidth']+"&imgheigth="+message['imgheigth']+"&str="+message['str']) ;
}


/* 产生图片，在服务器本地保存
 * 字体：黑体
 * 北京：白色
 * 字色：黑色
 * 
 * 注意：下面参数的默认值，在php接口里
 * 选填项：（从左到右）
 * text:需要生成在图片上的文字，无则生成空白的图片
 * imgwidth 宽 ，默认300
 * imgheigth：高，默认300
 * @returns JSON串
 */
function createPicServer(){
    var message={ 
        'inter_num':'0040',
        'servicecode':'9004',
        'text':arguments[0],
        'imgwidth':arguments[1],
        'imgheigth':arguments[2]
    };
    return JSON.stringify(message);
}

/*
 * 密保绑定
 * * 必填：
 * contact 手机号或者邮箱
 * repeatminutes 短信、邮件重发有效期  与页面上的按钮倒计时相同  比如：3分钟
 * type 类型 1邮箱  2手机
 * callback:回调地址，邮箱必选，手机传空， 回调地址从项目根目录开始定位
 * * 选填：
 * length 短信验证码长度，默认为6位，不可超过10位
 * deadminutes   短信验证码验证有效期，默认为30分钟，如果是邮件，默认为24*60分钟  1天
 */
function securitybind(contact,repeatminutes,type,callback){
     var message={
            "inter_num":"0005",
            "contact":contact,
            "repeatminutes":repeatminutes,
            "type":type,
            "callback":callback,
            "length":arguments[4]&&arguments[4]!='undefined'?arguments[4]:'', //可以不传           
            "deadminutes":arguments[5]&&arguments[5]!='undefined'?arguments[5]:''//可以不传
    };
    return JSON.stringify(message);
}

/*
 * 密保绑定验证
 * * 必填：
 * contact 手机号或者邮箱
 * code 验证码
 * type 类型 1邮箱  2手机
 */
function securitybindcheck(contact,code,type){
     var message={
            "inter_num":"0006",
            "contact":contact,
            "code":code,
            "type":type
    };
    return JSON.stringify(message);
}

/*
 * 用户注册
 * account：帐号，可以是帐号、手机号、邮箱名
 * passwd：密码
 * key：想要获取的用户附加信息，多个用逗号分割，没有传空
 * rememberpwd：是否记住密码  0不记   1记住
 * second：如果记住密码，有效期  单位：秒
 */
function userlogin(account,passwd,key,rememberpwd,second){
         var message={
            "inter_num":"0026",
            "account":account,
            "passwd":passwd,
            "key":key,
            "rememberpwd":rememberpwd,
            "second":second
    };
    return JSON.stringify(message);
}

/*
 * 用户登出
 * inter_num = '0039';
 */
function userlogout(url){
    window.location.href=_ROOT_URL_+"index.php?inter_num=0039&url="+url;
}
/*
 * 密码找回
 * 必选：
 * concat：帐号，可以是 手机号、邮箱名
 * type：1邮箱  2手机
 * callback:回调地址，邮箱必选，手机传空， 回调地址从项目根目录开始定位
 * 可选：参数的缺省值在数据库中
 * length:验证码长度，默认6位，不要超过10位
 * deadminutes：验证码验证有效期
 * repeatminutes：验证码重发有效期
 */
function retrievepasswd(contact,type,callback){
         var message={
            "inter_num":"0007",
            "contact":contact,
            "type":type,
            "callback":callback,
            "length":arguments[3]&&arguments[3]!='undefined'?arguments[3]:'',
            "deadminutes":arguments[4]&&arguments[4]!='undefined'?arguments[4]:'',
            "repeatminutes":arguments[5]&&arguments[5]!='undefined'?arguments[5]:'',
    };
    return JSON.stringify(message);
}


/*
 * 密码找回,验证校验码
 * 必选：
 * concat：帐号，可以是 手机号、邮箱名
 * type：1邮箱  2手机
 * code:校验码 
 */
function rtpasswdcheck(contact,type,code){
         var message={
            "inter_num":"0008",
            "contact":contact,
            "type":type,
            "code":code
    };
    return JSON.stringify(message);
}


/*
 * 第三方登录
 * way：3QQ  4微信  5微博
 * state：1登录  2绑定
 */      
function thirdlogin(way, state)
{
    switch(way)
    {
    case "3": //qq
        window.location.href = (_ROOT_URL_+"login/qqlogin/example/qq_login/oauth/index.php?state="+state);//,"TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
      break;
    case "4": //未测试  微信
//       window.location.href =(_ROOT_UR+"?state="+state);
      break;
    case "5": //微博
       window.location.href =(_ROOT_URL_+"login/wblogin/login.php?state="+state);
      break;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
    default: 
        break;
    }
}   

/*
 * 检测url中对应key的value
 * url:url地址；规则：www.testlxd.com/testapi/test.html?a=1&b=2
 * key：key置
 */
function getvaluebykey(url,key){
    if(url){
        var urlarr = url.split('?');
        if(urlarr.length>1){
            var parments = urlarr[1];
            var pararr   = parments.split('&');
            for(var i = 0;i<pararr.length;i++){
                var valuearr = pararr[i].split("=");
                var vkey = valuearr[0];
                var value = valuearr[1];
                if(key==vkey){
                    return value;
                }
            }
            return 0;
        }
        else{
            return 0;
        }
    }
    else{
        return 0;
    }
   
}

/*
 * 获取订单号
 * type:支付类型1:支付宝.2网银
 */
function getordernum(type){
    var message = {
        "inter_num":"0001",//接口序号,固定不变.
        "type":type
    };
    return JSON.stringify(message);
}

/*
 * 更新订单号
 * ordernum:订单号
 * state：状态
 */
function getordernum(ordernum,state){
    var message = {
        "inter_num":"0002",//接口序号,固定不变.
        "ordernum":ordernum,
        "state":state
    };
    return JSON.stringify(message);
}


/*
 * 注册 激活邮件发送
 * 必选：
 * concat：帐号，邮箱名
 * callback:回调地址，回调地址从项目根目录开始定位
 * userid:用户标识
 * 可选：参数的缺省值在数据库中
 * length:验证码长度，默认6位，不要超过10位
 * deadminutes：验证码验证有效期
 * repeatminutes：验证码重发有效期
 */
function activeuser(contact,callback,userid){
         var message={
            "inter_num":"0037",
            "contact":contact,
            "callback":callback,
            "realuserid":userid,
            "length":arguments[3]&&arguments[3]!='undefined'?arguments[3]:'',
            "deadminutes":arguments[4]&&arguments[4]!='undefined'?arguments[4]:'',
            "repeatminutes":arguments[5]&&arguments[5]!='undefined'?arguments[5]:'',
    };
    return JSON.stringify(message);
}


/*
 * 邮箱注册，激活验证
 * 必选：
 * concat：帐号，可以是 手机号、邮箱名
 * code:校验码 
 * userid：用户userid
 */
function activeusercheck(contact,code,userid){
    var message = {
        "inter_num": "0038",
        "contact": contact,
        "code": code,
        "userid": userid,
        'type': 1
    };
    return JSON.stringify(message);
}

/*
 * 下载文件功能
 * fileurl:文件url路径，注意：这里是服务器绝对路径，非http路径
 * disname：展示的文件名，文件名+后缀名
 */
function downloadfile(fileurl,disname){
    window.location.href = (_ROOT_URL_+"downfile/downfile.class.php?fileurl="+fileurl+"&filename="+disname);
}

///*
// * 支付功能
// * order_no：订单号，没有传空（生成订单，接着支付），有则传（未支付订单列表进来）
// * paytype:支付类型 1：支付宝，2：支付宝网银支付，3：信用卡，4微信，5：网银支付
// * paybank：支付的银行简码，没有传空
// */
//function payorder(order_no,paytype,paybank){
//    var filename='';
//    switch (paytype) {
//        case 1: //支付宝
//            filename = 'pc_pay/alipay/alipayapi.php?order_no=' + order_no;
//            break;
//        case 2://支付宝网银
//            filename = 'pc_pay/alipaybank/alipayapi.php?order_no=' + order_no+"&WIDdefaultbank="+paybank;
//            break;
//        case 3://信用卡
//            break;
//        case 4://微信
//            filename = 'pc_pay/wxpay/index.php';
//            break;
//        case 5://普通网银
//            break;
//        default :
//            break;
//    }
//    window.open(_ROOT_URL_+"pay/"+filename);
//}

/*
 * 支付功能
 * order_no：订单号，没有传空（生成订单，接着支付），有则传（未支付订单列表进来）
 * channel:支付类型 alipay支付宝，alipaybank支付宝网银支付，wx微信
 * paybank：支付的银行简码，没有传空
 */
function payorder(order_no,channel,paybank){
//    var message = {
//        "inter_num": "0043",
//        "order_no": order_no,
//        "channel": channel,
//        "paybank": paybank
//    };
    window.open(_ROOT_URL_+"index.php?inter_num=0043&order_no="+order_no+
            "&channel="+channel+"&paybank="+paybank);
//    return JSON.stringify(message);
}
/*
 * 支付功能，模拟移动app支付
 * order_no：订单号，没有传空（生成订单，接着支付），有则传（未支付订单列表进来）
 * channel:支付类型 alipay支付宝，alipaybank支付宝网银支付，wx微信
 * paybank：支付的银行简码，没有传空
 */
function payorderapp(order_no,channel,paybank){
    var message = {
        "inter_num": "0044",
        "order_no": order_no,
        "channel": channel,
        "paybank": paybank
    };
    return JSON.stringify(message);
}
/*
 * 生成订单
 * goods:json数组格式，
 * amount:订单总价，单位：分
 */
function createorder(goods,amount){
    var message = {
        "inter_num": "0001",
        "goods": goods,
        "amount": amount
    };
    return JSON.stringify(message);
    
}

/*
 * 支付功能
 * 对账接口
 */
function checkorder(order_no,channel){
    var message = {
        "inter_num": "0045",
        "order_no": order_no,
        "channel": channel
    };
    return JSON.stringify(message);
}