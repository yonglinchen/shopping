<?php

session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

function WB_callback() {
    $o = new SaeTOAuthV2(WB_AKEY, WB_SKEY);

    if (isset($_REQUEST['code'])) {
        $keys = array();
        $keys['code'] = $_REQUEST['code'];
//                $login_type = getvaluebykey('login_type');
//                $userid = getvaluebykey('userid');
//                print_r($userid);exit;
//                $headpic = getvaluebykey('headpic');
//                $emailnum  = getvaluebykey('emailnum');
        $keys['redirect_uri'] = WB_CALLBACK_URL; //.'?login_type='.$login_type.'_'.$userid.'_'.$headpic.'_'.$emailnum;
        try {
            $token = $o->getAccessToken('code', $keys);
            //print_r($token);
        } catch (OAuthException $e) {
            
        }
    }

    if ($token) {
        $_SESSION['token'] = $token;
        $c1 = new SaeTClientV2(WB_AKEY, WB_SKEY, $token['access_token']);
        $userinfo = $c1->show_user_by_id($token[uid]);

        setcookie('weibojs_' . $o->client_id, http_build_query($token));
        $cb_arr = array('access_token' => $token['access_token'], 'openid' => $token[uid], 'nick' => $userinfo['name']);
        return $cb_arr;
    }
}

function WB_realcallback() {
    $cb_arr = WB_callback();
    //设置userid，这里是默认数据
    $login_type = getSessonUserData('login_type'); 
    if ($login_type == 1) {//login
        $cb_arr['inter_num'] = '0034'; //p_other_login
        $cb_arr['type'] = 5;    //微博5
        $resp_arr = base_fun($cb_arr);
        if ($resp_arr['status'] == 0) {
            $userid = $resp_arr['out_data']['userid'];
//            $this->assign('openid', $cb_arr['openid']);
//            $this->assign('type', $cb_arr['type']);
//
//            if ($userid > 0) {
//                setvaluebykey('userid', $resp_arr['out_data']['userid']);
//                if ($resp_arr['out_data']['headpic'])
//                    setvaluebykey('headpic', $resp_arr['out_data']['headpic']);
//                else
//                    setvaluebykey('headpic', C("defaultheadpic"));
////                                        $this->display('Set/binding_success', 'utf-8');
//                setvaluebykey('emailnum', isset($resp_arr['out_data']['emailnum']) ? $resp_arr['out_data']['emailnum'] : 0);
//                setvaluebykey('shopcartnum', isset($resp_arr['out_data']['shopcartnum']) ? $resp_arr['out_data']['shopcartnum'] : 0);
//
//                $bubble = new BubbleController();
//                $bubble->querybubbleinfo();
            }
            else {
//                $nick = $cb_arr['nick'];
//                if ($nick) {
//                    $nick = $nick . '，';
//                }
//                $this->assign('bindnick', $nick);
//                $this->assign('thirdtypename', '微博');
//                $this->display('cellPhone', 'utf-8');
            }
    }
    if ($login_type == 2) {//bind
        $cb_arr['userid'] = getSessonUserData('userid');
        $cb_arr['inter_num'] = '0035';
        $cb_arr['type'] = 5;    //微博:5
        $resp_arr = base_fun($cb_arr);
        if ($resp_arr['status'] == 0) {
//            $this->assign('nick', $cb_arr['nick']);
//            $this->assign('thirdtypename', '微博');
//            header("location:" . __ROOT__ . '/index.php/Home/Set/querysafeinfo');
//                                        $this->display('Set/binding', 'utf-8');	
        } else {
//            $this->assign('nick', $cb_arr['nick']);
//            $this->assign('type', '微博');
//            $this->display('Set/binding_success', 'utf-8');
//                                        header("location:".__ROOT__.'/index.php/Home/Set/binding_success');
        }
}
}

WB_realcallback();
?>
