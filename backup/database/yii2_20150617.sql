/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : yii2

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-06-17 13:30:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yii_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `yii_auth_assignment`;
CREATE TABLE `yii_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `yii_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `yii_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_auth_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for yii_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `yii_auth_item`;
CREATE TABLE `yii_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `yii_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `yii_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_auth_item
-- ----------------------------
INSERT INTO `yii_auth_item` VALUES ('admin', '1', '管理员', null, null, '1434515592', '1434515592');
INSERT INTO `yii_auth_item` VALUES ('author', '1', '博客主', null, null, '1434517828', '1434517828');

-- ----------------------------
-- Table structure for yii_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `yii_auth_item_child`;
CREATE TABLE `yii_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `yii_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yii_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yii_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yii_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_auth_item_child
-- ----------------------------

-- ----------------------------
-- Table structure for yii_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `yii_auth_rule`;
CREATE TABLE `yii_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for yii_follow
-- ----------------------------
DROP TABLE IF EXISTS `yii_follow`;
CREATE TABLE `yii_follow` (
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_follow
-- ----------------------------
INSERT INTO `yii_follow` VALUES ('3', '2');
INSERT INTO `yii_follow` VALUES ('4', '3');
INSERT INTO `yii_follow` VALUES ('2', '3');
INSERT INTO `yii_follow` VALUES ('3', '1');
INSERT INTO `yii_follow` VALUES ('3', '5');
INSERT INTO `yii_follow` VALUES ('6', '3');
INSERT INTO `yii_follow` VALUES ('6', '4');
INSERT INTO `yii_follow` VALUES ('4', '5');
INSERT INTO `yii_follow` VALUES ('5', '2');
INSERT INTO `yii_follow` VALUES ('5', '4');
INSERT INTO `yii_follow` VALUES ('5', '6');
INSERT INTO `yii_follow` VALUES ('5', '3');
INSERT INTO `yii_follow` VALUES ('1', '3');
INSERT INTO `yii_follow` VALUES ('1', '2');
INSERT INTO `yii_follow` VALUES ('3', '6');
INSERT INTO `yii_follow` VALUES ('2', '1');
INSERT INTO `yii_follow` VALUES ('4', '1');
INSERT INTO `yii_follow` VALUES ('5', '1');
INSERT INTO `yii_follow` VALUES ('1', '5');

-- ----------------------------
-- Table structure for yii_msg
-- ----------------------------
DROP TABLE IF EXISTS `yii_msg`;
CREATE TABLE `yii_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `send_time` int(11) NOT NULL,
  `reply` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_msg
