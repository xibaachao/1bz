/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : kl

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-03-17 08:28:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for kl_account
-- ----------------------------
DROP TABLE IF EXISTS `kl_account`;
CREATE TABLE `kl_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(40) DEFAULT NULL,
  `subscribe_time` int(11) DEFAULT NULL,
  `lastlogin_time` int(11) DEFAULT NULL,
  `last_consumption_time` int(11) DEFAULT NULL,
  `has_card` int(11) DEFAULT NULL,
  `card_time` int(11) DEFAULT NULL,
  `nickname` varchar(200) DEFAULT NULL,
  `headimgurl` varchar(200) DEFAULT NULL,
  `is_watch` int(11) DEFAULT NULL,
  `cont` int(11) DEFAULT '0',
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kl_account
-- ----------------------------

-- ----------------------------
-- Table structure for kl_config
-- ----------------------------
DROP TABLE IF EXISTS `kl_config`;
CREATE TABLE `kl_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `val` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kl_config
-- ----------------------------
INSERT INTO `kl_config` VALUES ('1', 'account', '');
INSERT INTO `kl_config` VALUES ('2', 'pwd', '');
INSERT INTO `kl_config` VALUES ('3', 'AppId', 'wx227c21dfd0930884');
INSERT INTO `kl_config` VALUES ('4', 'AppSecret', '255ebbd2761db07fe91dfd3742f5da83');
INSERT INTO `kl_config` VALUES ('5', 'TOKEN', '1bz');
INSERT INTO `kl_config` VALUES ('6', 'yxaccount', '');
INSERT INTO `kl_config` VALUES ('7', 'yxpwd', '');
INSERT INTO `kl_config` VALUES ('8', 'name', '');
INSERT INTO `kl_config` VALUES ('9', 'logo', 'logo.png');
INSERT INTO `kl_config` VALUES ('10', 'user_table', '');
INSERT INTO `kl_config` VALUES ('11', 'user_phone_field', '');
INSERT INTO `kl_config` VALUES ('12', 'address', '');
INSERT INTO `kl_config` VALUES ('13', 'tel', '');
INSERT INTO `kl_config` VALUES ('14', 'fax', '');
INSERT INTO `kl_config` VALUES ('15', 'keywords', '');
INSERT INTO `kl_config` VALUES ('16', 'description', '');
INSERT INTO `kl_config` VALUES ('17', 'qq', '');
INSERT INTO `kl_config` VALUES ('18', 'duhui_content', 'dfdsd');

-- ----------------------------
-- Table structure for kl_img
-- ----------------------------
DROP TABLE IF EXISTS `kl_img`;
CREATE TABLE `kl_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `prize_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of kl_img
-- ----------------------------
INSERT INTO `kl_img` VALUES ('1', 'syd_20160317030940_130.png', '1');
INSERT INTO `kl_img` VALUES ('2', 'syd_20160317030950_450.png', '1');
INSERT INTO `kl_img` VALUES ('3', 'syd_20160317030958_655.png', '1');
INSERT INTO `kl_img` VALUES ('4', 'syd_20160317031006_571.png', '1');
INSERT INTO `kl_img` VALUES ('5', 'syd_20160317031033_307.png', '1');
INSERT INTO `kl_img` VALUES ('6', 'syd_20160317031041_333.png', '1');
INSERT INTO `kl_img` VALUES ('7', 'syd_20160317031114_625.png', '2');
INSERT INTO `kl_img` VALUES ('8', 'syd_20160317031125_442.png', '2');
INSERT INTO `kl_img` VALUES ('9', 'syd_20160317031134_541.png', '2');
INSERT INTO `kl_img` VALUES ('10', 'syd_20160317031157_689.png', '2');
INSERT INTO `kl_img` VALUES ('11', 'syd_20160317031210_700.png', '2');
INSERT INTO `kl_img` VALUES ('12', 'syd_20160317031221_337.png', '2');
INSERT INTO `kl_img` VALUES ('13', 'syd_20160317031243_237.png', '3');
INSERT INTO `kl_img` VALUES ('14', 'syd_20160317031251_563.png', '3');
INSERT INTO `kl_img` VALUES ('15', 'syd_20160317031259_665.png', '3');
INSERT INTO `kl_img` VALUES ('16', 'syd_20160317031307_664.png', '3');
INSERT INTO `kl_img` VALUES ('17', 'syd_20160317031315_412.png', '3');
INSERT INTO `kl_img` VALUES ('18', 'syd_20160317031322_254.png', '3');

