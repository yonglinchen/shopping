<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class html2pdf {

    private $whtml2pdf;
    private $sencode;
    private $dencode;

    public function __construct() {
        $this->whtml2pdf = "D:\\wkhtmltopdf\\bin\\wkhtmltopdf"; // dirname(__FILE__).'/wkhtml/wkhtmltopdf-amd64';
        $this->sencode = 'utf-8';
        $this->dencode = 'gb2312';
    }

    /*
     * 获得本地的html模版
     * $htmlfile:源html文件
     * 返回：true：成功，false失败
     */

    public function gethtmlcontent($htmlfile) {
        if ($htmlfile)
            $filecontent = file_get_contents($htmlfile);
        else
            $filecontent = '';
        return $filecontent;
    }

    /*
     * 把内存里面html（填充了动态内容），生成html
     * $destfile:目的html文件url
     * $soucefile：源html内容
     * 返回值： true成功  false失败
     */

    public function createhtml($destfile, $soucefilecontent) {
        if ($destfile && $soucefilecontent) {
            $ret = file_put_contents($destfile, $soucefilecontent);
            return $ret;
        } else
            return false;
    }

    /*
     * 对外接口 
     * $dest：目的路径 
     * $d_filename:目的文件名
     * $sourcehtmlfile：源html文件全路径
     */

    public function createpdf($dest, $d_filename, $sourcehtmlfile) {
        $save_pdf = $dest . $d_filename . ".pdf";
        $encode = mb_detect_encoding($save_pdf, array('ascii', 'gb2312', 'utf-8', 'gbk'));
        if (strtolower($encode) == 'ascii') { //路径都为英文，无需转码
            $ret = $this->createenglishpdf($save_pdf, $sourcehtmlfile);
        } else {
            $filename = rand(1, 999999); //随机生成一个文件名
            $ret = $this->createchinesepdf($dest . $filename . '.pdf', $save_pdf, $sourcehtmlfile);
        }
        $data['status'] = 0;
        $data['destfile'] = $save_pdf;
        return $data;
    }

    /*
     * 服务器使用英文名，直接生成，无需转码后再生成pdf，
     * $destfilename：目的路径+文件名 
     * $sourcehtmlfile：源html文件，全路径
     */

    public function createenglishpdf($save_pdf, $sourcehtmlfile) {
        $ret = shell_exec($this->whtml2pdf . " " . " --dpi 93 " . " " . $sourcehtmlfile . " " . $save_pdf);
//        $ret = shell_exec("D:\\wkhtmltopdf\\bin\\wkhtmltopdf"  . " "." --dpi 93 "." " . $sourcehtmlfile . " " .$save_pdf);
        return $ret;
    }

    /*
     * 涉及到汉字，就有汉字编码问题
     * 先转码，在生成pdf， 
     * $save_pdf：临时文件全路径，注意：为英语
     * $d_filename:目的文件全路径
     * $sourcehtmlfile：源html文件全路径
     */

    public function createchinesepdf($save_pdf, $d_filename, $sourcehtmlfile) {
        $d_save_pdf = mb_convert_encoding($d_filename, $this->dencode, $this->sencode);
        shell_exec($this->whtml2pdf . " " . " --dpi 93 " . " " . $sourcehtmlfile . " " . $save_pdf);
        //shell_exec('mv '.'/web/3brush/user/Application/Home/View/ApplyTemplateList/test.txt '.'/web/3brush/user/Application/Home/View/ApplyTemplateList/晓栋.txt');
        $ret = rename($save_pdf, $d_save_pdf);
        return $ret;
    }

}
