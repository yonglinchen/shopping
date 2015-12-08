/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function test()
{
    apiGetLocalPosition(function(status,point){        
        if(status!==0){ 
            console.log("定位错误:"+status);
        }
        var longitude = 116.474338;
        var latitude =  40.000726 ;
        var dstPoint = new BMap.Point(longitude, latitude);
        if(apiIsPointInCircle(point,dstPoint)===true){
            console.log("你到达目标位置");
        }
        else{
            console.log("你未到达目标位置");
        }      
    });
    
}



