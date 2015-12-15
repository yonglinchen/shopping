--
-- 表的结构 `user_address`
--

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `address_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '地址id',
  `user_id` mediumint(8) unsigned NOT NULL default '0' COMMENT '用户id',
  `consignee` varchar(60) NOT NULL default '' COMMENT '收货人的名字',
  `email` varchar(60) NOT NULL default '' COMMENT '收货人的地址',
  `country` smallint(5) NOT NULL default '0' COMMENT '收货人的国家',
  `province` smallint(5) NOT NULL default '0' COMMENT '收货人的省份',
  `city` smallint(5) NOT NULL default '0' COMMENT '收货人的城市',
  `district` smallint(5) NOT NULL default '0' COMMENT '收货人的地区',
  `address` varchar(120) NOT NULL default '' COMMENT '收货人的地区',
  `zipcode` varchar(60) NOT NULL default '' COMMENT '收货人的邮编',
  `tel` varchar(60) NOT NULL default '' COMMENT '收货人的电话',
  `mobile` varchar(60) NOT NULL default '' COMMENT '收货人的手机',
  `sign_building` varchar(120) NOT NULL default '' COMMENT '收货地址的标志性建筑名',
  `best_time` varchar(120) NOT NULL default '' COMMENT '收货人的最佳收货时间',
  `status` mediumint(8) unsigned NOT NULL default '0' COMMENT '默认用户收货地址',
  PRIMARY KEY  (`address_id`),
  KEY `user_id` (`user_id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

-- ----------------------------
-- Records of ecs_user_address
-- ----------------------------

INSERT INTO `user_address` VALUES ('3','1', '陈泳霖', '15001209007@163.com', '1', '22', '297', '2453', '莱州', 
'100000', '15001209007', '15001209007', '小小', '12点之后');
INSERT INTO `user_address` VALUES ('4', '1', '陈泳霖1', '15001209007@163.com', '1', '6', '83', '764', '陈泳霖1', 
'100000', '15001209007', '15001209007', '小小1', '13点之后');

