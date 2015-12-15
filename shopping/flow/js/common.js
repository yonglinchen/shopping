var rooturl =  getRootPath();

/*
获取项目所在目录
取到user
add by dongwg
*/
function getRootPath(){
    var appName = "component/shopping/shopping";
    var pathName = window.document.location.pathname;
    var pos = pathName.indexOf('/' + appName);
    var localhostPaht = '';
    if(pos == -1){
        localhostPaht = '/'
    }else{
        localhostPaht = pathName.substring(0, pos+ appName.length + 1);
    }
    //agent.3brush.com/
    //alert(localhostPaht)
    return localhostPaht;
}