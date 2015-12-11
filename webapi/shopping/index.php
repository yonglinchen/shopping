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

            if($shopData){ 
                $_info["goods_sn"] = $shopData["goods_sn"];
                $_info["goods_name"] = $shopData["goods_name"];
                $_info["market_price"] = $shopData["market_price"];
                $_info["goods_price"] = $shopData["shop_price"];
                $_info["is_real"] = $shopData["is_real"];
                
                $where = "goods_id=" . $body["goods_id"] . " and user_id=" . $body["user_id"];
                $sql_goodInCart = "select count(*) as total, goods_number from cart where " . $where;
                $goodInCart  = $mysqliObj->real_get($sql_goodInCart);   
                if($goodInCart["total"] > 0){
                    $_info["goods_number"] = $_info["goods_number"] + $goodInCart["goods_number"];
                    $get_db_sql = $mysqliObj->get_update_db_sql("cart",$_info, $where);
                } else {
                    $get_db_sql = $mysqliObj->get_insert_db_sql("cart",$_info);
                }
                
             
                $result = $mysqliObj->execute($get_db_sql);

                if(!$result){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "商品加入购物车失败";
                } else {
                    $result_data["desc"] = "商品加入购物车成功";
                }

             }else {
                 $result_data["status"] = -1;
                 $result_data["desc"] = "商品加入购物车失败";
             }
            /** 加入购物车  -  业务处理 end */
            break;
        case "1002"://用户购物车列表展示 
            /** 用户购物车列表展示  -  业务处理 start */
            $user_id = "1";
            $sql_userCartGoodList = "select ct.goods_id, ct.goods_sn, ct.goods_name, ct.goods_number, ct.market_price, ct.goods_price, gd.goods_desc from cart as ct join goods as gd on ct.goods_id = gd.goods_id"
                    . " where user_id = " . $user_id;

            $_userCartGoodList = $mysqliObj->get_all($sql_userCartGoodList);
            $result_data["data"] = $_userCartGoodList;
            /** 用户购物车列表展示  -  业务处理 end */
            break;
        case "1003"://用户购物车商品删除
            /** 用户购物车商品删除  -  业务处理 start */
            $user_id = "1";
            
            $sql_goodInCart = "select count(*) as total from cart where user_id = " . $user_id . " and goods_id in(" . $body["goods_id"] . ")";
            $goodInCart  = $mysqliObj->real_get($sql_goodInCart); 
            if($goodInCart["total"] > 0){
                $get_db_sql = "delete from cart where user_id = " . $user_id . " and goods_id in(" . $body["goods_id"] . ")";
           
                $result = $mysqliObj->execute($get_db_sql);

                if(!$result){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "用户购物车商品删除失败";
                } else {
                    $result_data["desc"] = "用户购物车商品删除成功";
                }
            } else {
                $result_data["status"] = -1;
                $result_data["desc"] = "商品不存在";
            }
            /** 用户购物车商品删除  -  业务处理 end */
            break;
        case "1004"://用户购物车商品数量更改
            /** 用户购物车商品删除  -  业务处理 start */
            $user_id = "1";
            
            $sql_goodInCart = "select count(*) as total from cart where user_id = " . $user_id . " and goods_id in(" . $body["goods_id"] . ")";
            $goodInCart  = $mysqliObj->real_get($sql_goodInCart); 
            if($goodInCart["total"] > 0){
                $get_db_sql = "update cart set goods_number = " . $body["goods_number"] . " where user_id = " . $user_id . " and goods_id in(" . $body["goods_id"] . ")";
           
                $result = $mysqliObj->execute($get_db_sql);

                if(!$result){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "用户购物车商品数量更改失败";
                } else {
                    $result_data["desc"] = "用户购物车商品数量更改成功";
                }
            } else {
                $result_data["status"] = -1;
                $result_data["desc"] = "商品不存在";
            }
            /** 用户购物车商品删除  -  业务处理 end */
            break;
        case "1005"://地区联动展示
            /** 地区联动展示  -  业务处理 start */
            $area = array();
            $sql_country = "select region_id, region_name, region_type from region where parent_id = 0 and region_type = 0";//国家
            $_country = $mysqliObj->get_all($sql_country);
            $area = $_country;
            foreach($area as $key => $country){//改为递归
                $sql_province = "select region_id, region_name, region_type from region where parent_id = ". $country["region_id"] ." and region_type = 1";//省（直辖市）
                $_province = $mysqliObj->get_all($sql_province);
                $area[$key]["child"] = $_province;
                
                foreach($area[$key]["child"] as $k => $v){
                    $sql_city = "select region_id, region_name, region_type from region where parent_id = ". $v["region_id"] ." and region_type = 2";//省级市（直辖市区）
                    $_city = $mysqliObj->get_all($sql_city);
                    $area[$key]["child"][$k]["child"] = $_city;
                    
                    foreach($area[$key]["child"][$k]["child"] as $k2 => $v2){
                        $sql_town = "select region_id, region_name, region_type from region where parent_id = ". $v2["region_id"] ." and region_type = 3";//地级市（县）
                        $_town = $mysqliObj->get_all($sql_town);
                        $area[$key]["child"][$k]["child"][$k2]["child"] = $_town;
                    }
                }
            }
            
            $result_data["data"] = $area;
            /** 地区联动展示  -  业务处理 end */
            break;
        case "1006"://新增收货人地址
            /** 新增收货人地址  -  业务处理 start */
            $info = $body;
            unset($info["inter_num"]);
            unset($info["servicecode"]);  
            $info["user_id"] = 1;
            
            $where = "";
            foreach($info as $k => $v){
                $where .= $k . "='" . $v . "' and ";
            }
            $where = substr($where, 0,  strlen($where) - 5);
            
            $sql_data = "select count(*) as total from user_address where " . $where;
            $shopData  = $mysqliObj->real_get($sql_data);   
            
            if($shopData["total"] == 0){
                $get_db_sql = $mysqliObj->get_insert_db_sql("user_address",$info);

                $result = $mysqliObj->execute($get_db_sql);

                if(!$result){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "新增收货人地址失败";
                } else {
                    $result_data["desc"] = "新增收货人地址成功";
                }
            } else {
                $result_data["status"] = -1;
                $result_data["desc"] = "收货人地址已经存在";
            }
            
            /** 新增收货人地址  -  业务处理 end */
            break;
    }
    
    return $result_data;
}
