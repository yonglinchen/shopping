<?php
include_once("Cart.class.php");

$goodId = $_POST["goodId"];


$cart = new Cart();
$successUrl = "../flow/addToCart.html";
$errorUrl = "../flow/errorToCart.html";
if($cart->addGood($goodId)){//添加成功
    header('Location: ' . $successUrl);
} else {//添加失败
    header('Location: ' . $errorUrl);
}
