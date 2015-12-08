
//document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "baidumap/map/api.map.baidu.js' />");
//document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "baidumap/developer.baidu.com.js' />" );
//document.write("<script type='text/javascript' src='"+_ROOT_URL_ + "baidumap/map/api.map.GeoUtils.js' />");
      

/*
 * 获取用户当前的坐标位置
 * callback(status,point)｛
 *  //根据业务做逻辑处理
 * ｝
 * status: 为状态码
 *  BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
    BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
    BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
    BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
    BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
    BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
    BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
    BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1
    point：坐标位置
 *  * @returns {Boolean}
 */
function apiGetLocalPosition(callback){
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        var status = parseInt(this.getStatus());
        if( status=== 0){
            console.log('您的位置：'+r.point.lng+','+r.point.lat);
            callback(this.getStatus(),r.point);
        }else {
            console.log('获取位置失败：'+status);
            callback(status,r.point);
        }       
    });
}


/**
 * 判断当前位置是否在指定的目标区域内
 * @param {type} srcPoint 当前坐标位置
 * @param {type} destPoint 指定目标中心位置
 * @param {type} aRadius 以中心位置的半径 如：500 表示以中心位置为 500米范围
 * @returns {unresolved}  表示当前位置在指定的坐标位置范围，false 不在指定区域内
 * 
 *  destPoint 的构造方法 :
 * var longitude = 116.474338;
 * var latitude =  40.000726 ;
 * var pt = new BMap.Point(longitude, latitude);
 */
function apiIsPointInCircle(srcPoint,destPoint,aRadius){
     var circle = new BMap.Circle(destPoint, aRadius);
     return BMapLib.GeoUtils.isPointInCircle(srcPoint, circle);
}