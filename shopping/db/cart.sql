--
-- 表的结构 `cart`  购物车购物信息记录表
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `rec_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `goods_id` mediumint(8) unsigned NOT NULL default '0' COMMENT '商品id, 取自表goods的 goods_id',
  `goods_sn` varchar(60) NOT NULL default '' COMMENT '商品的货号, 取自表goods的goods_sn',
  `goods_name` varchar(120) NOT NULL default '' COMMENT '商品的名称, 取自表goods的goods_name',
  `market_price` decimal(10,2) unsigned NOT NULL default '0.00' COMMENT '商品的市场价, 取自表 goods的market_price',
  `goods_price` decimal(10,2) NOT NULL default '0.00' COMMENT '商品的本店价，取自表goods的 shop_price',
  `goods_number` smallint(5) unsigned NOT NULL default '0' COMMENT '商品的购买数量，在购物车时，实际库存不减少',
  `is_real` tinyint(1) unsigned NOT NULL default '0' COMMENT '商品是否为实物,取自goods的is_real',
  `rec_type` tinyint(1) unsigned NOT NULL default '0' COMMENT '购物车商品类型，0，普通；1，团够；2，拍卖',
  PRIMARY KEY  (`rec_id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ecs_cart
-- ----------------------------
INSERT INTO `cart` VALUES ('59', '0',  '9', 'ECS000009', '诺基亚E66', '2757.60', '2298.00', '1',  '1',  '0');
INSERT INTO `cart` VALUES ('57', '0',  '9', 'ECS000009', '诺基亚E66', '2757.60', '2298.00', '1',  '1',  '0');




