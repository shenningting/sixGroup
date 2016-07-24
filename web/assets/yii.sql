/*
Navicat MySQL Data Transfer

Source Server         : 徜徉
Source Server Version : 50547
Source Host           : 123.56.88.15:3306
Source Database       : wtf

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-07-22 08:14:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for we_account
-- ----------------------------
DROP TABLE IF EXISTS `we_account`;
CREATE TABLE `we_account` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `aname` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `appid` varchar(50) NOT NULL,
  `appsecret` varchar(50) NOT NULL,
  `atoken` varchar(50) DEFAULT NULL,
  `atok` varchar(255) DEFAULT NULL,
  `aurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `FK_Relationship_4` (`uid`),
  KEY `FK_Relationship_5` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_account
-- ----------------------------
INSERT INTO `we_account` VALUES ('6', null, '4', '杨先生的个人中心', '阿什顿', 'wx1bebcfb505f84419', '84e118e78bf18814e06f55c1af1fbaba', 'Abd9629fc3ae5e9f6611e2ee05a31cef', '351fq', 'http://123.56.88.15/test/sixGroup/shen.php?gui=351fq');

-- ----------------------------
-- Table structure for we_graphic_reply
-- ----------------------------
DROP TABLE IF EXISTS `we_graphic_reply`;
CREATE TABLE `we_graphic_reply` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `rename` varchar(255) NOT NULL,
  `rekeyword` varchar(255) NOT NULL,
  `grurl` varchar(255) NOT NULL,
  `retitle` varchar(255) DEFAULT NULL,
  `grdesc` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`gid`),
  KEY `FK_Relationship_3` (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_graphic_reply
-- ----------------------------
INSERT INTO `we_graphic_reply` VALUES ('8', '6', 'admin', '嘿嘿', 'upload/28335_205.jpg', '艾氏闭管螈', '劳斯莱斯幻影：http://tieba.baidu.com/p/3283701550');

-- ----------------------------
-- Table structure for we_graphic_reply_older
-- ----------------------------
DROP TABLE IF EXISTS `we_graphic_reply_older`;
CREATE TABLE `we_graphic_reply_older` (
  `grid` int(11) NOT NULL AUTO_INCREMENT,
  `reid` int(11) DEFAULT NULL,
  `grtitle` varchar(50) NOT NULL,
  `grauthor` varchar(20) NOT NULL,
  `grcover` varchar(255) NOT NULL,
  `grinfo` varchar(255) NOT NULL,
  `grsource` varchar(100) NOT NULL,
  PRIMARY KEY (`grid`),
  KEY `FK_Relationship_3` (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_graphic_reply_older
-- ----------------------------

-- ----------------------------
-- Table structure for we_ip_table
-- ----------------------------
DROP TABLE IF EXISTS `we_ip_table`;
CREATE TABLE `we_ip_table` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_ip_table
-- ----------------------------
INSERT INTO `we_ip_table` VALUES ('10', '123.56.88.15');
INSERT INTO `we_ip_table` VALUES ('11', '127.0.0.1');
INSERT INTO `we_ip_table` VALUES ('12', '192.168.1.11');
INSERT INTO `we_ip_table` VALUES ('13', '192.168.1.110');
INSERT INTO `we_ip_table` VALUES ('14', '192.168.1.112');
INSERT INTO `we_ip_table` VALUES ('15', '192.168.1.113');
INSERT INTO `we_ip_table` VALUES ('16', '192.168.1.114');

-- ----------------------------
-- Table structure for we_menu
-- ----------------------------
DROP TABLE IF EXISTS `we_menu`;
CREATE TABLE `we_menu` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `mgrade` varchar(10) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  KEY `FK_Relationship_6` (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_menu
-- ----------------------------
INSERT INTO `we_menu` VALUES ('1', '6', '0', '西雅图', null);
INSERT INTO `we_menu` VALUES ('2', '6', '1', '新的征程', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1bebcfb505f84419&redirect_uri=http%3a%2f%2f123.56.88.15%2ftest%2fsixGroup%2fweb%2findex.php%3fr%3dusers%2fufo&response_type=code&scope=snsapi_userinfo&state=351fq#wechat_redirect');

-- ----------------------------
-- Table structure for we_reply
-- ----------------------------
DROP TABLE IF EXISTS `we_reply`;
CREATE TABLE `we_reply` (
  `reid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `rename` varchar(50) DEFAULT NULL,
  `rekeyword` varchar(50) DEFAULT NULL,
  `retype` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`reid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_reply
-- ----------------------------
INSERT INTO `we_reply` VALUES ('1', '6', '啊', '你好', '1');
INSERT INTO `we_reply` VALUES ('2', '6', '', '你,你是,谁', '1');
INSERT INTO `we_reply` VALUES ('3', '6', '你是', '你，你是，谁', '1');

-- ----------------------------
-- Table structure for we_text_reply
-- ----------------------------
DROP TABLE IF EXISTS `we_text_reply`;
CREATE TABLE `we_text_reply` (
  `trid` int(11) NOT NULL AUTO_INCREMENT,
  `reid` int(11) DEFAULT NULL,
  `trcontent` varchar(255) NOT NULL,
  PRIMARY KEY (`trid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_text_reply
-- ----------------------------
INSERT INTO `we_text_reply` VALUES ('1', '1', '好');
INSERT INTO `we_text_reply` VALUES ('2', '2', '你好,我是莉娜');
INSERT INTO `we_text_reply` VALUES ('3', '2', '对不起');
INSERT INTO `we_text_reply` VALUES ('4', '2', '你个卤蛋');
INSERT INTO `we_text_reply` VALUES ('5', '3', '你是谁？');
INSERT INTO `we_text_reply` VALUES ('6', '3', '谁是谁？');
INSERT INTO `we_text_reply` VALUES ('7', '3', '你好评。');

-- ----------------------------
-- Table structure for we_user
-- ----------------------------
DROP TABLE IF EXISTS `we_user`;
CREATE TABLE `we_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of we_user
-- ----------------------------
INSERT INTO `we_user` VALUES ('4', 'admin', '0192023a7bbd73250516f069df18b500', '13223668161@qq.com');
