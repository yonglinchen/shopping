
/* --------------------------------------------------------------------------------------------------------------------------
 * 该文件定义与具体业务相关的功能接口.
 * _ROOT_URL_  根据具体的webapi放到工程目录的位置来决定
 */

document.write("<script type='text/javascript' src='"+_ROOT_URL_+"libcode/js/publicInterface.js'></script>");


/*
--------------------------------------------------------------------------------------------------------------------------
 */

/*
 * 需要根据具体业务，已经具体的错误码，定义展示的信息
 * 注意：
 * 定义是，错误码与错误信息一一对应，如果不需要特殊的提示，这里不用展示
 */
var _HTMLERRINFO_={
    '1':'自定义起始值',
    
    '9999':'服务器忙',
};
