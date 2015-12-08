
/* 分享接口
 * 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
 * @param {String} stitle    标题，如：互联网之子
 * @param {String} sdesc     描述，如:在长大的过程中，我才慢慢发现，我身边的所有事
 * @param {String} slink     连接地址， 如:http://movie.douban.com/subject/25785114/
 * @param {String} simgUrl   图片URL， 如 http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status,res)
 *   status : 0 已分享
 *            1 用户点击发送给朋友
 *            2 已取消
 *            3 分享失败
 */
function apiMenuShareAppMessage(stitle,sdesc,slink,simgUrl,callback)
{ 
  
    wx.onMenuShareAppMessage({
    title:stitle,
    desc: sdesc ,
    link: slink,
    imgUrl:simgUrl,
    trigger: function (res) {
        //不要尝试在trigger中使用ajax异步请求修改本次分享的内容，
        //因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        callback(1,res);
    },
    success: function (res) {
        callback(0,res);
    },
    cancel: function (res) {
        callback(2,res);
    },
    fail: function (res) {
        console.log("apiMenuShareAppMessage:"+JSON.stringify(res));
        callback(3,res);
    }
  });
}
  
/* 分享接口
 * 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
 * @param {String} stitle    标题，如：互联网之子
 * @param {String} slink     连接地址， 如:http://movie.douban.com/subject/25785114/
 * @param {String} simgUrl   图片URL， 如 http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status,res)
 *   status : 0 已分享
 *            1 用户点击分享到朋友圈
 *            2 已取消
 *            3 分享失败
 */
function apiMenuShareTimeline(stitle,slink,simgUrl,callback)
{
    wx.onMenuShareTimeline({
    title:stitle,
    link: slink,
    imgUrl:simgUrl,
    trigger: function (res) {
        callback(1,res);
    },
    success: function (res) {
        callback(0,res);
    },
    cancel: function (res) {
        callback(2,res);
    },
    fail: function (res) {
        console.log("apiMenuShareTimeline:"+JSON.stringify(res));
        callback(3,res);
    }
  });
}
  
/* 分享接口
 * 2.3 监听“分享到QQ”按钮点击、自定义分享内容及分享结果接口
 * @param {String} stitle    标题，如：互联网之子
 * @param {String} sdesc     描述，如:在长大的过程中，我才慢慢发现，我身边的所有事
 * @param {String} slink     连接地址， 如:http://movie.douban.com/subject/25785114/
 * @param {String} simgUrl   图片URL， 如 http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status,res)
 *   status : 0 已分享
 *            1 用户点击分享到QQ
 *            2 已取消
 *            3 分享失败
 */
function apiMenuShareQQ(stitle,sdesc,slink,simgUrl,callback)
{
    wx.onMenuShareQQ({
    title:stitle,
    desc: sdesc ,
    link: slink,
    imgUrl:simgUrl,
    trigger: function (res) {
        callback(1,res);
    },
    success: function (res) {
        callback(0,res);
    },
    cancel: function (res) {
        callback(2,res);
    },
    fail: function (res) {
        console.log("apiMenuShareAppMessage:"+JSON.stringify(res));
        callback(3,res);
    }
  });
}
  
 /* 分享接口
 *  2.4 监听“分享到微博”按钮点击、自定义分享内容及分享结果接口
 * @param {String} stitle    标题，如：互联网之子
 * @param {String} sdesc     描述，如:在长大的过程中，我才慢慢发现，我身边的所有事
 * @param {String} slink     连接地址， 如:http://movie.douban.com/subject/25785114/
 * @param {String} simgUrl   图片URL， 如 http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status,res)
 *   status : 0 已分享
 *            1 用户点击分享到微博
 *            2 已取消
 *            3 分享失败
 */
