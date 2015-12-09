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
            $_info["goods_id"] = $body["goods_id"];
            $_info["user_id"] = $body["user_id"];
            $_info["goods_number"] = $body["goods_number"];
            $_info["rec_type"] = $body["rec_type"];
            
            $sql_retrieveGood = "select goods_sn, goods_name, market_price, shop_price, is_real from goods "
                    . "where goods_id=" . $body["goods_id"];
            $shopData  = $mysqliObj->real_get($sql_retrieveGood);   
            return $result_data;
            if($shopData){ 
                $_info["goods_sn"] = $shopData["goods_sn"];
                $_info["goods_name"] = $shopData["goods_name"];
                $_info["market_price"] = $shopData["market_price"];
                $_info["goods_price"] = $shopData["shop_price"];
                $_info["is_real"] = $shopData["is_real"];
                $get_insert_db_sql = $mysqliObj->get_insert_db_sql("cart",$_info);
                $get_insert_db_sql= "INSERT INTO cart (goods_id,user_id,goods_number,rec_type,goods_sn,goods_name,market_price,goods_price,is_real) VALUES ('1','1','1','0','ECS000000','福佳（Hoegaarden） 白啤酒330ml 瓶装','1665.60','1388.00','1')";

                $result = $mysqliObj->execute($get_insert_db_sql);

                if(!$result){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "商品加入购物车失败";
                } 

             }else {
                 $result_data["status"] = -1;
                 $result_data["desc"] = "商品加入购物车失败";
             }
             
             $mysqliObj->close();
            /** 加入购物车  -  业务处理 end */
            break;
    }
    
    return $result_data;
}
