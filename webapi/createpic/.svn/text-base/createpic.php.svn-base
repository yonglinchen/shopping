<?php
//     调用测试   createpic('测试中','test.png',"D:\\wamp\\www\\lvgoucode\\");

require_once(dirname((dirname(__FILE__))) . "/serviceInterface.php");
function createpicserver($body){
    $servicecode  = $body['servicecode']; 
    $url = ICMethod::getFilePath($servicecode);  
    $name = ICMethod::getFilename($servicecode).'.jpg';

    $text = isset($body['text'])&&$body['text']!='undefined'?$body['text']:'';
    $imgwidth = !empty($body['imgwidth'])&&$body['imgwidth']!='undefined'?$body['imgwidth']:300;
    $imgheigth = !empty($body['imgheigth'])&&$body['imgheigth']!='undefined'?$body['imgheigth']:300;
    $fontsize = !empty($body['fontsize'])&&$body['fontsize']!='undefined'?$body['fontsize']:20;
    createpic($text,$name,$url,$fontsize,$imgwidth,$imgheigth);
    $body['status'] = 0;
    $body['fileurl'] = $url.$name;
    return $body;
}
/*
 * 创建图片
 */
function createpic($text,$name,$path,$fontsize ,$imgwidth,$imgheigth){
    $maxfont = 60;//对应3个字以下的商标，
    $str =$text;
//    print_r(mb_detect_encoding('测试'));exit;
    $length = mb_strlen($str,'utf-8');  //字符串长度
    //控制在15到60之间
    $realfont = ($maxfont - (($length-3)*10))<=10?10:(($maxfont - (($length-3)*10))>60?60:($maxfont - (($length-3)*10)));    
//    print_r($length.'   '.$length.'   '.$realfont);exit;
    $imgHcenter = $imgwidth/2; //水平居中的中线
    $imgVcenter = $imgheigth/2; //垂直居中的中线

    $im = imagecreate($imgwidth,$imgheigth);  //创建一个调色板
    $white = imagecolorallocate($im,0xFF,0xFF,0xFF);  //背景纯白色
    imagecolortransparent($im,$white);  //imagecolortransparent() 设置具体某种颜色为透明色，若注释

    $while = imagecolorallocate($im,255,255,255);
    imagefilledrectangle($im,0,0,$imgwidth,$imgheigth,$while);
    //imagestring($im,5,50,160,"happy every day",$while); //水平添加一行字，这里不需要

    $black = imagecolorallocate($im,0,0,0);          //字体为黑色
//    $box =  imagettfbbox ( $fontsize, 0, "D:/wamp/www/lvgoucode/user/Public/ttf/simhei.ttf",$str );
    $fontpath = str_replace('\\',"/",  dirname(__FILE__))."/simhei.ttf";
//    $fontpath = '/usr/share/fonts/wqy-zenhei/wqy-zenhei.ttc';
//   print_r((shell_exec('ls -l /usr/share/fonts/wqy-zenhei/*')));exit;
//    $testname = '你好';
//    $str = iconv("utf-8","html-entities",$str);
    $str=mb_convert_encoding($str, "html-entities", "utf-8");
//    $str = $testname;//iconv("gb2312","UTF-8",'哈哈123');
//    $gbtestname = mb_convert_encoding($testname, 'gb2312','utf-8' );
//    print_r(mb_detect_encoding($str,"JIS, eucjp-win, sjis-win,utf-8,gb2312",true));exit;
    $box =  imagettfbbox ( $realfont, 0,$fontpath ,$str ); 
//    print_r(mb_detect_encoding($str));exit; 
    //imagettftext($im,$fontsize,0,$imgHcenter -$width/2/3,$imgVcenter-$height/2,$black,"D:\\wamp\\www\\lvgoucode\\user\\Public\\ttf\\simhei.ttf",$str); //字体设置部分linux和windows的路径可能不同
//    $str = replace_tmcharacters($str);
    imagettftext($im,$realfont,0,$imgHcenter -($box[2]-$box[0])/2,$imgVcenter+($box[1]-$box[7])/2,$black,$fontpath,$str); //字体设置部分linux和windows的路径可能不同
// print_r(($str));exit;
    header("Content-type:image/jpg");
    imagepng($im,$path.$name);
}

?>
