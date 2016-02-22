/*
Navicat MySQL Data Transfer

Source Server         : 远程测速数据库
Source Server Version : 50528
Source Host           : 211.149.187.82:3306
Source Database       : zjc

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2016-02-22 20:09:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ct_account
-- ----------------------------
DROP TABLE IF EXISTS `ct_account`;
CREATE TABLE `ct_account` (
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
-- Records of ct_account
-- ----------------------------

-- ----------------------------
-- Table structure for ct_config
-- ----------------------------
DROP TABLE IF EXISTS `ct_config`;
CREATE TABLE `ct_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `val` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ct_config
-- ----------------------------
INSERT INTO `ct_config` VALUES ('1', 'account', '');
INSERT INTO `ct_config` VALUES ('2', 'pwd', '');
INSERT INTO `ct_config` VALUES ('3', 'AppId', 'wx8e4bf7d4d12384c2');
INSERT INTO `ct_config` VALUES ('4', 'AppSecret', 'adb72d3a669396996dfb72477fcd5652');
INSERT INTO `ct_config` VALUES ('5', 'TOKEN', '1bz');
INSERT INTO `ct_config` VALUES ('6', 'yxaccount', '');
INSERT INTO `ct_config` VALUES ('7', 'yxpwd', '');
INSERT INTO `ct_config` VALUES ('8', 'name', '');
INSERT INTO `ct_config` VALUES ('9', 'logo', 'logo.png');
INSERT INTO `ct_config` VALUES ('10', 'user_table', '');
INSERT INTO `ct_config` VALUES ('11', 'user_phone_field', '');
INSERT INTO `ct_config` VALUES ('12', 'address', '');
INSERT INTO `ct_config` VALUES ('13', 'tel', '');
INSERT INTO `ct_config` VALUES ('14', 'fax', '');
INSERT INTO `ct_config` VALUES ('15', 'keywords', '');
INSERT INTO `ct_config` VALUES ('16', 'description', '');
INSERT INTO `ct_config` VALUES ('17', 'qq', '');
INSERT INTO `ct_config` VALUES ('18', 'duhui_content', 'dfdsd');

-- ----------------------------
-- Table structure for ct_jp
-- ----------------------------
DROP TABLE IF EXISTS `ct_jp`;
CREATE TABLE `ct_jp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `time2` int(11) DEFAULT NULL,
  `ly` varchar(255) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ct_jp
-- ----------------------------
INSERT INTO `ct_jp` VALUES ('41', null, null, '20', null, '1456130467', null, null, 'obESNjtERREDo38UimWrOkVDwGms');
INSERT INTO `ct_jp` VALUES ('40', null, null, '20', null, '1456130420', null, null, 'obESNjpd-ey7fRqqlbpVERjXqtwo');
INSERT INTO `ct_jp` VALUES ('32', null, null, '19', null, '1456129615', null, null, 'obESNjoKQLLuQz_KGHNviQy1H8Tc');
INSERT INTO `ct_jp` VALUES ('33', null, null, '23', null, '1456129780', null, null, 'obESNjmjCbG684a8RQk8RCIH86Uk');
INSERT INTO `ct_jp` VALUES ('34', null, null, '7', null, '1456130006', null, null, 'obESNjkKFBs-ksQOtYRT0AJ96fSM');
INSERT INTO `ct_jp` VALUES ('35', '岚小岚', '15982055130', '18', null, '1456130029', null, '大成网', 'obESNjtY8u2APoyLQNRukx5VDCMA');
INSERT INTO `ct_jp` VALUES ('36', null, null, '19', null, '1456130081', null, null, 'obESNjjw0_Gmxpazyrzg9-L4EkK0');
INSERT INTO `ct_jp` VALUES ('37', null, null, '20', null, '1456130257', null, null, 'obESNju_VZYfovv9a01kOZbAfjW4');
INSERT INTO `ct_jp` VALUES ('38', '鸡蛋', '13709060911', '18', null, '1456130260', null, '大成网', 'obESNjqil5rso1ptxEzBQ5DN5l5c');
INSERT INTO `ct_jp` VALUES ('39', '王续吉', '15208337686', '4', null, '1456130331', null, '第四城', 'obESNjmNJVJqG75sa4Gm8UBLaWnQ');
INSERT INTO `ct_jp` VALUES ('42', null, null, '20', null, '1456130512', null, null, 'obESNjr1xw-H168AiIMkZY-OzETI');
INSERT INTO `ct_jp` VALUES ('43', null, null, '20', null, '1456130528', null, null, 'obESNjkX8znF0lR-SKqQRfxJ-5QM');
INSERT INTO `ct_jp` VALUES ('44', null, null, '10', null, '1456130535', null, null, 'obESNjtnCzpM-5J4cc-9THX1ORes');
INSERT INTO `ct_jp` VALUES ('45', null, null, '20', null, '1456130550', null, null, 'obESNjqxAIECHO2WRlOtJWjxH-mw');
INSERT INTO `ct_jp` VALUES ('46', null, null, '20', null, '1456130602', null, null, 'obESNjswuT1cdKMauOAuTM5i802g');
INSERT INTO `ct_jp` VALUES ('47', null, null, '19', null, '1456130625', null, null, 'obESNjj9SBat0x3DQN7gO0saSXCo');
INSERT INTO `ct_jp` VALUES ('48', '刘莎莎', '15008214154', '15', null, '1456130664', null, '其他', 'obESNjisCnui2L3DaqooT2PeypL0');
INSERT INTO `ct_jp` VALUES ('49', null, null, '19', null, '1456130867', null, null, 'obESNjulMkRPDpx3J8foEvJWNtGg');
INSERT INTO `ct_jp` VALUES ('50', null, null, '20', null, '1456130942', null, null, 'obESNjkMiYSPVXCZyxLpzLVYtcD0');
INSERT INTO `ct_jp` VALUES ('51', null, null, '19', null, '1456130972', null, null, 'obESNjinw0oloq42c6WwXCeGlntc');
INSERT INTO `ct_jp` VALUES ('52', null, null, '19', null, '1456130987', null, null, 'obESNjtLc28yX29Y6kI-jubMXfYc');
INSERT INTO `ct_jp` VALUES ('53', null, null, '20', null, '1456131029', null, null, 'obESNjkXMrVm7hQ6qCraq_trFydQ');
INSERT INTO `ct_jp` VALUES ('54', null, null, '20', null, '1456131044', null, null, 'obESNjpwgsdv96PSxyxQSjM3impA');
INSERT INTO `ct_jp` VALUES ('55', null, null, '19', null, '1456131071', null, null, 'obESNjnKdpn_m5EizwMNpEUPpAkA');
INSERT INTO `ct_jp` VALUES ('56', null, null, '19', null, '1456131084', null, null, 'obESNjuKOnSZpUQ1gB9lNcN3-2hQ');
INSERT INTO `ct_jp` VALUES ('57', null, null, '19', null, '1456131095', null, null, 'obESNjiU6Env_DWEUyKPBI_8kXZQ');
INSERT INTO `ct_jp` VALUES ('58', null, null, '19', null, '1456131097', null, null, 'obESNjgbiqX2dALOsYiKVeabev5M');
INSERT INTO `ct_jp` VALUES ('59', null, null, '19', null, '1456131139', null, null, 'obESNjpLY3VMYauFvrWMKh4JUroI');
INSERT INTO `ct_jp` VALUES ('60', null, null, '19', null, '1456131146', null, null, 'obESNjpjgJO34F-GInxdDid_jIgs');
INSERT INTO `ct_jp` VALUES ('61', null, null, '19', null, '1456131184', null, null, 'obESNjm8HDEdxInnrgtx0_36XFII');
INSERT INTO `ct_jp` VALUES ('62', null, null, '20', null, '1456131210', null, null, 'obESNjrttc2mxIA_gwyQywAcSVIw');
INSERT INTO `ct_jp` VALUES ('63', null, null, '19', null, '1456131234', null, null, 'obESNjnrByOkBxzQK3i8F9lTduoE');
INSERT INTO `ct_jp` VALUES ('64', null, null, '19', null, '1456131243', null, null, 'obESNjkhOAV9TfX1jlmd-cmO-tiM');
INSERT INTO `ct_jp` VALUES ('65', null, null, '19', null, '1456131285', null, null, 'obESNjreawkCLY31W8WiuVfSXVxQ');
INSERT INTO `ct_jp` VALUES ('66', null, null, '20', null, '1456131308', null, null, 'obESNjo7iMu3YzzgNsAe69XAMxoE');
INSERT INTO `ct_jp` VALUES ('67', null, null, '20', null, '1456131424', null, null, 'obESNjsbpKXOhga1qu8nZ-jBTQQU');
INSERT INTO `ct_jp` VALUES ('68', null, null, '20', null, '1456131440', null, null, 'obESNjiLjC_FGzQOw9PJHiN9MUrk');
INSERT INTO `ct_jp` VALUES ('69', null, null, '20', null, '1456131440', null, null, 'obESNjs9o6XKfy0IJtrozY8DAkMA');
INSERT INTO `ct_jp` VALUES ('70', null, null, '20', null, '1456131475', null, null, 'obESNjinw2tjzeaIoRyJibrZPDIk');
INSERT INTO `ct_jp` VALUES ('71', '夕阳', '18384133261', '24', null, '1456131484', null, '大成网', 'obESNjgvdoTmm5FkJPVwGH755Vcg');
INSERT INTO `ct_jp` VALUES ('72', '雷丹丹', '18782933798', '18', null, '1456131601', null, '其他', 'obESNjgaO3nk5EN2JsMkeW1waBiA');
INSERT INTO `ct_jp` VALUES ('73', null, null, '20', null, '1456131628', null, null, 'obESNjiENDHK1d9NLX4HbMVPVq5o');
INSERT INTO `ct_jp` VALUES ('74', null, null, '20', null, '1456131844', null, null, 'obESNjomPki-d4dlrD6xX0sysvIs');
INSERT INTO `ct_jp` VALUES ('75', null, null, '19', null, '1456131880', null, null, 'obESNjs1qM1yksnW_F0Y9f4qiuM4');
INSERT INTO `ct_jp` VALUES ('76', '黄李娜', '18628161021', '23', null, '1456131896', null, '第四城', 'obESNjns3DzSbIxqXl6IPTvjLcFg');
INSERT INTO `ct_jp` VALUES ('77', null, null, '19', null, '1456131908', null, null, 'obESNjhqoY92bL5ZLAiSzapkRn0A');
INSERT INTO `ct_jp` VALUES ('78', null, null, '19', null, '1456131922', null, null, 'obESNjsP7jtrlD2ATIFj0AOOK7DY');
INSERT INTO `ct_jp` VALUES ('79', null, null, '19', null, '1456131964', null, null, 'obESNjiHBDA57f3OoX54OZM6AsMg');
INSERT INTO `ct_jp` VALUES ('80', null, null, '19', null, '1456132014', null, null, 'obESNjgghNjap5ktMFUXAgynale4');
INSERT INTO `ct_jp` VALUES ('81', null, null, '20', null, '1456132130', null, null, 'obESNjqzMYdeRaF-1RLqnLCUdrdc');
INSERT INTO `ct_jp` VALUES ('82', null, null, '19', null, '1456132130', null, null, 'obESNjqOkCyYyCms52U18foKlC7c');
INSERT INTO `ct_jp` VALUES ('83', '赵志', '15928920732', '24', null, '1456132170', null, '大成网', 'obESNjspqtTdv4ETD1kWi_2kbJuM');
INSERT INTO `ct_jp` VALUES ('84', null, null, '19', null, '1456132182', null, null, 'obESNjm567ANcNoZ9HCtLS_-a8n8');
INSERT INTO `ct_jp` VALUES ('85', null, null, '20', null, '1456132222', null, null, 'obESNjqbcCLDg4H93pSG6llQ2Ieo');
INSERT INTO `ct_jp` VALUES ('86', null, null, '19', null, '1456132363', null, null, 'obESNjvKmBn51TjrWrCBWB31oEys');
INSERT INTO `ct_jp` VALUES ('87', null, null, '11', null, '1456132462', null, null, 'obESNjhlllQOizcwmdOKy-23Uw6A');
INSERT INTO `ct_jp` VALUES ('88', null, null, '20', null, '1456132510', null, null, 'obESNjrbWqWi_f4xKE0paDqay_1w');
INSERT INTO `ct_jp` VALUES ('89', null, null, '20', null, '1456132561', null, null, 'obESNjuImIOGFmikL0rbAfOgwycI');
INSERT INTO `ct_jp` VALUES ('90', null, null, '19', null, '1456132568', null, null, 'obESNjgaYe7Kd_2_SBVJ-kUMwPaU');
INSERT INTO `ct_jp` VALUES ('91', null, null, '19', null, '1456132596', null, null, 'obESNjiFJRrI3OOxtdwhqlbPb4jA');
INSERT INTO `ct_jp` VALUES ('92', null, null, '20', null, '1456132684', null, null, 'obESNjgbwAHxEBYASIPR1wGLvncY');
INSERT INTO `ct_jp` VALUES ('93', null, null, '19', null, '1456132818', null, null, 'obESNjs-7qGvw6XlBC_LLatQWytk');
INSERT INTO `ct_jp` VALUES ('94', null, null, '20', null, '1456132982', null, null, 'obESNjkjoGu_KaCFN4ShTJtBINBg');
INSERT INTO `ct_jp` VALUES ('95', null, null, '19', null, '1456133014', null, null, 'obESNji7TbqIavgeJkeF70nxdRWI');
INSERT INTO `ct_jp` VALUES ('96', null, null, '20', null, '1456133073', null, null, 'obESNjiOMGqHP0wersYCl77PMT1U');
INSERT INTO `ct_jp` VALUES ('97', null, null, '19', null, '1456133122', null, null, 'obESNjpkR44KbyW-ShhNcT5PD71Q');
INSERT INTO `ct_jp` VALUES ('98', null, null, '23', null, '1456133270', null, null, 'obESNjryBF6uPoBY4nHK5xPYqvb0');
INSERT INTO `ct_jp` VALUES ('99', null, null, '23', null, '1456133529', null, null, 'obESNjl7yfm7kZKKWQhNehUAOpfc');
INSERT INTO `ct_jp` VALUES ('100', null, null, '20', null, '1456133649', null, null, 'obESNjgmVpymKPLzo3rZ3eZIOov4');
INSERT INTO `ct_jp` VALUES ('101', '冯春梅', '18482318379', '11', null, '1456133719', null, '其他', 'obESNjizhW_-QUTK0JCaV03SYrWI');
INSERT INTO `ct_jp` VALUES ('102', null, null, '19', null, '1456133743', null, null, 'obESNjsf0PCSXzk_fqpeYorQfBzg');
INSERT INTO `ct_jp` VALUES ('103', null, null, '20', null, '1456133943', null, null, 'obESNjr_8ckcWUXWoCQnXJDpzBjc');
INSERT INTO `ct_jp` VALUES ('104', null, null, '19', null, '1456134199', null, null, 'obESNjn44NcyqQS4SeM89xbXxcVs');
INSERT INTO `ct_jp` VALUES ('105', null, null, '3', null, '1456134298', null, null, 'obESNjs47F3W2XHMmXUDBCNAkE4k');
INSERT INTO `ct_jp` VALUES ('106', null, null, '20', null, '1456134330', null, null, 'obESNjmRmNcxBYetbnAukhVIgyFg');
INSERT INTO `ct_jp` VALUES ('107', null, null, '19', null, '1456134358', null, null, 'obESNjsr-XkP84cuZSkwARnurK4I');
INSERT INTO `ct_jp` VALUES ('108', null, null, '20', null, '1456134521', null, null, 'obESNjjMaCRZi4oLDvHCqTmWoxfU');
INSERT INTO `ct_jp` VALUES ('109', null, null, '19', null, '1456134647', null, null, 'obESNjjliyEFXH_ec0MoPkNiVxWo');
INSERT INTO `ct_jp` VALUES ('110', null, null, '20', null, '1456134807', null, null, 'obESNjsy0qWea_8ZBD65d9EXwNPU');
INSERT INTO `ct_jp` VALUES ('111', null, null, '19', null, '1456135040', null, null, 'obESNjvWGKanfZSySXdcGcpNtFRA');
INSERT INTO `ct_jp` VALUES ('112', null, null, '16', null, '1456135253', null, null, 'obESNjlmyh8PjXzhKQnGcGZfWqPA');
INSERT INTO `ct_jp` VALUES ('113', null, null, '20', null, '1456135268', null, null, 'obESNjvjEGL33yh7jAwYtPJXYYaI');
INSERT INTO `ct_jp` VALUES ('114', '王灵芝', '13551006439', '18', null, '1456135286', null, '其他', 'obESNju3AeHdLOSdXmpHn3yFRGiA');
INSERT INTO `ct_jp` VALUES ('115', null, null, '19', null, '1456135296', null, null, 'obESNjp7irsqrM5H_Zi3cjHt2xNc');
INSERT INTO `ct_jp` VALUES ('116', '童佳丽', '15828562606', '3', null, '1456135516', null, '第四城', 'obESNjkmZ_JrNc_2vIw7fLpt3cmc');
INSERT INTO `ct_jp` VALUES ('117', null, null, '19', null, '1456135633', null, null, 'obESNjmiBkojdAEA5KXyONB-y-YY');
INSERT INTO `ct_jp` VALUES ('118', null, null, '20', null, '1456135731', null, null, 'obESNjjXHe-5-dFJm9QNiR3GviiA');
INSERT INTO `ct_jp` VALUES ('119', null, null, '19', null, '1456135804', null, null, 'obESNjmHJAQDGFZMP5dV2gqe1y2g');
INSERT INTO `ct_jp` VALUES ('120', null, null, '20', null, '1456135822', null, null, 'obESNjvQzttvy_Ugveu-CKUes8e0');
INSERT INTO `ct_jp` VALUES ('121', null, null, '19', null, '1456135888', null, null, 'obESNjsnBerSkeLxE0SfGBoxYKv4');
INSERT INTO `ct_jp` VALUES ('122', null, null, '19', null, '1456136115', null, null, 'obESNjhPWWNtCT3zQdEWzlWuCDvY');
INSERT INTO `ct_jp` VALUES ('123', null, null, '19', null, '1456136390', null, null, 'obESNjsyvBxHnNEjcKOOvI-yBlnY');
INSERT INTO `ct_jp` VALUES ('124', null, null, '19', null, '1456136690', null, null, 'obESNjhLuer_z3i2YZEY8g1lE7pE');
INSERT INTO `ct_jp` VALUES ('125', null, null, '19', null, '1456137000', null, null, 'obESNjiG8kBglde8iOcWIO1Sbksk');
INSERT INTO `ct_jp` VALUES ('126', '郭星', '13881784074', '11', null, '1456137533', null, '其他', 'obESNjpocklTtA6liH45vXAYK4Dg');
INSERT INTO `ct_jp` VALUES ('127', null, null, '20', null, '1456137600', null, null, 'obESNjtcnIisc3TMCNLhu4J01J0Y');
INSERT INTO `ct_jp` VALUES ('128', null, null, '19', null, '1456137871', null, null, 'obESNjurYjV2wldN5zJtbpPwrE_0');
INSERT INTO `ct_jp` VALUES ('129', null, null, '20', null, '1456137932', null, null, 'obESNjheFLtyypai03Nii0_-ymZ0');
INSERT INTO `ct_jp` VALUES ('130', null, null, '19', null, '1456138138', null, null, 'obESNjiD2DUrlwk2bVS38n5icclg');
INSERT INTO `ct_jp` VALUES ('131', null, null, '19', null, '1456138212', null, null, 'obESNju6TmCzRRa9_4gvtsPJtOXI');
INSERT INTO `ct_jp` VALUES ('132', null, null, '19', null, '1456138445', null, null, 'obESNjq6FdFMOWmEFuALL6meq4WY');
INSERT INTO `ct_jp` VALUES ('133', null, null, '19', null, '1456138449', null, null, 'obESNji8A7kpLdtm63EIIvy4ns9Q');
INSERT INTO `ct_jp` VALUES ('134', null, null, '19', null, '1456138491', null, null, 'obESNjhUxYVkTSFZDC53c7qilUmI');
INSERT INTO `ct_jp` VALUES ('135', null, null, '18', null, '1456138510', null, null, 'obESNjukyCcZjxHVZxfNMEltWYgo');
INSERT INTO `ct_jp` VALUES ('136', null, null, '18', null, '1456138595', null, null, 'obESNjpY_yOVKlCakQPCy7eVVt6o');
INSERT INTO `ct_jp` VALUES ('137', null, null, '19', null, '1456138759', null, null, 'obESNjtUHfbCXadBgWow02SsjbwM');
INSERT INTO `ct_jp` VALUES ('138', null, null, '19', null, '1456138969', null, null, 'obESNjo5b50IBbQo_2jCPCJaK-cI');
INSERT INTO `ct_jp` VALUES ('139', null, null, '19', null, '1456139055', null, null, 'obESNjvAU4lAqzi4j6TqRzwnjtDg');
INSERT INTO `ct_jp` VALUES ('140', null, null, '23', null, '1456139232', null, null, 'obESNjryO2ADrK-fE-G9SAKI9cFE');
INSERT INTO `ct_jp` VALUES ('141', null, null, '20', null, '1456139335', null, null, 'obESNjqCKBHzPlciFFkmxa5VfJ1Y');
INSERT INTO `ct_jp` VALUES ('142', null, null, '19', null, '1456140743', null, null, 'obESNjhyvVw7EtinsOPoZeQ4EekU');
INSERT INTO `ct_jp` VALUES ('143', null, null, '20', null, '1456140982', null, null, 'obESNjkzR2tHNq1MGXzLfqMAeD1w');
INSERT INTO `ct_jp` VALUES ('144', null, null, '20', null, '1456142088', null, null, 'obESNjvj57Fxg8UKOMosZtiFXA-M');
INSERT INTO `ct_jp` VALUES ('145', null, null, '3', null, '1456142844', null, null, 'obESNjg4EXWjO-iiLaG58NZI5RL0');

-- ----------------------------
-- Table structure for ct_menu
-- ----------------------------
DROP TABLE IF EXISTS `ct_menu`;
CREATE TABLE `ct_menu` (
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
-- Records of ct_menu
-- ----------------------------

-- ----------------------------
-- Table structure for ct_msg
-- ----------------------------
DROP TABLE IF EXISTS `ct_msg`;
CREATE TABLE `ct_msg` (
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
-- Records of ct_msg
-- ----------------------------
INSERT INTO `ct_msg` VALUES ('1', '', '清除', 'http://z-jc.cn/index.php/Home/Auth/clear', '清除缓存', '0', '1', '1');

-- ----------------------------
-- Table structure for ct_shop
-- ----------------------------
DROP TABLE IF EXISTS `ct_shop`;
CREATE TABLE `ct_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `jl` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ct_shop
-- ----------------------------
INSERT INTO `ct_shop` VALUES ('4', '阿玛尼唇釉+50元妆品专用券', '0', '0', 'syd_20160219112616_165.png', '10');
INSERT INTO `ct_shop` VALUES ('5', '香奈儿CC霜+50元妆品专用券', '0', '0', 'syd_20160219112657_579.png', '10');
INSERT INTO `ct_shop` VALUES ('3', '科颜氏唇膏+50元妆品专用券', '1', '0', 'syd_20160219112504_643.png', '2');
INSERT INTO `ct_shop` VALUES ('6', '雅诗兰黛睫毛膏+50元妆品专用券', '0', '0', 'syd_20160219112730_607.png', '10');
INSERT INTO `ct_shop` VALUES ('7', '迪奥唇膏+50元妆品专用券', '0', '0', 'syd_20160219112801_542.png', '10');
INSERT INTO `ct_shop` VALUES ('8', 'MAKE UP FOREVER水粉+50元妆品专用券', '0', '0', 'syd_20160219112840_485.png', '3');
INSERT INTO `ct_shop` VALUES ('9', 'MAKE UP FOREVER蜜粉 +50元妆品专用券', '0', '0', 'syd_20160219112913_473.png', '10');
INSERT INTO `ct_shop` VALUES ('11', '50元妆品专用券', '76', '0', 'syd_20160219113033_530.png', '5');
INSERT INTO `ct_shop` VALUES ('12', '科颜氏唇膏+50元妆品专用券', '2', '1', 'syd_20160219113113_359.png', '1');
INSERT INTO `ct_shop` VALUES ('13', '阿玛尼唇釉+50元妆品专用券', '0', '1', 'syd_20160219113151_371.png', '10');
INSERT INTO `ct_shop` VALUES ('14', '兰蔻睫毛膏+50元妆品专用券', '0', '1', 'syd_20160219113248_598.png', '10');
INSERT INTO `ct_shop` VALUES ('15', '赫莲娜睫毛膏+50元妆品专用券', '0', '1', 'syd_20160219113352_696.png', '1');
INSERT INTO `ct_shop` VALUES ('16', '阿玛尼大师粉底液+50元妆品专用券', '0', '1', 'syd_20160219113430_402.png', '1');
INSERT INTO `ct_shop` VALUES ('17', '阿玛尼丝绵粉饼（带粉盒）+50元妆品专用券', '0', '1', 'syd_20160219113525_695.png', '10');
INSERT INTO `ct_shop` VALUES ('18', '50元妆品专用券', '21', '1', 'syd_20160219113642_595.png', '8');
INSERT INTO `ct_shop` VALUES ('19', '抽不到', '9845', '0', 'syd_20160222034716_192.gif', '80');
INSERT INTO `ct_shop` VALUES ('20', '抽不到', '9856', '1', 'syd_20160222034716_192.gif', '80');
INSERT INTO `ct_shop` VALUES ('23', '爱慕50元现金抵用券 仅在特卖场使用', '126', '0', 'syd_20160222110446_612.png', '5');
INSERT INTO `ct_shop` VALUES ('24', 'Roots home 全新居家香氛+50元妆品专用券', '5', '0', 'syd_20160222163420_251.png', '2');
INSERT INTO `ct_shop` VALUES ('25', 'Roots home 全新居家香氛+50元妆品专用券', '10', '1', 'syd_20160222163713_413.png', '2');

-- ----------------------------
-- Table structure for ct_user
-- ----------------------------
DROP TABLE IF EXISTS `ct_user`;
CREATE TABLE `ct_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ct_user
-- ----------------------------
INSERT INTO `ct_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '超级管理员', '-1');
