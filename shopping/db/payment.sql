--
-- 表的结构 `payment` 支付方式配置表
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `pay_id` tinyint(3) unsigned NOT NULL auto_increment COMMENT '支付方式自增id',
  `pay_code` varchar(20) NOT NULL default '' COMMENT '支付方式的英文缩写',
  `pay_name` varchar(120) NOT NULL default '' COMMENT '支付方式名称',
  `pay_fee` VARCHAR( 10 ) NOT NULL DEFAULT '0' COMMENT '支付费用',
  `pay_desc` text NOT NULL COMMENT '支付方式描述',
  `pay_order` tinyint(3) unsigned NOT NULL default '0' COMMENT '支付方式在页面的显示顺序',
  `enabled` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否可用，0，否；1，是',
  `is_cod` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否货到付款，0，否；1，是',
  `is_online` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否在线支付，0，否；1，是',
  PRIMARY KEY  (`pay_id`),
  UNIQUE KEY `pay_code` (`pay_code`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
-- --------------------------------------------------------

-- ----------------------------
-- Records of ecs_payment
-- ----------------------------
INSERT INTO `payment` VALUES ('1', 'balance', '余额支付', '0', 
'使用帐户余额支付。只有会员才能使用，通过设置信用额度，可以透支。', '0', '1', '0', '1');
INSERT INTO `payment` VALUES ('2', 'bank', '银行汇款/转帐', '0', 
'银行名称\n收款人信息：全称 ××× ；帐号或地址 ××× ；开户行 ×××。\n注意事项：办理电汇时，请在电汇单“汇款用途”一栏处注明您的订单号。', '0', '1', '0', '0');
INSERT INTO `payment` VALUES ('3', 'cod', '货到付款', '0', 
'开通城市：×××\n货到付款区域：×××', '0', '1', '1', '0');
