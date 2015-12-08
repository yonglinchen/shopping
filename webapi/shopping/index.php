<?php
include_once(dirname(__FILE__) . "/DbMysqli.class.php");

function dealCartFlow($body){
    $module_db = "shopping";
    $module_port = 3306;

    $mysqliObj = new \DbMysqli(_HOST_,_USER_,_PSW_,"shopping",$module_port);//mysqli对象
    $result_data = array(
    "status"=>0,
    "desc"=>"",
    "data"=>array()
    );
    
    $servicecode  = $body['servicecode']; 
    switch($servicecode){
        case "1000"://商品展示 
            /** 商品展示  -  业务处理 start */
            $sql_GoodIds = "select goods_id from goods";
            $_goodids = $mysqliObj->get_all($sql_GoodIds);
            
            foreach($_goodids as $key => $_goodid){
               $sql_retrieveGood = "select goods_id, market_price, shop_price, goods_name, goods_number, goods_weight,goods_desc from goods where goods_id=" . $_goodid["goods_id"]; 
               $sql_retrieveGoodImgList = "select gimg.good_img, gimg.master "
                . "from goods as gd join goods_img gimg on gd.goods_id = gimg.goods_id where gd.goods_id=" . $_goodid["goods_id"];
               $shopData  = $mysqliObj->real_get($sql_retrieveGood);   
               if($shopData){ 
                    $shopData["images"] = $mysqliObj->get_all($sql_retrieveGoodImgList);
                    $result_data["data"][$key] = $shopData;
                }else {
                    $result_data["status"] = -1;
                    $result_data["desc"] = "展示商品失败";
                    break;
                }
            }
            /** 商品展示  -  业务处理 end */
            break;
        case "1001"://加入购物车
            /** 加入购物车  -  业务处理 start */
            
            
            /** 加入购物车  -  业务处理 end */
            break;
    }
    
    
    return $result_data;
}