function apiMenuShareWeibo(stitle,sdesc,slink,simgUrl,callback)
{
    wx.onMenuShareWeibo({
    title:stitle,
    desc: sdesc ,
    link: slink,
    imgUrl:simgUrl,
    trigger: function (res) {
        callback(1,res);
    },
    success: function (res) {
        callback(0,res);
    },
    cancel: function (res) {
        callback(2,res);
    },
    fail: function (res) {
        console.log("apiMenuShareWeibo:"+JSON.stringify(res));
        callback(3,res);
    }
  });
}


 /* 分享接口
 *  2.5 监听“分享到QZone”按钮点击、自定义分享内容及分享接口
 * @param {String} stitle    标题，如：互联网之子
 * @param {String} sdesc     描述，如:在长大的过程中，我才慢慢发现，我身边的所有事
 * @param {String} slink     连接地址， 如:http://movie.douban.com/subject/25785114/
 * @param {String} simgUrl   图片URL， 如 http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status,res)
 *   status : 0 已分享
 *            1 用户点击分享到QZone
 *            2 已取消
 *            3 .分享到QZone 完成
 *            4 分享失败
 */
function apiMenuShareQZone(stitle,sdesc,slink,simgUrl,callback)
{
    wx.onMenuShareQZone({
    title:stitle,
    desc: sdesc ,
    link: slink,
    imgUrl:simgUrl,
    trigger: function (res) {
        callback(1,res);
    },
    complete: function (res) {
        console.log(JSON.stringify(res));
        callback(3,res);
     },
    success: function (res) {
        callback(0,res);
    },
    cancel: function (res) {
        callback(2,res);
    },
    fail: function (res) {
        console.log("apiMenuShareWeibo:"+JSON.stringify(res));
        callback(4,res);
    }
  });
}
  
 /* 智能接口
 *  4.1 音频接口  开始录音
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status)
 *   status : 1 用户拒绝授权录音
 */

//ok
function apiStartRecord(callback)
{
    wx.onVoiceRecordEnd({
      complete: function (res) {

        callback(0,res.localId);
      }
    });
    wx.startRecord({
      cancel: function () {
        callback(1,0);
        
      }
    });
}


/* 智能接口
 *  4.2 音频接口  停止录音
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status,localId)
 *   status : 0 停止录音结束  ,localId 为媒体ID ;1 表示失败
 */
//ok
function apiStop(callback)
{
    wx.stopRecord({
      success: function (res) {
         callback(0,res.localId);
      },
      fail: function (res) {
        callback(1,JSON.stringify(res));
      }
    });
}

/* 智能接口
 *  4.5 播放音频
 * @param {String} slocalId    
  */
 //ok
function apiPlayVoice(slocalId,callback) 
{
   if (slocalId == '') {
      console.log("localId 为空 请先使用 apiStartRecord 接口录制一段声音 ");
      return;
    }
    wx.onVoicePlayEnd({
     complete: function (res) {
        callback(0,res.localId);
       
    }});
    wx.playVoice({
      localId: slocalId
    });
}

/* 智能接口
 *  4.5 暂停播放音频
 * @param {String} slocalId    
  */
 //ok
function apiPauseVoice(slocalId) 
{
    wx.pauseVoice({
      localId: slocalId
    });
}
/* 智能接口
 *  4.6 停止播放音频
 * @param {String} slocalId    
  */
 //ok
function apiStopVoice(slocalId) 
{
    wx.stopVoice({
      localId: slocalId
    });
}


/* 智能接口
 *  4.8 上传语音
 * @param {String} slocalId
  * @param {String} callback  function(status, serverId)
  *   status : 0 上传语音成功 
  */
function apiUploadVoice(slocalId,callback) 
{
    console.log('apiUploadVoice， slocalId:' + slocalId);
   if (slocalId == '') {
      console.log("localId 为空 请先使用 apiStartRecord 接口录制一段声音 ");
      return;
    }
   wx.uploadVoice({
      localId: slocalId,
      success: function (res) {
       console.log('上传语音成功，serverId 为' + res.serverId);
        callback(0,res.serverId);
      }
    });
}


/* 智能接口
 * 4.9 下载语音
 * @param {String} slocalId
  * @param {String} callback  function(status, localId)
  *   status : 0 下载语音成功 
  */
function apiDownloadVoice(sserverId,callback) 
{
    console.log('apiDownloadVoice，sserverId:' +sserverId);
   if (sserverId == '') {
      console.log("请先使用 uploadVoice 上传声音");
      return;
    }
    wx.downloadVoice({
      serverId: sserverId,
      success: function (res) {
        console.log('下载语音成功，localId 为' + res.localId);
        //voice.localId = res.localId;
        callback(0,res.localId);
      }
    });
}


