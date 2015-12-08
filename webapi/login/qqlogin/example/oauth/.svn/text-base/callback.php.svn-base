<?php

///require_once("../../API/qqConnectAPI.php");
require_once(dirname(dirname(dirname(__FILE__))) . "/API/qqConnectAPI.php");
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/InterfaceImpt.php");;
function QQ_callback() {
	$cb_arr = array();
	$qc = new QC();
	$access_token = $qc->qq_callback();//DE89B12F418C136D96F62898CBC4705E
	$openid = $qc->get_openid();//B8C02925F80EE3B4462B86E7868DAC1D
	//echo $access_token;
	//echo $openid;
	$qc1 = new QC($access_token, $openid);
	$userinfo_arr = $qc1->get_user_info();
	$nickname = $userinfo_arr["nickname"];
	$cb_arr = array('access_token'=>$access_token,'openid'=>$openid,'nick'=>$nickname);
	return $cb_arr;
}

function QQrcallback(){
    $cb_arr = QQ_callback();
    $login_type = getSessonUserData('login_type');
    if ($login_type == 1) {//login
        $cb_arr['inter_num'] = '0034'; //p_other_login
        $cb_arr['type'] = 3;    //qq:3
        $resp_arr = base_fun($cb_arr);
        //设置userid，这里是默认数据
        if ($resp_arr['status'] == 0) {
            $userid = $resp_arr['out_data']['userid'];
//            $this->assign('openid', $cb_arr['openid']);
//            $this->assign('type', $cb_arr['type']);
            if ($userid > 0) {
                setSessonUserData('userid', $resp_arr['out_data']['userid']);
//                if ($resp_arr['out_data']['headpic'])
//                    setvaluebykey('headpic', $resp_arr['out_data']['headpic']);
//                else
//                    setvaluebykey('headpic', C("defaultheadpic"));
//                                        $this->display('Index/binding_success', 'utf-8');	
//                setvaluebykey('emailnum', isset($resp_arr['out_data']['emailnum']) ? $resp_arr['out_data']['emailnum'] : 0);
//                setvaluebykey('shopcartnum', isset($resp_arr['out_data']['shopcartnum']) ? $resp_arr['out_data']['shopcartnum'] : 0);
//
//                $bubble = new BubbleController();
//                $bubble->querybubbleinfo();
            }
            else {
                $nick = $cb_arr['nick'];
                if ($nick) {
                    $nick = $nick . '，';
                }
//                $this->assign('bindnick', $nick);
//                $this->assign('thirdtypename', 'QQ');
//                $this->display('cellPhone', 'utf-8');
            }
        }
    }
    if ($login_type == 2) {//bind
        $cb_arr['userid'] = getSessonUserData('userid');
        $cb_arr['inter_num'] = '0035';
        $cb_arr['type'] = 3;
        $resp_arr = base_fun($cb_arr);
        if ($resp_arr['status'] == 0) {  //绑定成功
//            $this->assign('nick', $cb_arr['nick']);
//            $this->assign('thirdtypename', 'QQ');
//            header("location:" . __ROOT__ . '/index.php/Home/Set/querysafeinfo');
//					$this->display('Set/binding', 'utf-8');	
        } else {  //绑定失败
//            $this->assign('nick', $cb_arr['nick']);
//            $this->assign('type', 'QQ');
//            $this->display('Set/binding_success', 'utf-8');
//                                    header("location:".__ROOT__.'/index.php/Home/Set/binding_success');
        }
    }
}

//执行操作
QQrcallback();

?>