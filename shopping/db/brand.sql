--
-- 表的结构 `brand` 商品品牌表
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `brand_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `brand_name` varchar(60) NOT NULL default '' COMMENT '品牌名称',
  `brand_logo` varchar(80) NOT NULL default '' COMMENT '品牌logo',
  `brand_desc` text NOT NULL COMMENT '品牌描述',
  `site_url` varchar(255) NOT NULL default '' COMMENT '品牌的网址',
  `sort_order` tinyint(3) unsigned NOT NULL default '50' COMMENT '品牌显示顺序',
  `is_show` tinyint( 1 ) unsigned NOT NULL default '1' COMMENT '该品牌是否显示，0，否；1，显示',
  PRIMARY KEY  (`brand_id`),
  KEY `is_show` (`is_show`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ecs_brand
-- ----------------------------
INSERT INTO `brand` VALUES ('1', '诺基亚', '1240803062307572427.gif', 
'公司网站：http://www.nokia.com.cn/\n\n客服电话：400-880-0123', 'http://www.nokia.com.cn/', '50', '1');
INSERT INTO `brand` VALUES ('2', '摩托罗拉', '1240802922410634065.gif', 
'官方咨询电话：4008105050\n售后网点：http://www.motorola.com.cn/service/carecenter/search.asp ', 'http://www.motorola.com.cn', '50', '1');
INSERT INTO `brand` VALUES ('3', '多普达', '1240803144788047486.gif', 
'官方咨询电话：4008201668\n售后网点：http://www.dopod.com/pc/service/searchresult2.php ', 'http://www.dopod.com ', '50', '1');
INSERT INTO `brand` VALUES ('4', '飞利浦', '1240803247838195732.gif', 
'官方咨询电话：4008800008\n售后网点：http://www.philips.com.cn/service/mustservice/index.page ', 'http://www.philips.com.cn ', '50', '1');
INSERT INTO `brand` VALUES ('5', '夏新', '1240803352280856940.gif', 
'官方咨询电话：4008875777\n售后网点：http://www.amobile.com.cn/service_fwyzc.asp ', 'http://www.amobile.com.cn', '50', '1');
INSERT INTO `brand` VALUES ('6', '三星', '1240803412367015368.gif', 
'官方咨询电话：8008105858\n售后网点：http://cn.samsungmobile.com/cn/support/search_area_o.jsp ', 'http://cn.samsungmobile.com', '50', '1');