/* 智能接口
 *  4.5 识别音频并返回识别结果
 * @param {String} slocalId  
 * @param {String} callback  微信接口执行后回调函数 定义如： function(status,translateResult)
 *   status : 0 已有识别结果 translateResult 为识别结果 ,1 无法识别 
  */
function apiTranslateVoice(slocalId,callback) 
{
   if (slocalId == '') {
      console.log("localId 为空 请先使用 apiStartRecord 接口录制一段声音 ");
      return;
    }
    wx.translateVoice({
      localId: slocalId,
      complete: function (res) {
        if (res.hasOwnProperty('translateResult')) {  
          callback(0,res.translateResult);
        } else {
           callback(1,'无法识别');
        }
      }});
}


/* 图片接口
 * 5.1 拍照、本地选图
   * @param {String} callback  function(status, localIds)
  *   status : 0   
  *  localIds为localId数组, localIds.length 选择图片张数 
  */

function apiChooseImage(callback) 
{
   wx.chooseImage({
      success: function (res) {
        callback(0,res.localIds);
        
      }});
}

/* 图片接口
 *5.2 图片预览+
 * @param {array} urlArray  urlArray[0] 当前预览的图片 ,urlArray[1---n]后续预览的图片
 */
function apiPreviewImage(urlArray) 
{
    
    var uary =urlArray[0];
    console.log("apiPreviewImage  urlArray[0]:"+uary);
    console.log("apiPreviewImage  urlArray:"+ urlArray.splice(0,1));
    
    wx.previewImage({
        current: uary,
        urls: urlArray.splice(0,1)
    });
     
}
  
/* 图片接口
 *5.3 上传图片
 * @param {object} images = { localId: [],serverId: []}; 
 * callback(status,localId)  0 成功,1 上传失败
 */

function apiUploadImage(images,callback) 
{
   if (images.localId.length == 0) {
      console.log('请先使用 chooseImage 接口选择图片');
      return;
    }
    console.log('apiUploadImage begin '+images.localId);
    var i = 0, length = images.localId.length;
    images.serverId = [];
    //console.log("images.localId[i]:"+images.localId[i]);

    function upload() {
       wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
            var serverId = res.serverId;
            i++;
            images.serverId.push(res.serverId);
           
            if (i < length) {
              upload();
            }
            else{
                //console.log('apiUploadImage end');
                callback(0,images);
            }
        },
        fail: function (res) {
          callback(1,images.localId[i]);
        }
      });
    }
    upload();
}
 
 /* 图片接口
 *5.4 下载图片
 * @param {object} images = { localId: [],serverId: []}; 
 * callback(status,localId)  status 0  完成
 */

function apiDownloadImage(images,callback){
    if (images.serverId.length ==0) {
      console.log('请先使用 uploadImage 上传图片');
      return;
    }
    var i = 0, length = images.serverId.length;
    images.localId = [];
    console.log('apiDownloadImage begin '+images.serverId);
    function download() {
      wx.downloadImage({
        serverId: images.serverId[i],
        success: function (res) {
          i++;
          images.localId.push(res.localId);
          if (i < length) {
            download();
          }
          else
          {
            // console.log('apiDownloadImage end');
             callback(0,images) ;
          }
        }});
    }
    download();
}

 /* 设备信息接口
 *6.1 获取当前网络状态
 * @param {object} images = { localId: [],serverId: []}; 
 * callback(status,NetworkType)  status 0  成功 1 失败
 */
function apiGetNetworkType(callback){
    wx.getNetworkType({
      success: function (res) {
        //console.log(res.networkType);
        callback(0,res.networkType);
      },
      fail: function (res) {
        console.log(JSON.stringify(res));
        callback(1,"");
      }
  });
}

/** 7 地理位置接口
 *  7.1 查看地理位置
 * @param {type} iLatitude  23.099994
 * @param {type} iLongitude 113.324520
 * @param {type} iName      TIT 创意园
 * @param {type} iAddress   广州市海珠区新港中路 397 号
 * @param {type} iScale     14
 * @param {type} iInfoUrl   http://weixin.qq.com
 * @returns {undefined}
 */
