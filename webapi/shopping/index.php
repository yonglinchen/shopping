<?php
include_once(dirname(__FILE__) . "/DbMysqli.class.php");

function dealCartFlow($body){
    $module_db = "shopping";
    $module_port = 3306;

    $mysqliObj = new \DbMysqli(_HOST_,'qstdb',"qstdb","shopping",$module_port);//mysqli对象
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
            $sql_userCartGoodList = "select ct.goods_id, ct.goods_sn, ct.goods_name, ct.goods_number, "
                    . "ct.market_price, ct.goods_price, gd.goods_desc, gdimg.good_img from cart as ct "
                    . "join goods as gd on ct.goods_id = gd.goods_id "
                    . "join goods_img as gdimg on gdimg.goods_id = gd.goods_id  and  gdimg.master = 1"
                    . " where ct.user_id = " . $user_id;

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
        case "1006"://新增、编辑收货人地址
            /** 新增、编辑收货人地址  -  业务处理 start */
            $info = $body;
            unset($info["inter_num"]);
            unset($info["servicecode"]); 
            unset($info["address_id"]);
            $info["user_id"] = 1;
            
            $isNew = true;
            if($info["type"] != 0){//编辑
                $isNew = false;    
            }
            unset($info["type"]);  
            
            $where = "";
            foreach($info as $k => $v){
                if($k == "address_id" || $k == "user_id" || $isNew){
                    $where .= $k . "='" . $v . "' and ";
                }
            }
            $where = substr($where, 0,  strlen($where) - 5);
            
            $sql_data = "select count(*) as total from user_address where " . $where;
            $shopData  = $mysqliObj->real_get($sql_data);  

            if($isNew){
               if($shopData["total"] == 0){
                    $get_db_sql = $mysqliObj->get_insert_db_sql("user_address",$info);

                    $result = $mysqliObj->execute($get_db_sql);

                    if(!$result){
                        $result_data["status"] = -1;
                        $result_data["desc"] = "新增收货人地址失败";
                    } else {
                        $result_data["desc"] = "新增收货人地址成功";
                        $result_data["data"]["address_id"] = $mysqliObj->last_id();
                    }
                } else {
                    $result_data["status"] = -1;
                    $result_data["desc"] = "收货人地址已经存在";
                } 
            } else {//编辑
                if($shopData["total"] == 0){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "收货人地址不存在";
                } else {
                    $where = "address_id=" . $body["address_id"] . " and user_id=" . $info["user_id"];
                    $get_db_sql = $mysqliObj->get_update_db_sql("user_address",$info, $where);
                    $result = $mysqliObj->execute($get_db_sql);

                    if(!$result){
                        $result_data["status"] = -1;
                        $result_data["desc"] = "编辑收货人地址失败";
                    } else {
                        $result_data["desc"] = "编辑收货人地址成功";
                    }  
                } 
            }
            /** 新增、编辑收货人地址  -  业务处理 end */
            break;
        case "1007"://删除收货人地址
            /** 删除收货人地址  -  业务处理 start */
            $user_id = 1;
            $where = "address_id=" . $body["address_id"] . " and user_id=" . $user_id;
            $sql_data = "select count(*) as total from user_address where " . $where;
            $shopData  = $mysqliObj->real_get($sql_data);  
            
            if($shopData["total"] == 0){
                $result_data["status"] = -1;
                $result_data["desc"] = "收货人地址不存在";
            } else {
                $sql_data = "delete from user_address where " . $where;
                $result = $mysqliObj->execute($sql_data);

                if(!$result){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "删除收货人地址失败";
                } else {
                    $result_data["desc"] = "删除收货人地址成功";
                }  
            }
            /** 删除收货人地址  -  业务处理 end */
            break;
        case "1008"://设置收货人地址
            /** 设置收货人地址  -  业务处理 start */
            $user_id = 1;
            $where = "address_id=" . $body["address_id"] . " and user_id=" . $user_id;
            $where2 = "address_id <>" . $body["address_id"] . " and user_id=" . $user_id;
            $sql_data = "select count(*) as total from user_address where " . $where;
            $shopData  = $mysqliObj->real_get($sql_data);  
            if($shopData["total"] == 0){
                $result_data["status"] = -1;
                $result_data["desc"] = "收货人地址不存在";
            } else {
                $sql_data = "update user_address set status = 1 where " . $where;
                $result = $mysqliObj->execute($sql_data);
                if(!$result){
                    $result_data["status"] = -1;
                    $result_data["desc"] = "设置收货人地址失败";
                } else {
                    $sql_data2 = "update user_address set status = 0 where " . $where2;
                    $result2 = $mysqliObj->execute($sql_data2);
                    if(!$result2){
                        $result_data["status"] = -1;
                        $result_data["desc"] = "设置收货人地址失败";
                    } else {
                        $result_data["desc"] = "设置收货人地址成功";
                    }  
                }  
            }
            /** 设置收货人地址  -  业务处理 end */
            break;
        case "1009"://订单信息展示
            /** 订单信息展示  -  业务处理 start */
            $user_id = "1";
            //收货人信息
            $sql_address = "select ua.address_id, ua.consignee, ua.email, ua.address, ua.mobile, ua.zipcode, ua.province, ua.city, ua.district, ua.status "
                    . " from user_address as ua " . " where user_id = " . $user_id . " order by ua.status desc";
            $_addressList = $mysqliObj->get_all($sql_address);
             
            $sql_address2 = "select re.region_name from user_address as ua   "
                    . "left join region as re on ua.province = re.region_id where user_id =  " . $user_id. " order by ua.status desc";
            $_addressList2 = $mysqliObj->get_all($sql_address2);
            
            $sql_address3 = "select re.region_name from user_address as ua  "
                    . "left join region as re on ua.city = re.region_id where user_id = " . $user_id. " order by ua.status desc";
            $_addressList3 = $mysqliObj->get_all($sql_address3);
            
            $sql_address4 = "select re.region_name from user_address as ua  "
                    . "left join region as re on ua.district = re.region_id where user_id = " . $user_id. " order by ua.status desc";
            $_addressList4 = $mysqliObj->get_all($sql_address4);
           
            foreach($_addressList as $k => $v){
                $_addressList[$k]["province"] = $_addressList2[$k]["region_name"];
                $_addressList[$k]["city"] = $_addressList3[$k]["region_name"];
                $_addressList[$k]["district"] = $_addressList4[$k]["region_name"];
            }
           
            
            $result_data["data"]["addressList"] = $_addressList;
            //支付方式
            $sql_payment = "select pay_id, pay_code, pay_name from payment";
            $_paymentList = $mysqliObj->get_all($sql_payment);
            $result_data["data"]["paymentList"] = $_paymentList;
            //送货清单
            $sql_userCartGoodList = "select ct.goods_id, ct.goods_sn, ct.goods_name, ct.goods_number, "
                    . "ct.market_price, ct.goods_price, gd.goods_desc, gdimg.good_img from cart as ct "
                    . "join goods as gd on ct.goods_id = gd.goods_id "
                    . "join goods_img as gdimg on gdimg.goods_id = gd.goods_id  and  gdimg.master = 1"
                    . " where ct.user_id = " . $user_id;

            $_cartGoodList = $mysqliObj->get_all($sql_userCartGoodList);
            $result_data["data"]["cartGoodList"] = $_cartGoodList;
            
            $result_data["data"]["total"] = 0;
            foreach($result_data["data"]["cartGoodList"] as $k => $value){
                $result_data["data"]["total"]  = $result_data["data"]["total"] + $value["goods_price"] * $value["goods_number"];    
            }
            /** 订单信息展示  -  业务处理 end */
            break;
    }
    
    return $result_data;
}
