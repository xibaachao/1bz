/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : car

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-01-15 00:26:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cat_account
-- ----------------------------
DROP TABLE IF EXISTS `cat_account`;
CREATE TABLE `cat_account` (
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
-- Records of cat_account
-- ----------------------------

-- ----------------------------
-- Table structure for cat_config
-- ----------------------------
DROP TABLE IF EXISTS `cat_config`;
CREATE TABLE `cat_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `val` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cat_config
-- ----------------------------
INSERT INTO `cat_config` VALUES ('1', 'account', '');
INSERT INTO `cat_config` VALUES ('2', 'pwd', '');
INSERT INTO `cat_config` VALUES ('3', 'AppId', 'wx227c21dfd0930884');
INSERT INTO `cat_config` VALUES ('4', 'AppSecret', '255ebbd2761db07fe91dfd3742f5da83');
INSERT INTO `cat_config` VALUES ('5', 'TOKEN', '1bz');
INSERT INTO `cat_config` VALUES ('6', 'yxaccount', '');
INSERT INTO `cat_config` VALUES ('7', 'yxpwd', '');
INSERT INTO `cat_config` VALUES ('8', 'name', '');
INSERT INTO `cat_config` VALUES ('9', 'logo', 'logo.png');
INSERT INTO `cat_config` VALUES ('10', 'user_table', '');
INSERT INTO `cat_config` VALUES ('11', 'user_phone_field', '');
INSERT INTO `cat_config` VALUES ('12', 'address', '');
INSERT INTO `cat_config` VALUES ('13', 'tel', '');
INSERT INTO `cat_config` VALUES ('14', 'fax', '');
INSERT INTO `cat_config` VALUES ('15', 'keywords', '');
INSERT INTO `cat_config` VALUES ('16', 'description', '');
INSERT INTO `cat_config` VALUES ('17', 'qq', '');
INSERT INTO `cat_config` VALUES ('18', 'duhui_content', 'dfdsd');

-- ----------------------------
-- Table structure for cat_menu
-- ----------------------------
DROP TABLE IF EXISTS `cat_menu`;
CREATE TABLE `cat_menu` (
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
-- Records of cat_menu
-- ----------------------------

-- ----------------------------
-- Table structure for cat_msg
-- ----------------------------
DROP TABLE IF EXISTS `cat_msg`;
CREATE TABLE `cat_msg` (
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
-- Records of cat_msg
-- ----------------------------
INSERT INTO `cat_msg` VALUES ('1', '', '清除', 'http://dy.xibaachao.com/index.php/Home/Auth/clear', '清除缓存', '0', '1', '1');

-- ----------------------------
-- Table structure for cat_user
-- ----------------------------
DROP TABLE IF EXISTS `cat_user`;
CREATE TABLE `cat_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cat_user
-- ----------------------------
INSERT INTO `cat_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '超级管理员', '-1');