function apiOpenLocation(iLatitude,iLongitude,iName,iAddress,iScale,iInfoUrl){
     
    wx.openLocation({
      latitude: iLatitude,
      longitude: iLongitude,
      name:  iName,
      address: iAddress,
      scale: iScale,
      infoUrl: iInfoUrl
    });
}

/**7 地理位置接口
 * 7.2 获取当前地理位置
 * @param {function} callback(status,data) 
 *                status 0 成功 返回JSON 数据， 1 用户拒绝授权获取地理位置
 * @returns {undefined}
 */
function apiGetLocation(callback){
     
    wx.getLocation({
      success: function (res) {
        console.log(JSON.stringify(res));
        callback(0,JSON.stringify(res));
      },
      cancel: function (res) {
        callback(1,'用户拒绝授权获取地理位置');
      }
    });
}
 
 /**界面操作接口
  * 8.1 隐藏右上角菜单
  * @returns {undefined}
  */
function apiHideOptionMenu(){
    wx.hideOptionMenu();
}

/**界面操作接口
 * 显示右上角菜单
 * @returns {undefined}
 */
function apiShowOptionMenu(){
    wx.showOptionMenu();
}


/**界面操作接口
 * 批量隐藏菜单项
 * @param {array} imenuList  为菜单项数组
   例如
       [
        'menuItem:readMode', // 阅读模式
        'menuItem:share:timeline', // 分享到朋友圈
        'menuItem:copyUrl' // 复制链接
      ]
 * @param {function} callback(status, data)
    status 0 成功，1 失败
 * @returns {undefined}
 */
function apiHideMenuItems(imenuList,callback){
    wx.hideMenuItems({
      menuList: imenuList,
      success: function (res) {
        console.log("菜单已隐藏");
        callback(0,"菜单已隐藏");
      },
      fail: function (res) {
        console.log(JSON.stringify(res));
        callback(1,"菜单隐藏失败");
      }
    });
}

/**界面操作接口
 * 批量显示菜单项
 * @param {array} imenuList  为菜单项数组
   例如
       [
        'menuItem:readMode', // 阅读模式
        'menuItem:share:timeline', // 分享到朋友圈
        'menuItem:copyUrl' // 复制链接
      ]
 * @param {function} callback(status, data)
    status 0 成功，1 失败
 * @returns {undefined}
 */
 
function apiShowMenuItems(imenuList,callback){
    wx.showMenuItems({
      menuList:imenuList,
      success: function (res) {
        //console.log('已显示“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
        callback(0,"已显示“阅读模式”，“分享到朋友圈”，“复制链接”等按钮");
      },
      fail: function (res) {
        //console.log(JSON.stringify(res));
        callback(1,"菜单显示失败:"+JSON.stringify(res));
      }
    });
  }

/**界面操作接口
 * 隐藏所有非基本菜单项
 * @param {type} callback(status, data)
     status 0 成功，1 失败
 * @returns {undefined}
 */
function apiHideAllNonBaseMenuItem(callback){
    wx.hideAllNonBaseMenuItem({
      success: function () {
        callback(0,"已隐藏所有非基本菜单项");
      }
    });
}
/**界面操作接口
 * 显示所有被隐藏的非基本菜单项
 * @param {type} callback(status, data)
     status 0 成功，1 失败
 * @returns {undefined}
 */
function apiShowAllNonBaseMenuItem(callback){
    wx.showAllNonBaseMenuItem({
      success: function () {
        callback(0,"已显示所有非基本菜单项");
      }
    });
}

/**界面操作接口
 * 关闭当前窗口
 * @returns {undefined}
 */
function apiCloseWindow(){
    wx.closeWindow();
}

function apiScanQRCode0(callback){
    wx.scanQRCode();
}
/**微信原生接口
 * 9.1.1 扫描二维码并返回结果
 * @param {type} callback(status,data)
     status 0 成功,
     data  为JSON数据
 * @returns {undefined}
 */
function apiScanQRCode1(callback){
  wx.scanQRCode({
      needResult: 1,
      desc: 'scanQRCode desc',
      success: function (res) {
        callback(0,JSON.stringify(res));
      }
    });
}