-- ----------------------------
-- Table structure for kl_menu
-- ----------------------------
DROP TABLE IF EXISTS `kl_menu`;
CREATE TABLE `kl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `key` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `type` varchar(100) DEFAULT NULL COMMENT 'click/view',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kl_menu
-- ----------------------------

-- ----------------------------
-- Table structure for kl_msg
-- ----------------------------
DROP TABLE IF EXISTS `kl_msg`;
CREATE TABLE `kl_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `keyword` varchar(200) DEFAULT NULL COMMENT '关键字',
  `reply` text COMMENT '回复内容',
  `remark` varchar(300) DEFAULT '',
  `sort` int(11) DEFAULT '0' COMMENT '排序值',
  `state` int(11) DEFAULT '1',
  `type` int(11) DEFAULT '1' COMMENT '1=>文本,2=>图文,3=>音乐,4=>地图',
  PRIMARY KEY (`id`),
  KEY `index_code` (`code`),
  KEY `index_keyword` (`keyword`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kl_msg
-- ----------------------------
INSERT INTO `kl_msg` VALUES ('1', '', '清除', 'http://dy.xibaachao.com/index.php/Home/Auth/clear', '清除缓存', '0', '1', '1');

-- ----------------------------
-- Table structure for kl_prize
-- ----------------------------
DROP TABLE IF EXISTS `kl_prize`;
CREATE TABLE `kl_prize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `jl` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of kl_prize
-- ----------------------------
INSERT INTO `kl_prize` VALUES ('1', '咖啡体验卷', '20', '10', 'syd_20160317041734_503.png');
INSERT INTO `kl_prize` VALUES ('2', '可口可乐迷你北极熊', '11', '11', 'syd_20160317041806_177.png');
INSERT INTO `kl_prize` VALUES ('3', '可口可乐精装美食书', '11', '11', 'syd_20160317041903_441.png');
INSERT INTO `kl_prize` VALUES ('4', '可口可乐收纳袋', '11', '11', 'syd_20160317041925_431.png');
INSERT INTO `kl_prize` VALUES ('5', '可口可乐台历', '11', '11', 'syd_20160317041941_662.png');
INSERT INTO `kl_prize` VALUES ('6', '地球一小时官方T恤', '11', '11', 'syd_20160317041955_571.png');

-- ----------------------------
-- Table structure for kl_user
-- ----------------------------
DROP TABLE IF EXISTS `kl_user`;
CREATE TABLE `kl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kl_user
-- ----------------------------
INSERT INTO `kl_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '超级管理员', '-1');

-- ----------------------------
-- Table structure for kl_win
-- ----------------------------
DROP TABLE IF EXISTS `kl_win`;
CREATE TABLE `kl_win` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prize_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `iphone` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ltime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of kl_win
-- ----------------------------

-- ----------------------------
-- Table structure for kl_xm
-- ----------------------------
DROP TABLE IF EXISTS `kl_xm`;
CREATE TABLE `kl_xm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `jl` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of kl_xm
-- ----------------------------
INSERT INTO `kl_xm` VALUES ('1', '土地荒漠', 'syd_20160317021259_411.png', '20', '1');
INSERT INTO `kl_xm` VALUES ('4', '土地荒漠2', 'syd_20160317021411_235.png', '20', '1');
INSERT INTO `kl_xm` VALUES ('2', '拯救海洋', 'syd_20160317021422_276.png', '20', '2');
INSERT INTO `kl_xm` VALUES ('5', '拯救海洋2', 'syd_20160317021435_685.png', '20', '2');
INSERT INTO `kl_xm` VALUES ('3', '雾霾', 'syd_20160317021457_329.png', '20', '3');
INSERT INTO `kl_xm` VALUES ('6', '雾霾2', 'syd_20160317021513_241.png', '20', '3');
