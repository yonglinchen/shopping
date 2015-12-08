<?php
namespace Library;
/**
 * 共有方法类
 */
class Utils {
    
    /**
     * 取得(商品、道具等)原图，根据大小设置:1003v+时间戳+5位随机数
     * @param type $fatherfolder
     * @param type $file
     * @param type $bigsize
     * @return type
     */
    public static function get_photo_path($fatherfolder, $file, $bigsize) {
        $pic_type = self::intercept_path($file, 2, 1); //substr($file, 0,5);
        $pic_time = self::intercept_path($file, 2, 2); //substr($file, 5,10);

        $pic_year = date("Y", $pic_time);
        $pic_month = date("m", $pic_time);
        $pic_day = date("d", $pic_time);
        $pic_hour = date("H", $pic_time);

        $path = $pic_type . '/' . $pic_year . '/' . $pic_month . '/' . $pic_day . '/' . $pic_hour;
        $source = $fatherfolder . '/' . $path . '/' . $file;

        return __ROOT__ . '/' . $source;
    }

    /**
     * 取得(商品、道具等)缩略图，根据大小设置:1003v+时间戳+5位随机数
     * @param type $fatherfolder
     * @param type $file
     * @param type $bigsize
     * @return type
     */
    public static function get_small_photo_path($fatherfolder, $file, $bigsize) {
        $pic_type = self::intercept_path($file, 2, 1); //substr($file, 0,5);
        $pic_time = self::intercept_path($file, 2, 2); //substr($file, 5,10);

        $pic_year = date("Y", $pic_time);
        $pic_month = date("m", $pic_time);
        $pic_day = date("d", $pic_time);
        $pic_hour = date("H", $pic_time);

        $path = $pic_type . '/' . $pic_year . '/' . $pic_month . '/' . $pic_day . '/' . $pic_hour;
        $source = $fatherfolder . '/' . $path . '/' . 's_'.$file;

        return __ROOT__ . '/' . $source;
    }
    /*  截取文件路径
     *  $filename:文件名
     *  $type:1代表相册、头像，$type:1代表商品、广告栏
     *  $param:想要获取第几个元素，注意，最后一个元素是截取剩余的字符，也就是携带后缀名
     */
    public static function intercept_path($filename, $type, $param) {
        if ($type == 1) {//相册、头像（：分类(5)+时间戳(10) +用户ID(9)+5位随机数）
            switch ($param) {
                case 1:
                    return(substr($filename, 0, 5));
                    break;
                case 2:
                    return(substr($filename, 5, 10));
                    break;
                case 3:
                    return(substr($filename, 15, 9));
                    break;
                case 4:
                    return(substr($filename, 24));
                    break;
                default:
                    return -1;
                    break;
            }
        } else if ($type == 2) { //商品、广告栏（：分类(5)+时间戳(10) +5位随机数）
            switch ($param) {
                case 1:
                    return(substr($filename, 0, 5));
                    break;
                case 2:
                    return(substr($filename, 5, 10));
                    break;
                case 3:
                    return(substr($filename, 15));
                    break;
                default:
                    return -2;
                    break;
            }
        }
    }

}

?>