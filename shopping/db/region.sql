--
-- 表的结构 `region`   地区列表
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `region_id` smallint(5) unsigned NOT NULL auto_increment COMMENT '表示该地区的id',
  `parent_id` smallint(5) unsigned NOT NULL default '0' COMMENT '该地区的上一个节点的地区id',
  `region_name` varchar(120) NOT NULL default '' COMMENT '地区的名字',
  `region_type` tinyint(1) NOT NULL default '2' COMMENT '地址类型 0国家  1省、直辖市、2省级市3地级市',
  PRIMARY KEY  (`region_id`),
  KEY `parent_id` (`parent_id`),
  KEY `region_type` (`region_type`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------
