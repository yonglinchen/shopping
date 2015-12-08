

//ok
function onMenuShareTimeline()
{
    var stitle="互联网之子";
    var slink = "http://movie.douban.com/subject/25785114/";
    var simgUrl= "http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg";
    console.log("onMenuShareTimeline--1");
    apiMenuShareTimeline(stitle,slink,simgUrl,function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}
 //ok
function onMenuShareAppMessage()
{
    console.log("onMenuShareAppMessage--2");
    var stitle="互联网之子";
    var sdesc="在长大的过程中，我才慢慢发现，我身边的所有事";
    var slink = "http://movie.douban.com/subject/25785114/";
    var simgUrl= "http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg";
    apiMenuShareAppMessage(stitle,sdesc,slink,simgUrl,function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}

//ok
function onMenuShareQQ()
{
    var stitle="互联网之子";
    var sdesc="在长大的过程中，我才慢慢发现，我身边的所有事";
    var slink = "http://movie.douban.com/subject/25785114/";
    var simgUrl= "http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg";
    console.log("onMenuShareQQ--3");
    apiMenuShareQQ(stitle,sdesc,slink,simgUrl,function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}
//ok
function onMenuShareWeibo()
{
    console.log("onMenuShareWeibo--4");
    var stitle="互联网之子";
    var sdesc="在长大的过程中，我才慢慢发现，我身边的所有事";
    var slink = "http://movie.douban.com/subject/25785114/";
    var simgUrl= "http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg";
    console.log("onMenuShareQQ");
    apiMenuShareWeibo(stitle,sdesc,slink,simgUrl,function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}
//ok
function onMenuShareQZone()
{
    console.log("onMenuShareQZone--5");
    var stitle="互联网之子";
    var sdesc="在长大的过程中，我才慢慢发现，我身边的所有事";
    var slink = "http://movie.douban.com/subject/25785114/";
    var simgUrl= "http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg";
    apiMenuShareQZone(stitle,sdesc,slink,simgUrl,function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}

//ok
function getNetworkType()
{
    console.log("getNetworkType--18");
    apiGetNetworkType(function(status,text){
        console.log("getNetworkType:"+status+" Text:"+text);
    });
}

//ok
function hideOptionMenu()
{
    console.log("hideOptionMenu--21");
    apiHideOptionMenu();
}
//ok
function showOptionMenu()
{
    console.log("showOptionMenu--22");
    apiShowOptionMenu();
}
//ok
function closeWindow()
{
    console.log("closeWindow--23");
    apiCloseWindow();
}
//ok
function hideMenuItems()
{
    console.log("hideMenuItems--24");
    var imenuList =  "['menuItem:readMode', 'menuItem:share:timeline', 'menuItem:copyUrl']";
   apiHideMenuItems(imenuList,function(status,res){
        console.log("status:"+status +"res:"+res);
    });
}
//ok
function showMenuItems()
{
    console.log("showMenuItems--25");
    var imenuList =  "['menuItem:readMode', 'menuItem:share:timeline', 'menuItem:copyUrl']";
    apiShowMenuItems(imenuList,function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}
//ok
function hideAllNonBaseMenuItem()
{
    console.log("hideAllNonBaseMenuItem--26");
    apiHideAllNonBaseMenuItem(function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}
//ok
function showAllNonBaseMenuItem()
{
    console.log("showAllNonBaseMenuItem--27");
    apiShowAllNonBaseMenuItem(function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}
//ok
function scanQRCode0()
{
    console.log("scanQRCode0--28");
    apiScanQRCode0(function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}
//ok
function scanQRCode1()
{
    console.log("scanQRCode1--29");
    apiScanQRCode1(function(status,res){
        console.log("status:"+status +"res:"+JSON.stringify(res));
    });
}


/******************************* 未测试---------------------*/
var images = {
    localId: [],
    serverId: []
  };
  //ok
function chooseImage()
{
    console.log("chooseImage--6");
   apiChooseImage(function(status,localIds){
       images.localId = localIds;
       console.log("chooseImage localIds:"+images.localId);
    });
}

  //ok
function previewImage(){
    console.log("previewImage--7 localIds:"+images.localId);
  
     /*images.localId =[
         'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
        'http://img3.douban.com/view/photo/photo/public/p2152117150.jpg',
        'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
        'http://img3.douban.com/view/photo/photo/public/p2152134700.jpg'];
      
      */
    apiPreviewImage(images.localId);
}
  //ok
function uploadImage()
{
     console.log("uploadImage--8");
     apiUploadImage(images,function(status,image){
        console.log("uploadImage:" +"serverId:"+image.serverId);
     });
}
  //ok
function downloadImage()
{
    console.log("downloadImage--9");
    apiDownloadImage(images,function(status,data){
        
        console.log("downloadImage: localIds:"+data.localId);
     });
}

  // 3 智能接口
var _localId = 0;
//ok
function startRecord()
{
    console.log("startRecord--10");
    apiStartRecord(function(status,localId){
        if(status==0)
        {
            _localId = localId;
            console.log("startRecord 自动完成:"+status+ "Text:"+localId);
        }
        else
        {
            console.log('用户拒绝授权录音');
        }
    });
}

// ok
function stopRecord()
{
    console.log("stopRecord--1");
    apiStop(function(status,lid){
        if(status==0){
            _localId = lid;
            console.log("stopRecord success:"+_localId );
        }
        else
        {
            console.log("stopRecord failed:"+_localId );
        }
    });
}

// ok
function playVoice()
{
     console.log("playVoice--2");
     apiPlayVoice(_localId,function(status,lid){
         
        console.log("录音 " + lid + "播放结束");
     });
}

//ok
function pauseVoice()
{
    console.log("pauseVoice--13");
     apiPauseVoice(_localId);
}
//ok
function stopVoice()
{
    console.log("stopVoice--14");
    apiStopVoice(_localId);
}

//ok
var _serverId = 0;
function uploadVoice()
{
    console.log("uploadVoice--15");
   apiUploadVoice(_localId,function(status,serverId){ 
       _serverId =serverId;
       console.log("uploadVoice--15 _serverId:"+_serverId);
   });
}

//ok
function downloadVoice()
{
    console.log("downloadVoice--_serverId:"+_serverId);
    apiDownloadVoice(_serverId,function(status,lid){ 
       _localId =lid;
       console.log("downloadVoice--16 localid:"+_localId);
   });
}

//ok
function translateVoice()
{
    console.log("translateVoice--17");
   apiTranslateVoice(_localId,function(status,translateResult){
        if(status==0)
        {
            console.log('识别结果：' + translateResult);
        }
        else
        {
            console.log(translateResult);
        }
   });
}

// ok
function openLocation()
{
    console.log("openLocation--19");
     var iLatitude =23.099994;
    var  iLongitude=113.324520;
    var iName ="TIT 创意园";
    var iAddress="广州市海珠区新港中路 397 号";
    var iScale=     14;
    var iInfoUrl ="http://weixin.qq.com";
    apiOpenLocation(iLatitude,iLongitude,iName,iAddress,iScale,iInfoUrl);
}
// ok
function getLocation()
{
     console.log("getLocation--20");
    apiGetLocation(function(status,data){
        console.log("getLocation:"+data);
    });
}

//ok

function openProductSpecificView()
{
    console.log("openProductSpecificView--30");
    var iproductId ='pDF3iY_m2M7EQ5EKKKWd95kAxfNw';
    apiOpenProductSpecificView(iproductId);
}

var icardList =[];

//ok
function addCard(){
    console.log("addCard--31");
    cardList=[
        {
          cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
          cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"f54dae85e7807cc9525ccc127b4796e021f05b33"}'
        },
        {
          cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
          cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"f54dae85e7807cc9525ccc127b4796e021f05b33"}'
        }
      ];
    apiAddCard(cardList,function(status,data){
        icardList = data;
        console.log("addCard ok icardList:"+JSON.stringify(data));
    });
}



function chooseCard(){
    var cardId = icardList[0]["cardId"];
    var itimestamp =cardExt["timestamp"];
    var signature = cardExt.signature;
    console.log("chooseCard cardId:"+cardId +" itimestamp:"+ itimestamp +" signature:"+signature );
    apiChooseCard(cardId,itimestamp,inonceStr);
}

function openCard(){
    console.log("openCard--33");
    apiLookCard(icardId,codes);
}

function chooseWXPay(){
    var ipackage ="";       //统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
    var isignType = "SHA1"; // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
    var ipaySign ="";       // 支付签名
    apiChooseWXPay(ipackage,isignType,ipaySign);
}

