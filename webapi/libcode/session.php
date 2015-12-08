<?php

session_start();

/**
 * 设置会话用户数据
 * @param key
 * @param value
 */
function setSessonUserData($key, $value) {
    if (is_array($_SESSION)) {
        $_SESSION[$key] = $value;
        return TRUE;
    }
       return FALSE;
}

/**
 * 获取会话用户数据
 * @param key
 * @return value
 */
function getSessonUserData($key) {
    if (!empty($_SESSION)&&!empty($_SESSION[$key])) {
        return $_SESSION[$key];
    }

    return NULL;
}

/**
 * 获取用户角色
 * @param key
 * @param value
 */
function getUserSession_role() {
    getSessonUserData('role');
}

/**
 * 设置用户角色
 * @param key
 * @param value
 */
function setUserSession_role($value) {
    if (!empty($_SESSION)) {
        $_SESSION["role"] = $value;

        return TRUE;
    }

    return FALSE;
}

/**
 * 获取用户权限
 * @param key
 * @param value
 */
function getUserSession_auth() {

    if (!empty($_SESSION)) {
        $_SESSION["auth"] = $value;

        return TRUE;
    }

    return FALSE;
}

/**
 * 设置用户权限
 * @param key
 * @param value
 */
function setUserSession_auth() {
    $body_arr = array("code" => getUserSession_role());
    $arr = exec_procedure($body_arr, 'p_getauth_byrole');

    if (!empty($_SESSION)) {
        $_SESSION["auth"] = $arr;

        return TRUE;
    }

    return FALSE;
}

/**
 * 判断用户是否有该权限
 * @param key
 */
function is_auth($value) {
    if (!empty($_SESSION)) {
        return FALSE;
    }
    if (!empty($_SESSION["role"])) {
        return FALSE;
    }
    if (!empty($_SESSION["auth"])) {
        return FALSE;
    }
    if (!in_array($value, $_SESSION["auth"])) {
        return FALSE;
    }

    return TRUE;
}

/*
 * 清理session
 */
function clearsession() {
    //2、清空session信息
    $_SESSION = array();
    //4、彻底销毁session
    session_destroy();
    $data['status']=0; 
    setcookie('useraccount',0,0,'/');
    setcookie('userpassword',0,0,'/');
}

/*
 * 记住密码
 * $account  帐号
 * $password  密码
 * $second  多长时间有效  单位：秒
 */
function rememberpwd($account,$password,$second){
    setcookie('useraccount',$account,time()+$second,'/');
    setcookie('userpassword',$password,time()+$second,'/');
}

/*
 * 供外部调用，并且有跳转
*/
function clearsessionjump($body){
    $url = $body['url'];
    clearsession();
    if ($url) {
        header("Location:" . $url);
    } else {
        //刷新当前页面
        location . reload();
    }

}

?>