/**微信支付接口
 * 发起一个支付请求
 * 注意：此 Demo 使用 2.7 版本支付接口实现，建议使用此接口时参考微信支付相关最新文档。
 * @param {type} ipackage  //'addition=action_id%3dgaby1234%26limit_pay%3d&bank_type=WX&body=innertest&fee_type=1
 * &input_charset=GBK&notify_url=http%3A%2F%2F120.204.206.246%2Fcgi-bin%2Fmmsupport-bin%2Fnotifypay
 * &out_trade_no=1414723227818375338&partner=1900000109&spbill_create_ip=127.0.0.1
 * @param {type} isignType  'SHA1', // 注意：新版支付接口使用 MD5 加密
 * @param {type} ipaySign   'bd5b1933cda6e9548862944836a9b52e8c9a2b69'
 * @returns {undefined}
 */

function apiChooseWXPay(ipackage,isignType,ipaySign){
    
    var itimestamp =apiTimestamp();
    var inonceStr =apiRandomNonceStr(16);
    console.log("timeStamp:"+ itimestamp  +" nonceStr:"+inonceStr);
    wx.chooseWXPay({
      timeStamp: itimestamp,    // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
      nonceStr: inonceStr,      // 支付签名随机串，不长于 32 位
      package: ipackage,        // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
      signType: isignType,      // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
      paySign: ipaySign         // 支付签名
    });
}

/**微信支付接口
 * 11.3  跳转微信商品页
 * @param {type} iproductId  'pDF3iY_m2M7EQ5EKKKWd95kAxfNw'
 * @returns {undefined}
 */
function apiOpenProductSpecificView(iproductId){
  wx.openProductSpecificView({
      productId: iproductId
    });
}
/**微信卡券接口
 * 添加卡券
 * @param {array} iCalldList
 例如：
  [
        {
          cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
          cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"f54dae85e7807cc9525ccc127b4796e021f05b33"}'
        },
        {
          cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
          cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"f54dae85e7807cc9525ccc127b4796e021f05b33"}'
        }
   ]
 * @param {type} callback(status,data)
    status 0 表示成功
    data    已添加卡券 列表
 * @returns {undefined}
 */
function apiAddCard(iCalldList,callback){
  wx.addCard({
      cardList:iCalldList,
      success: function (res) {
        callback(0,res.cardList);
      }
    });
}

var _choosedCodes = [];
/**微信卡券接口
 * 12.2 选择卡券
 * @param {type} icardSign '8ef8aa071f1d2186cb1355ec132fed04ebba1c3f'
 * @param {type} itimestamp 1437997723
 * @param {type} inonceStr  'k0hGdSXKZEj3Min5'
 * @returns {undefined}
 */
// 该函数实现有问题
function apiChooseCard(icardSign,itimestamp,inonceStr){
  wx.chooseCard({
    cardSign:icardSign ,
    timestamp: itimestamp,
    nonceStr: inonceStr,
    success: function (res) {
        _choosedCodes.length=0;
        res.cardList = JSON.parse(res.cardList);
        encrypt_code = res.cardList[0]['encrypt_code'];
        decryptCode(encrypt_code, function (code) {
        _choosedCodes.push(code);
      });
    }});
}
 function decryptCode(code, callback) {
    $.getJSON('../jssdk/decrypt_code.php?code=' + encodeURI(code), function (res) {
      if (res.errcode == 0) {
        _choosedCodes.push(res.code);
      }
    
    });
  }
  
/**微信卡券接口
 * 查看卡券
 * @param {type} icardId  'pDF3iY9tv9zCGCj4jTXFOo1DxHdo'
 * @param {array} codes   卡卷代码，多张卡卷
 * @returns {Boolean}
 */
function apiLookCard(icardId,codes){
  if (codes.length < 1) {
      console.log('请先使用 chooseCard 接口选择卡券');
      return false;
    }
    var cardList = [];
    for (var i = 0; i < codes.length; i++) {
      cardList.push({
        cardId:icardId,
        code: codes[i]
      });
    }
    wx.openCard({
      cardList: cardList
    });
}