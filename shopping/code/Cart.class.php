<?php
/**
 * 购物车类
 *
 * @author chenyonglin
 */
class Cart {
    private $error = "";
    /**
     * 构造方法，用于构造上传实例
     */
    public function __construct(){
        
    }
    /**
     * 添加商品
     * 
     * @param type $goodId
     * @param type $userId
     * @param array &$result_data   $result_data = array(
    "status"=>0,
    "desc"=>"",
    "data"=>array()
    );
     * @return boolean
     */
    public function addGood($goodId, $userId, &$result_data){
        //调用存储过程加入商品
        return true;
    }
    
    /**
     * 获取最后一次上传错误信息
     * @return string 错误信息
     */
    public function getError(){
        return $this->error;
    }
    
    /**
     * 检索购物车商品列表
     * 
     * @param type $userId
     */
    public function retrieveGoodList($userId, &$result_data){
        //调用存储过程检索商品
        
        
        return true;
    }
}