-- ----------------------------
INSERT INTO `yii_msg` VALUES ('1', '5', '3', '请问下yii2的数据库如何操作', '请问下yii2的数据库如何操作，具体是增删查改怎么处理', '1', '1422704588', '0');
INSERT INTO `yii_msg` VALUES ('2', '5', '3', '我已经关乎你了', '呵呵，我已经关注你了！我们成为好友！', '1', '1422704682', '0');
INSERT INTO `yii_msg` VALUES ('3', '5', '3', '今天晚上看武媚娘大结局', '今天晚上看武媚娘大结局可好？本周就播完了，下周播放活色生香', '1', '1422704951', '0');
INSERT INTO `yii_msg` VALUES ('4', '5', '3', '你觉得laravel框架怎么样？', '我最近已在看laravel,觉得他比yii2要灵活些？大家觉得怎么样？', '1', '1422705046', '0');
INSERT INTO `yii_msg` VALUES ('5', '1', '3', 'yii2数据关联操作', 'yii2数据关联操作与技术实践', '1', '1422782387', '0');
INSERT INTO `yii_msg` VALUES ('6', '3', '1', '消息实时显示测试', '消息实时显示测试消息实时显示测试消息实时显示测试消息实时显示测试消息实时显示测试消息实时显示测试', '1', '1422793408', '0');
INSERT INTO `yii_msg` VALUES ('7', '2', '1', '韩流什么的弱爆了，华流才是最屌的', '周董说过：韩流什么的弱爆了，华流才是最屌的，哎呦！不错哦！', '1', '1422793534', '0');
INSERT INTO `yii_msg` VALUES ('8', '4', '1', 'BAT三巨头抢占移动互联网', '看BAT三巨头抢占移动互联网，入口很重要，占领入口大战一触即发，谁将是最后的王者，让我们拭目以待', '1', '1422793639', '0');
INSERT INTO `yii_msg` VALUES ('9', '5', '1', '响应式网页设计最新框架', '响应式网页设计最新框架越来越流行了，我们选择bootstrap来实现这样的效果', '1', '1422793741', '0');
INSERT INTO `yii_msg` VALUES ('10', '3', '2', 'php消息实时推送问题', '如何有效解决php消息实施推送问题', '1', '1422844371', '0');
INSERT INTO `yii_msg` VALUES ('11', '2', '3', '解决消息回复问题', '如何有效解决解决消息回复问题', '1', '1422844620', '1');
INSERT INTO `yii_msg` VALUES ('12', '2', '3', '习近平亲自主持起草军队政治规定', '2014年12月30日，中共中央向全党全军转发《关于新形势下军队政治工作若干问题的决定》', '1', '1422847618', '0');
INSERT INTO `yii_msg` VALUES ('15', '3', '5', '今天晚上看武媚娘大结局', '非常不错的片子！下周播放活色生香 ，期待~', '1', '1422862139', '1');
INSERT INTO `yii_msg` VALUES ('13', '1', '3', '公务员职级晋升条件出炉:正科满15年享副处待遇', '公务员职级晋升条件出炉:正科满15年享副处待遇', '1', '1422849944', '0');
INSERT INTO `yii_msg` VALUES ('14', '2', '3', 'yii2数据关联操作2', 'yii2数据关联操作2', '1', '1422850149', '0');
INSERT INTO `yii_msg` VALUES ('16', '3', '5', '你觉得laravel框架怎么样？', '我用了下，laravel确实比yii要强大得多啊', '1', '1422862538', '1');
INSERT INTO `yii_msg` VALUES ('17', '5', '3', '你觉得laravel框架怎么样？', '应该是这样大，以后多多交流啊', '0', '1422862863', '1');
INSERT INTO `yii_msg` VALUES ('19', '2', '1', '异步过程中出现的各种问题', 'yii2在异步过程中出现的各种问题，需要高手来解答啊！', '1', '1422863063', '0');
INSERT INTO `yii_msg` VALUES ('20', '1', '2', '韩流什么的弱爆了，华流才是最屌的', '大家都来支持华语流行音乐，华流才能更吊哦！', '1', '1422863139', '1');
INSERT INTO `yii_msg` VALUES ('21', '2', '1', '中国对朝提供8万吨燃油 朝空军训练增加', '中国对朝提供8万吨燃油 朝空军训练增加', '1', '1422863389', '0');
INSERT INTO `yii_msg` VALUES ('22', '1', '2', '中国对朝提供8万吨燃油 朝空军训练增加', '真的是伤不起，像这种独裁国家我们还喂白眼狼！', '1', '1422863469', '1');
INSERT INTO `yii_msg` VALUES ('23', '2', '1', '中国对朝提供8万吨燃油 朝空军训练增加', '是这样的，这样的独裁国家，我们竟然和他做朋友，真是耻辱吧', '1', '1422863557', '1');
INSERT INTO `yii_msg` VALUES ('24', '1', '2', '中国对朝提供8万吨燃油 朝空军训练增加', '可不是吗？不知道领导人咋想的？', '1', '1422863674', '1');
INSERT INTO `yii_msg` VALUES ('25', '1', '5', '司机开车时徒手拔牙 致车辆失控冲下高速公路', '司机开车时徒手拔牙 致车辆失控冲下高速公路,安全重要', '1', '1422863973', '0');
INSERT INTO `yii_msg` VALUES ('26', '5', '1', '司机开车时徒手拔牙 致车辆失控冲下高速公路', '司机开车一定要注意安全，不然就成了马路杀手', '1', '1422864162', '1');
INSERT INTO `yii_msg` VALUES ('27', '1', '3', '非常简洁的后台管理系统模板下载', '非常简洁的后台管理系统模板下载非常简洁的后台管理系统模板下载', '0', '1422865377', '0');
INSERT INTO `yii_msg` VALUES ('28', '1', '3', '实时消息推送检测', '实时消息推送检测实时消息推送检测', '1', '1422871016', '0');
INSERT INTO `yii_msg` VALUES ('29', '1', '3', '实时消息推送检测2', '实时消息推送检测实时消息推送检测2', '0', '1422871113', '0');

-- ----------------------------
-- Table structure for yii_user
-- ----------------------------
DROP TABLE IF EXISTS `yii_user`;
CREATE TABLE `yii_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `password` char(50) NOT NULL,
  `auth_key` char(200) NOT NULL,
  `access_token` char(200) NOT NULL,
  `nickname` varchar(225) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL,
  `group` tinyint(2) unsigned DEFAULT '2',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为可用  2为不可用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_user
-- ----------------------------
INSERT INTO `yii_user` VALUES ('11', 'admin', '36e5aec7682196d6553be3225b591188', 'qC1yKsybSAN0Nr28IqSq3COczWKd8SBt', '', '', '', '', '1434464867', '1434465997', '1', '1');
