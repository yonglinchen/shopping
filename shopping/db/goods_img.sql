/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : shopping

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2015-12-07 11:57:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `goods_img`
-- ----------------------------
DROP TABLE IF EXISTS `goods_img`;
CREATE TABLE `goods_img` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品图片id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `good_img` varchar(255) DEFAULT '' COMMENT '商品对应图片',
  `master` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为主图  0 不是  1是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of goods_img
-- ----------------------------
INSERT INTO `goods_img` VALUES('1', '1', 'http://127.0.0.1/component/shopping/flow/images/2-2.jpg', '0');
INSERT INTO `goods_img` VALUES('2', '1', 'http://127.0.0.1/component/shopping/flow/images/2-3.jpg', '0');
INSERT INTO `goods_img` VALUES('3', '1', 'http://127.0.0.1/component/shopping/flow/images/2-4.jpg', '0');
INSERT INTO `goods_img` VALUES('4', '1', 'http://127.0.0.1/component/shopping/flow/images/1-1.jpg', '0');
INSERT INTO `goods_img` VALUES('5', '1', 'http://127.0.0.1/component/shopping/flow/images/1-2.jpg', '0');
