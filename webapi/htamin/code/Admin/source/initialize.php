<?php
session_start();
if (isset($_SESSION['userid'])) {
    
} else {
    //未登录跳转至登录页
    header("Location:../login/login.php");
}

