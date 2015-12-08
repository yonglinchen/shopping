<?php
include_once(dirname(dirname(__FILE__)) . "/db/config.ini.php");
include_once(dirname(dirname(__FILE__)) . "/db/DbMysqli.class.php");
include_once(dirname(__FILE__) . "/Cart.class.php");

//$mysqliObj = new \DbMysqli(_HOST,_USER,_PSW,_DB,_PORT);//mysqli对象

$result_data = array(
"status"=>0,
"desc"=>"",
"data"=>array()
);
$post_data = json_decode(file_get_contents("php://input"), true);
switch ($post_data["action"]){
    case "showShopping"://展示商品
        $sql_retrieveGood = "select gd.goods_name,gd.goods_number,gd.goods_weight,gd.goods_desc from goods as gd where  gd.goods_id=1";
        $sql_retrieveGoodImgList = "select gimg.good_img, gimg.master "
                . "from goods as gd join goods_img gimg on gd.goods_id = gimg.goods_id where gd.goods_id=1";
        
        $shopData  = $mysqliObj->real_get($sql_retrieveGood);
        if($shopData){ 
            $shopData["images"] = $mysqliObj->get_all($sql_retrieveGoodImgList);
            $result_data["data"] = $shopData;
        }else {
            $result_data["status"] = -1;
            $result_data["desc"] = "展示商品失败";
        }
        break;
    case "addToCart"://添加商品到购物车
//        $goodId = $post_data["goodId"];
//        $userId = $post_data["userId"];
//        $cart = new Cart();
//        $cart->addGood($goodId, $userId, &$result_data);
        break;
    case "retrieveGoodList"://检索购物车商品列表
        $userId = $post_data["userId"];
        $cart = new Cart();
        $cart->retrieveGoodList($userId, &$result_data);
        break;
}


header('Content-Type:application/json; charset=utf-8');
exit(json_encode($result_data));
