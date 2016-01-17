/*
Navicat MySQL Data Transfer

Source Server         : 67
Source Server Version : 50517
Source Host           : 192.168.8.67:3306
Source Database       : vcos_product

Target Server Type    : MYSQL
Target Server Version : 50517
File Encoding         : 65001

Date: 2016-01-15 08:40:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `vcos_activity`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_activity`;
CREATE TABLE `vcos_activity` (
  `activity_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(128) DEFAULT NULL COMMENT '活动名称',
  `activity_desc` varchar(255) DEFAULT NULL COMMENT '活动描述',
  `activity_img` varchar(255) DEFAULT NULL COMMENT '活动封面图',
  `start_time` datetime DEFAULT NULL COMMENT '活动开始时间',
  `end_time` datetime DEFAULT '9999-12-31 23:59:59' COMMENT '活动结束时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(64) DEFAULT NULL COMMENT '创建者',
  `creator_id` int(11) DEFAULT NULL COMMENT '创建者id',
  `is_show_category` tinyint(4) DEFAULT '0' COMMENT '是否显示分类,1、显示',
  `cruise_id` int(11) NOT NULL COMMENT '邮轮id',
  `is_show_head` tinyint(4) DEFAULT '1' COMMENT '是否显示活动头,1显示',
  `is_nav` tinyint(3) unsigned DEFAULT '0' COMMENT '是否是导航1：是0不是',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COMMENT='活动表';

-- ----------------------------
-- Records of vcos_activity
-- ----------------------------
INSERT INTO `vcos_activity` VALUES ('17', '变色口红', '前两百名面单', 'activity_images/201511/201511051422383086.png', '2015-12-23 00:32:00', '2016-04-30 23:32:00', '1', '2015-12-28 09:23:33', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('21', '活动2--快乐吃世界', '全场任选 单件低至16元', 'activity_images/201511/201511051515456221.png', '2015-11-05 00:26:00', '2016-02-18 23:26:00', '1', '2015-12-21 11:37:10', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('25', '店铺1--零食物语', '多种零食', 'activity_images/201511/201511051543486486.png', '2015-11-05 15:53:00', '2016-03-17 15:53:00', '1', '2015-11-09 15:05:40', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('29', '彩妆分会场', '九朵云马油72元起', 'activity_images/201511/201511061504529415.jpg', '2015-11-06 15:14:00', '2015-12-31 15:14:00', '1', '2015-12-14 09:46:21', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('31', '双十一大牌提前购', '全场至低3.3折', 'activity_images/201511/201511061506479409.jpg', '2015-11-11 00:00:00', '2016-02-29 23:00:00', '1', '2015-12-14 09:46:51', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('37', '店铺', '', '', '2015-11-08 14:37:00', '9999-12-31 23:59:59', '1', '2015-12-04 16:05:36', '超级管理员', '1', '0', '1', '0', '1');
INSERT INTO `vcos_activity` VALUES ('39', '活动', '', '', '2015-11-08 14:38:00', '9999-12-31 23:59:59', '1', '2015-12-01 15:32:00', '超级管理员', '1', '0', '1', '0', '1');
INSERT INTO `vcos_activity` VALUES ('45', '商品推荐3', '全自动机械表', 'activity_images/201511/201511091500002283.png', '2015-11-08 00:09:00', '2016-03-16 23:09:00', '1', '2015-12-24 10:17:22', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('47', '店铺--卡米龙双肩包', '卡米龙双肩包', 'activity_images/201511/201511091501119129.png', '2015-12-25 00:10:00', '2016-04-22 23:10:00', '1', '2015-12-24 11:13:53', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('51', '活动推荐3', '运动鞋专卖店', 'activity_images/201511/201511091503163308.png', '2015-11-01 00:13:00', '2016-03-31 23:13:00', '1', '2015-12-14 09:48:44', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('57', '店铺4', '米妮箱', 'activity_images/201511/201511091509023435.png', '2015-11-02 00:18:00', '2016-04-21 23:18:00', '1', '2015-12-24 10:17:42', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('63', '活动4三利毛巾', '满200减50', 'activity_images/201511/201511111033074137.png', '2015-12-25 00:43:00', '2016-04-30 23:43:00', '1', '2015-12-24 11:14:07', '超级管理员', '1', '1', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('69', '换季服饰', '物美价廉', 'activity_images/201511/201511131039168065.jpg', '2015-11-13 10:50:00', '2016-04-26 10:50:00', '1', '2015-12-24 10:18:21', '超级管理员', '1', '0', '1', '1', '0');
INSERT INTO `vcos_activity` VALUES ('75', '商品分类', null, null, '2015-11-30 10:32:47', '9999-12-31 23:59:59', '1', '2015-11-30 10:32:47', '超级管理员', '1', '0', '1', '0', '1');
INSERT INTO `vcos_activity` VALUES ('78', '推荐', null, null, '2015-12-08 16:16:12', '9999-12-31 23:59:59', '1', '2015-12-09 16:16:52', '超级管理员', '1', '0', '1', '1', '1');
INSERT INTO `vcos_activity` VALUES ('80', '用画笔融入自然', '用画笔融入自然', 'activity_images/201512/201512101701388400.png', '2015-12-01 00:12:00', '2016-02-29 23:12:00', '1', '2015-12-15 16:13:01', '超级管理员', '1', '0', '1', '1', '0');

-- ----------------------------
-- Table structure for `vcos_activity_category`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_activity_category`;
CREATE TABLE `vcos_activity_category` (
  `activity_cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id,自增',
  `activity_id` int(10) unsigned NOT NULL COMMENT '活动id',
  `activity_category_name` varchar(32) DEFAULT NULL COMMENT '分类名',
  `sort_order` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  `status` tinyint(4) DEFAULT '1' COMMENT '1可用',
  PRIMARY KEY (`activity_cid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='活动分类表';

-- ----------------------------
-- Records of vcos_activity_category
-- ----------------------------
INSERT INTO `vcos_activity_category` VALUES ('11', '23', '唇膏', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('13', '23', '润肤霜', '2', '1');
INSERT INTO `vcos_activity_category` VALUES ('15', '23', '保湿乳', '2', '1');
INSERT INTO `vcos_activity_category` VALUES ('17', '23', '水润膏', '4', '1');
INSERT INTO `vcos_activity_category` VALUES ('19', '25', '奶粉', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('21', '25', '零食', '2', '1');
INSERT INTO `vcos_activity_category` VALUES ('23', '25', '衣服', '3', '1');
INSERT INTO `vcos_activity_category` VALUES ('25', '25', '鞋包', '4', '1');
INSERT INTO `vcos_activity_category` VALUES ('27', '23', '化妆水/爽肤水', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('29', '17', '面部精华', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('31', '17', '眼部护肤', '2', '1');
INSERT INTO `vcos_activity_category` VALUES ('33', '29', '彩妆修复', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('35', '29', '迷人香水', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('37', '29', '面部彩妆', '2', '1');
INSERT INTO `vcos_activity_category` VALUES ('43', '21', '零食专区', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('45', '33', '面部清洁', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('49', '31', '女装', '1', '1');
INSERT INTO `vcos_activity_category` VALUES ('51', '21', '奶粉专区', '2', '1');
INSERT INTO `vcos_activity_category` VALUES ('53', '69', '衬衫', '1', '1');

-- ----------------------------
-- Table structure for `vcos_activity_product`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_activity_product`;
CREATE TABLE `vcos_activity_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `activity_id` int(10) unsigned NOT NULL COMMENT '活动id',
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  `activity_cid` int(11) DEFAULT NULL COMMENT '活动分类id',
  `sort_order` int(11) NOT NULL COMMENT '排序',
  `start_show_time` datetime DEFAULT NULL COMMENT '开始显示时间',
  `end_show_time` datetime DEFAULT '9999-12-31 23:59:59' COMMENT '结束显示时间',
  `product_type` tinyint(4) NOT NULL COMMENT '1,分类2,品牌3,店铺4,活动5,广告6,商品',
  `is_overdue` tinyint(4) unsigned DEFAULT '0' COMMENT '是否过期,1：过期，0：未过期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1023 DEFAULT CHARSET=utf8 COMMENT='活动商品表';

-- ----------------------------
-- Records of vcos_activity_product
-- ----------------------------
INSERT INTO `vcos_activity_product` VALUES ('61', '21', '41', '43', '4', '2015-11-06 16:20:03', '2015-12-01 16:20:03', '6', '2');
INSERT INTO `vcos_activity_product` VALUES ('63', '31', '57', '49', '1', '2015-11-06 16:23:00', '2016-02-22 16:23:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('143', '21', '79', '51', '5', '2015-12-22 17:37:00', '2016-04-30 17:37:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('177', '69', '61', '0', '1', '2015-11-13 10:51:00', '2015-11-13 10:51:00', '6', '1');
INSERT INTO `vcos_activity_product` VALUES ('179', '69', '61', '53', '1', '2015-11-13 11:09:00', '2015-11-13 11:09:00', '6', '1');
INSERT INTO `vcos_activity_product` VALUES ('444', '78', '21', null, '1', '2015-12-24 11:00:00', '2015-12-28 10:48:00', '4', '1');
INSERT INTO `vcos_activity_product` VALUES ('458', '78', '17', null, '2', '2015-12-23 11:00:00', '2015-12-28 16:16:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('460', '78', '19', null, '3', '2015-12-25 14:07:00', '9999-12-31 23:59:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('472', '21', '133', null, '1', '2015-12-01 16:39:00', '2016-04-30 16:39:00', '6', '1');
INSERT INTO `vcos_activity_product` VALUES ('606', '25', '19', null, '1', '2015-11-29 09:14:00', '2015-11-30 09:14:00', '6', '2');
INSERT INTO `vcos_activity_product` VALUES ('614', '25', '73', null, '5', '2016-01-07 09:14:00', '2016-04-28 09:14:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('640', '80', '19', null, '4', '2015-12-21 10:47:00', '2016-05-31 10:47:00', '6', '1');
INSERT INTO `vcos_activity_product` VALUES ('684', '17', '57', null, '45', '2015-11-29 11:41:00', '2016-06-02 11:41:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('686', '17', '51', null, '1', '2015-12-21 14:44:00', '2015-12-22 14:45:00', '6', '1');
INSERT INTO `vcos_activity_product` VALUES ('742', '39', '17', null, '3', '2015-12-28 09:24:00', '2016-03-31 23:59:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('744', '39', '21', null, '4', '2015-12-16 09:24:00', '2016-01-28 10:16:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('832', '17', '19', null, '5', '2015-12-21 17:31:00', '2016-01-02 10:05:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('848', '37', '7', null, '3', '2015-12-18 10:47:00', '9999-12-31 23:59:00', '3', '0');
INSERT INTO `vcos_activity_product` VALUES ('852', '37', '62', null, '1', '2015-12-18 10:56:00', '9999-12-31 23:59:00', '3', '0');
INSERT INTO `vcos_activity_product` VALUES ('854', '78', '7', null, '2', '2015-12-18 14:00:00', '9999-12-31 23:59:00', '3', '0');
INSERT INTO `vcos_activity_product` VALUES ('864', '78', '49', null, '4', '2015-12-25 14:00:00', '2016-01-15 11:52:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('884', '21', '77', null, '3', '2015-12-21 10:50:00', '2015-12-31 10:50:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('894', '80', '55', null, '3', '2015-12-21 11:35:00', '2016-01-21 11:35:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('896', '80', '49', null, '5', '2015-12-21 11:36:00', '2016-03-31 11:36:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('898', '39', '80', null, '57', '2015-12-21 11:36:00', '2016-02-19 10:00:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('902', '80', '53', null, '2', '2015-12-21 14:12:00', '2016-04-30 17:18:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('906', '37', '3', null, '2', '2015-12-21 16:45:00', '9999-12-31 23:59:00', '3', '0');
INSERT INTO `vcos_activity_product` VALUES ('910', '17', '41', null, '3', '2015-12-23 10:53:00', '2016-01-01 10:27:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('920', '17', '73', null, '10', '2015-12-22 09:11:00', '2016-06-23 09:11:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('922', '17', '75', null, '11', '2015-12-21 09:11:00', '2016-02-05 09:11:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('924', '17', '77', null, '12', '2015-12-22 09:11:00', '2016-04-01 09:11:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('928', '17', '91', null, '14', '2015-12-24 09:12:00', '2016-04-22 09:12:00', '6', '1');
INSERT INTO `vcos_activity_product` VALUES ('934', '17', '115', null, '17', '2015-12-22 09:13:00', '2016-01-01 09:13:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('940', '17', '137', null, '20', '2015-12-22 09:14:00', '2016-02-05 09:14:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('942', '17', '139', null, '21', '2015-12-22 09:14:00', '2016-01-30 09:14:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('946', '17', '172', null, '23', '2015-12-22 09:29:00', '2016-04-29 09:29:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('956', '17', '43', null, '5', '2015-12-22 10:28:00', '2016-03-05 10:28:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('958', '78', '37', null, '5', '2015-12-23 09:39:01', '9999-12-31 23:59:59', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('960', '78', '51', null, '6', '2015-12-23 09:39:01', '9999-12-31 23:59:59', '6', '2');
INSERT INTO `vcos_activity_product` VALUES ('962', '78', '63', null, '12', '2015-12-25 10:19:00', '2016-01-14 10:19:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('966', '78', '3', null, '1', '2015-12-23 17:37:00', '2016-04-02 17:37:00', '3', '0');
INSERT INTO `vcos_activity_product` VALUES ('968', '78', '62', null, '4', '2016-01-13 08:56:00', '2016-04-30 08:57:00', '3', '0');
INSERT INTO `vcos_activity_product` VALUES ('970', '39', '63', null, '4', '2015-12-27 14:02:00', '2016-02-29 10:16:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('972', '21', '73', null, '1', '2015-12-22 14:03:00', '2016-04-30 14:03:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('974', '63', '188', null, '1', '2015-12-22 14:07:00', '2016-01-31 14:07:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('976', '63', '184', null, '2', '2015-12-22 14:09:00', '2016-04-29 14:09:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('978', '78', '9', null, '3', '2015-12-23 17:32:00', '2016-03-25 17:32:00', '3', '2');
INSERT INTO `vcos_activity_product` VALUES ('980', '78', '17', null, '4', '2015-12-23 17:32:00', '2016-05-27 17:32:00', '3', '2');
INSERT INTO `vcos_activity_product` VALUES ('982', '78', '21', null, '5', '2015-12-23 17:32:00', '2016-03-26 17:32:00', '3', '2');
INSERT INTO `vcos_activity_product` VALUES ('984', '78', '23', null, '6', '2015-12-23 17:32:00', '2016-03-25 17:32:00', '3', '2');
INSERT INTO `vcos_activity_product` VALUES ('986', '78', '25', null, '4', '2015-12-24 11:07:00', '2016-01-30 11:07:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('988', '78', '29', null, '3', '2015-12-25 10:10:00', '2015-12-31 10:10:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('990', '78', '31', null, '1', '2015-12-27 16:46:00', '2015-12-30 16:46:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('992', '78', '51', null, '7', '2015-12-24 10:11:00', '2016-02-27 10:11:00', '4', '2');
INSERT INTO `vcos_activity_product` VALUES ('994', '78', '80', null, '8', '2015-12-25 10:14:00', '2016-02-24 10:14:00', '4', '0');
INSERT INTO `vcos_activity_product` VALUES ('996', '78', '45', null, '9', '2015-12-24 10:18:00', '2016-01-08 10:18:00', '4', '2');
INSERT INTO `vcos_activity_product` VALUES ('998', '78', '47', null, '10', '2015-12-26 10:18:00', '2016-03-11 10:19:00', '4', '2');
INSERT INTO `vcos_activity_product` VALUES ('1000', '78', '57', null, '11', '2015-12-24 10:19:00', '2016-03-06 10:19:00', '4', '2');
INSERT INTO `vcos_activity_product` VALUES ('1002', '78', '69', null, '14', '2015-12-24 10:51:00', '2016-02-27 10:51:00', '4', '2');
INSERT INTO `vcos_activity_product` VALUES ('1004', '37', '17', null, '4', '2015-12-28 09:20:00', '2016-02-29 09:20:00', '3', '0');
INSERT INTO `vcos_activity_product` VALUES ('1006', '17', '37', null, '55', '2015-12-31 09:03:00', '2016-02-29 09:03:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('1008', '21', '55', null, '3', '2016-01-12 09:30:00', '2016-01-22 09:31:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('1010', '21', '57', null, '4', '2016-01-12 09:31:00', '2016-05-31 09:31:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('1012', '25', '43', null, '2', '2016-01-11 09:32:00', '2016-04-06 09:32:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('1014', '25', '75', null, '2', '2016-01-12 09:33:00', '2016-01-31 09:33:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('1016', '25', '77', null, '3', '2016-01-12 09:33:00', '2016-04-20 09:33:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('1018', '78', '25', null, '3', '2016-01-13 08:56:00', '2016-03-31 08:56:00', '3', '2');
INSERT INTO `vcos_activity_product` VALUES ('1020', '25', '170', null, '1', '2016-01-13 09:37:00', '2016-02-29 09:37:00', '6', '0');
INSERT INTO `vcos_activity_product` VALUES ('1022', '47', '216', null, '4', '2016-01-14 09:58:00', '2016-09-30 09:58:00', '6', '0');

-- ----------------------------
-- Table structure for `vcos_brand`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_brand`;
CREATE TABLE `vcos_brand` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_cn_name` varchar(128) DEFAULT NULL COMMENT '品牌名',
  `brand_en_name` varchar(128) DEFAULT NULL COMMENT '品牌英文名',
  `country_id` int(11) DEFAULT NULL COMMENT '品牌国家',
  `brand_logo` varchar(128) DEFAULT NULL COMMENT '品牌logo',
  `brand_desc` varchar(255) DEFAULT NULL COMMENT '品牌描述',
  `brand_status` tinyint(4) DEFAULT '1' COMMENT '状态',
  `sort_order` int(11) DEFAULT '99',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Records of vcos_brand
-- ----------------------------
INSERT INTO `vcos_brand` VALUES ('1', '科颜氏', 'Kiehl\'s', '1', 'activity_images/201511/201511061535427295.jpg', 'Kiehls 科颜氏1851年创立于纽约，最初是曼哈顿梨树角的一间药房，160多年的沉淀与革新让其成为全球饱受推崇的药妆品牌，中国粉丝亲切的称其为724。', '1', '1');
INSERT INTO `vcos_brand` VALUES ('7', '葆蝶家', 'BOTTEGA VENETA', '1', 'activity_images/201511/201511041704061669.jpg', 'bottege veneta始创于1966年，有着“意大利爱马仕”之称，旗下产品有最初是皮包扩展至服装、高级珠宝、眼镜、香水、家具及家居用品等不同领域。', '1', '2');
INSERT INTO `vcos_brand` VALUES ('13', '袋鼠', 'Aussie', '1', 'activity_images/201511/201511061536256304.jpg', 'Aussie袋鼠三分钟奇迹发膜，殿堂级的亲民护发品，滋润发质，从里到外，含有野黑硬皮成分，用后能使头发丰盈蓬松，轻松抚平顽固毛躁。', '1', '3');
INSERT INTO `vcos_brand` VALUES ('15', '加州宝宝', 'CALIFORNIA BABY', '1', 'brand_images/201511/201511041701317094.jpg', 'CALIFORNIA BABY，加州宝宝是美国婴儿有机护理领导品牌，所有产品成分都是天然有机的，测试标准达到或超过最高世界标准，是担心宝宝受化学刺激伤害的第一', '1', '4');
INSERT INTO `vcos_brand` VALUES ('17', '美林', 'Mellin', '3', 'brand_images/201511/201511041702315131.jpg', '意大利辅食的代名词，是意大利家喻户晓的婴幼儿食品生产商，拥有自己的天然优质农庄和牧场。', '1', '2');
INSERT INTO `vcos_brand` VALUES ('19', '九朵云', 'Cloud9', '1', 'brand_images/201511/201511041703391465.jpg', '九朵云根据多年临床经验，研究和分析顾客的皮肤问题，为了皮肤的安全决不使用防腐剂，是可以解决多种皮肤问题的无刺激化妆品。', '1', '99');
INSERT INTO `vcos_brand` VALUES ('21', '博柏利', 'BURBERRY ', '5', 'brand_images/201511/201511041705001380.jpg', '过去的几十年，Burberry主要以生产雨衣、伞具及丝巾为主，而今博柏利强调英国传统高贵的设计，赢取无数人的欢心，成为一个永恒的品牌', '1', '99');
INSERT INTO `vcos_brand` VALUES ('23', '菲拉格慕', 'Salvatore Ferragamo 3', '3', 'brand_images/201511/201511041706037815.jpg', '菲拉格慕以制鞋起家，是皮革制品、配件、服装和香氛的世界顶级设计品牌之一。奥黛丽赫本、苏菲亚罗兰、玛丽莲梦露等都曾是他忠实的支持者', '0', '99');
INSERT INTO `vcos_brand` VALUES ('25', '德运', 'DEVONDALE ', '7', 'brand_images/201511/201511041707018231.jpg', '1900年，在澳大利亚的维多利亚省有超过100家的乳制品合作社。1950年，一小部分奶农联合起来形成了今天澳大利亚最大的乳制品合作社。', '0', '99');
INSERT INTO `vcos_brand` VALUES ('27', '健安喜', '健安喜', '1', 'brand_images/201511/201511041708188017.jpg', '始于1935年，美国第一营养品牌，全球最大的综合健康营养品专业品牌。天然的才是最好的，按美国FDA、国际GMP标准制造，通过国际清真食品认证。', '0', '99');
INSERT INTO `vcos_brand` VALUES ('29', '丹尼尔惠灵顿', 'Daniel Wellington ', '7', 'brand_images/201511/201511041709125256.jpg', '将斯堪的纳维亚风格的特色充分展现到设计中，主张保持产品的简约风格，带给人们一种古典而又永恒的时尚魅力', '1', '99');
INSERT INTO `vcos_brand` VALUES ('35', '莎娜', 'SANA', '1', 'activity_images/201511/201511100853227453.jpg', '化妆品护肤品', '1', '99');
INSERT INTO `vcos_brand` VALUES ('37', '伊索', 'VISODATE SERIES', '5', 'activity_images/201511/201511091702066231.png', '高级机械表', '0', '99');
INSERT INTO `vcos_brand` VALUES ('39', '日本果汁', '日本', '9', 'brand_images/201511/201511051456498525.jpg', '营养果汁', '0', '99');
INSERT INTO `vcos_brand` VALUES ('41', '良品铺子', 'Ichiban shop', '2', 'brand_images/201511/201511051458146083.jpg', '坚果类', '1', '99');
INSERT INTO `vcos_brand` VALUES ('43', '三只松鼠', 'Three squirrels ', '2', 'brand_images/201511/201511061535114340.jpg', '值得信赖', '1', '99');
INSERT INTO `vcos_brand` VALUES ('45', '牛栏', 'Holland', '11', 'brand_images/201511/201511061622215852.jpg', '宝宝奶粉', '1', '99');
INSERT INTO `vcos_brand` VALUES ('47', '阿玛尼', 'Armani', '3', 'brand_images/201511/201511061747555592.jpg', 'Armani', '1', '99');
INSERT INTO `vcos_brand` VALUES ('49', '百利威', 'Playwell', '2', 'brand_images/201511/201511091038516898.jpg', '创立于1960年，中国玩具十大品牌之一，特别对开发儿童智力有独到设计思路', '1', '99');
INSERT INTO `vcos_brand` VALUES ('51', '花王', 'KAO', '9', 'brand_images/201511/201511091359185333.png', '花王株式会社成立于1887年，花王前身是西洋杂货店“长濑商店”（花王石碱），主要销售美国产化妆香皂以及日本国产香皂和进口文具等，花王创业人是长濑富郎。目前花王产', '1', '99');
INSERT INTO `vcos_brand` VALUES ('53', 'LG集团', 'LG', '5', 'basic_images/201512/201512101353122180.png', '国LG集团于1947年成立于韩国首尔，位于首尔市永登浦区汝矣岛洞20号。是领导世界产业发展的国际性企业集团。LG集团目前在171个国家与地区建立了300多家海外', '1', '99');
INSERT INTO `vcos_brand` VALUES ('55', '迈克高仕', 'Michael Kros', '1', 'brand_images/201511/201511091403584332.png', 'Michael Kors迈克高仕公司于1981年正式成立，总部设在纽约市。', '1', '99');
INSERT INTO `vcos_brand` VALUES ('57', '伊思', 'its skin', '13', 'brand_images/201511/201511091405227794.png', 'it\'s skin一个护肤品品牌，在2007年获得英国kifus顶级化妆品有限公司技术配方支持，成为韩国时尚品牌新宠，韩国三大化妆品之一', '1', '99');
INSERT INTO `vcos_brand` VALUES ('59', '耐克乔丹', 'Jordan', '1', 'brand_images/201511/201511111542424276.jpg', '乔丹篮球鞋是耐克品牌生产鞋的一种。乔丹的篮球鞋主要适用于篮球爱好者穿着。因为舒适，时尚的设计以及良好的保护性能，深受广大篮球运动爱好者的喜爱。', '1', '99');
INSERT INTO `vcos_brand` VALUES ('61', '安踏', 'ANTA', '2', 'brand_images/201511/201511121609552742.jpg', '永不止步', '1', '99');
INSERT INTO `vcos_brand` VALUES ('63', '123', '汉', '1', 'brand_images/201511/201511121619526996.jpg', '123', '0', '99');
INSERT INTO `vcos_brand` VALUES ('65', '生活健康', 'LG', '9', 'basic_images/201511/201511121648241917.jpg', 'LG生活健康是韩国第二大化妆品集团，韩国最富影响力的日化品牌，1947年成立，隶属于韩国第三大财团LG集团。', '0', '99');
INSERT INTO `vcos_brand` VALUES ('67', '禧贝', 'HAPPY BABY', '1', 'basic_images/201511/201511131338433448.jpg', 'HAPPY BABY （禧贝）是美国本土很受欢迎的品牌，可以说是米粉中最专业的牌子。它是美国婴幼食品的开拓者，专注开发最健康的有机婴幼儿食品。', '1', '99');
INSERT INTO `vcos_brand` VALUES ('69', '如图', '多个132154！', '3', 'basic_images/201511/201511161631397228.jpg', '发送给', '0', '99');
INSERT INTO `vcos_brand` VALUES ('70', '耐克', 'NIKE', '1', 'basic_images/201512/201512101356163330.jpg', 'NIKE是全球著名的体育运动品牌，英文原意指希腊胜利女神，中文译为耐克。公司总部位于美国俄勒冈州Beaverton。公司生产的体育用品包罗万象，例如服装，鞋类。', '1', '99');
INSERT INTO `vcos_brand` VALUES ('72', '第三方', 'abc', '1', 'basic_images/201512/201512141653029142.png', '地方', '0', '99');
INSERT INTO `vcos_brand` VALUES ('74', '健安喜', 'jiananxi', '1', 'basic_images/201512/201512150943457231.jpg', '英格兰英格兰英格兰英格兰英格兰', '0', '99');
INSERT INTO `vcos_brand` VALUES ('76', '健安喜', 'jiananxi', '1', 'basic_images/201512/201512171429384128.jpg', 'jiananxijiananxijiananxijiananxijiananxijiananxijiananxijiananxijiananxijiananxi', '0', '1');
INSERT INTO `vcos_brand` VALUES ('78', '11111', '123', '1', 'basic_images/201512/201512210928503810.png', '123', '0', '123');
INSERT INTO `vcos_brand` VALUES ('80', '1234', '1234', '1', 'basic_images/201512/201512210929376293.png', '123', '0', '123');
INSERT INTO `vcos_brand` VALUES ('82', 'LV', 'LV', '1', 'basic_images/201512/201512301731008765.png', '奢侈品中的贵族', '0', '55');

-- ----------------------------
-- Table structure for `vcos_category`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_category`;
CREATE TABLE `vcos_category` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_code` varchar(32) DEFAULT NULL COMMENT '分类编码',
  `name` varchar(128) DEFAULT NULL COMMENT '分类名',
  `parent_cid` varchar(32) DEFAULT NULL COMMENT '父级编码',
  `sort_order` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=407 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of vcos_category
-- ----------------------------
INSERT INTO `vcos_category` VALUES ('1', '10', '母婴用品', '0', '1', '1');
INSERT INTO `vcos_category` VALUES ('3', '11', '家居生活', '0', '3', '1');
INSERT INTO `vcos_category` VALUES ('5', '1001', '健康辅食', '10', '1', '1');
INSERT INTO `vcos_category` VALUES ('7', '1001001', '米粉米糊', '1001', '1', '1');
INSERT INTO `vcos_category` VALUES ('17', '1101', '厨房电器', '11', '1', '1');
INSERT INTO `vcos_category` VALUES ('19', '1102', '生活电器', '11', '2', '1');
INSERT INTO `vcos_category` VALUES ('21', '1101001', '电压力锅', '1101', '1', '1');
INSERT INTO `vcos_category` VALUES ('23', '1101002', '豆浆机', '1101', '2', '1');
INSERT INTO `vcos_category` VALUES ('25', '1102001', '电风扇', '1102', '1', '1');
INSERT INTO `vcos_category` VALUES ('27', '12', '运动户外', '0', '3', '1');
INSERT INTO `vcos_category` VALUES ('29', '13', '电脑、办公', '0', '4', '1');
INSERT INTO `vcos_category` VALUES ('31', '14', '手机、数码、京东通信', '0', '5', '1');
INSERT INTO `vcos_category` VALUES ('35', '16', '营养保健', '0', '7', '1');
INSERT INTO `vcos_category` VALUES ('37', '17', '服饰鞋包', '0', '8', '1');
INSERT INTO `vcos_category` VALUES ('39', '1201', '运动鞋包', '12', '1', '1');
INSERT INTO `vcos_category` VALUES ('41', '1202', '健身训练', '12', '2', '1');
INSERT INTO `vcos_category` VALUES ('43', '1203', '运动服饰', '12', '3', '1');
INSERT INTO `vcos_category` VALUES ('45', '1201001', '跑步鞋', '1201', '1', '1');
INSERT INTO `vcos_category` VALUES ('47', '1201002', '休闲鞋', '1201', '2', '1');
INSERT INTO `vcos_category` VALUES ('49', '1201003', '拖鞋', '1201', '3', '1');
INSERT INTO `vcos_category` VALUES ('51', '1201004', '专项运动鞋', '1201', '4', '1');
INSERT INTO `vcos_category` VALUES ('53', '1201005', '板鞋', '1201', '5', '1');
INSERT INTO `vcos_category` VALUES ('55', '1202001', '跑步机', '1202', '1', '1');
INSERT INTO `vcos_category` VALUES ('57', '1202002', '哑铃', '1202', '2', '1');
INSERT INTO `vcos_category` VALUES ('59', '1202003', '武术搏击', '1202', '3', '1');
INSERT INTO `vcos_category` VALUES ('61', '1202004', '综合训练术', '1202', '4', '1');
INSERT INTO `vcos_category` VALUES ('63', '1203001', '羽绒服', '1203', '1', '1');
INSERT INTO `vcos_category` VALUES ('65', '1203002', 'T桖', '1203', '2', '1');
INSERT INTO `vcos_category` VALUES ('67', '1203003', '运动套装', '1203', '3', '1');
INSERT INTO `vcos_category` VALUES ('89', '1001003', '饼干', '1001', '3', '1');
INSERT INTO `vcos_category` VALUES ('91', '1001004', '营养品', '1001', '4', '1');
INSERT INTO `vcos_category` VALUES ('93', '1001005', '肉松面仔', '1001', '5', '1');
INSERT INTO `vcos_category` VALUES ('117', '1103', '大家电', '11', '3', '1');
INSERT INTO `vcos_category` VALUES ('119', '1103001', '平板电视', '1103', '1', '1');
INSERT INTO `vcos_category` VALUES ('121', '1103002', '空调', '1103', '2', '1');
INSERT INTO `vcos_category` VALUES ('123', '1301', '电脑整机', '13', '1', '1');
INSERT INTO `vcos_category` VALUES ('125', '1302', '电脑配件', '13', '2', '1');
INSERT INTO `vcos_category` VALUES ('127', '1302001', 'CPU', '1302', '1', '1');
INSERT INTO `vcos_category` VALUES ('129', '1302002', '主板', '1302', '2', '1');
INSERT INTO `vcos_category` VALUES ('133', '1301001', '笔记本', '1301', '1', '1');
INSERT INTO `vcos_category` VALUES ('135', '1301002', '超级本', '1301', '2', '1');
INSERT INTO `vcos_category` VALUES ('137', '1301003', '笔记本配件', '1301', '3', '1');
INSERT INTO `vcos_category` VALUES ('139', '1401', '手机通讯', '14', '1', '0');
INSERT INTO `vcos_category` VALUES ('141', '1402', '京东通讯', '14', '2', '1');
INSERT INTO `vcos_category` VALUES ('143', '1403', '手机配件', '14', '3', '1');
INSERT INTO `vcos_category` VALUES ('145', '1403001', '创意配件', '1403', '1', '1');
INSERT INTO `vcos_category` VALUES ('147', '1403002', '蓝牙耳机', '1403', '3', '1');
INSERT INTO `vcos_category` VALUES ('149', '1402001', '选号中心', '1402', '1', '1');
INSERT INTO `vcos_category` VALUES ('151', '1402002', '自助服务', '1402', '2', '1');
INSERT INTO `vcos_category` VALUES ('153', '1401001', '手机', '1401', '1', '0');
INSERT INTO `vcos_category` VALUES ('155', '1401002', '对讲机', '1401', '2', '0');
INSERT INTO `vcos_category` VALUES ('157', '1403003', '电池/移动电源', '1403', '2', '1');
INSERT INTO `vcos_category` VALUES ('171', '1601', '营养健康', '16', '1', '1');
INSERT INTO `vcos_category` VALUES ('173', '1602', '营养成分', '16', '2', '1');
INSERT INTO `vcos_category` VALUES ('175', '1602001', '维生素/矿物质', '1602', '1', '1');
INSERT INTO `vcos_category` VALUES ('177', '1602002', '蛋白质', '1602', '3', '1');
INSERT INTO `vcos_category` VALUES ('179', '1602003', '牛初乳', '1602', '2', '1');
INSERT INTO `vcos_category` VALUES ('181', '1601001', '调节免疫', '1601', '1', '1');
INSERT INTO `vcos_category` VALUES ('183', '1601002', '骨骼健康', '1601', '2', '1');
INSERT INTO `vcos_category` VALUES ('185', '1701', '女装', '17', '1', '1');
INSERT INTO `vcos_category` VALUES ('187', '1702', '男装', '17', '2', '1');
INSERT INTO `vcos_category` VALUES ('189', '1703', '内衣', '17', '3', '1');
INSERT INTO `vcos_category` VALUES ('191', '1704', '配饰', '17', '4', '1');
INSERT INTO `vcos_category` VALUES ('193', '1704001', '老花镜', '1704', '1', '1');
INSERT INTO `vcos_category` VALUES ('195', '1704002', '真皮手套', '1704', '2', '1');
INSERT INTO `vcos_category` VALUES ('197', '1704003', '毛线帽', '1704', '3', '1');
INSERT INTO `vcos_category` VALUES ('199', '1703001', '保暖内衣', '1703', '1', '1');
INSERT INTO `vcos_category` VALUES ('201', '1703002', '秋衣秋裤', '1703', '2', '1');
INSERT INTO `vcos_category` VALUES ('203', '1703003', '美腿袜', '1703', '3', '1');
INSERT INTO `vcos_category` VALUES ('205', '1702001', '羽绒服', '1702', '1', '1');
INSERT INTO `vcos_category` VALUES ('207', '1702002', '休闲裤', '1702', '2', '1');
INSERT INTO `vcos_category` VALUES ('209', '1702003', '牛仔裤', '1702', '3', '1');
INSERT INTO `vcos_category` VALUES ('211', '1702004', '西服套装', '1702', '4', '1');
INSERT INTO `vcos_category` VALUES ('213', '1701001', '毛呢大衣', '1701', '1', '1');
INSERT INTO `vcos_category` VALUES ('215', '1701002', '针织衫', '1701', '2', '1');
INSERT INTO `vcos_category` VALUES ('217', '1701003', '雪纺衫', '1701', '3', '1');
INSERT INTO `vcos_category` VALUES ('219', '1701004', '牛仔裤', '1701', '4', '1');
INSERT INTO `vcos_category` VALUES ('221', '1701005', '羊毛衫', '1701', '5', '1');
INSERT INTO `vcos_category` VALUES ('239', '1004', '宝宝清洁', '10', '4', '1');
INSERT INTO `vcos_category` VALUES ('241', '1005', '益智玩具', '10', '5', '1');
INSERT INTO `vcos_category` VALUES ('243', '1004001', '洗漱护肤', '1004', '1', '1');
INSERT INTO `vcos_category` VALUES ('245', '1004002', '护理用品', '1004', '2', '1');
INSERT INTO `vcos_category` VALUES ('247', '1104', '口腔护理', '11', '4', '1');
INSERT INTO `vcos_category` VALUES ('249', '1105', '洗发护发', '11', '5', '1');
INSERT INTO `vcos_category` VALUES ('251', '1104001', '牙膏', '1104', '1', '1');
INSERT INTO `vcos_category` VALUES ('253', '1104002', '漱口水', '1104', '2', '1');
INSERT INTO `vcos_category` VALUES ('255', '1104003', '牙刷/牙线', '1104', '3', '1');
INSERT INTO `vcos_category` VALUES ('257', '1105001', '护发素', '1105', '1', '1');
INSERT INTO `vcos_category` VALUES ('259', '1105002', '发膜', '1105', '2', '1');
INSERT INTO `vcos_category` VALUES ('261', '18', '美容彩妆', '0', '2', '1');
INSERT INTO `vcos_category` VALUES ('263', '1801', '护肤', '18', '1', '1');
INSERT INTO `vcos_category` VALUES ('265', '1802', '彩妆', '18', '2', '1');
INSERT INTO `vcos_category` VALUES ('267', '1803', '面膜', '18', '3', '1');
INSERT INTO `vcos_category` VALUES ('269', '19', '进口美食', '0', '9', '1');
INSERT INTO `vcos_category` VALUES ('271', '1901', '人气美味', '19', '1', '1');
INSERT INTO `vcos_category` VALUES ('273', '1902', '地域美食', '19', '2', '1');
INSERT INTO `vcos_category` VALUES ('275', '1801001', '乳液面霜', '1801', '1', '1');
INSERT INTO `vcos_category` VALUES ('277', '1801002', '精华', '1801', '2', '1');
INSERT INTO `vcos_category` VALUES ('279', '1802001', '眼线', '1802', '1', '1');
INSERT INTO `vcos_category` VALUES ('281', '1802002', '美甲', '1802', '2', '1');
INSERT INTO `vcos_category` VALUES ('283', '1803001', '保湿面膜', '1803', '1', '1');
INSERT INTO `vcos_category` VALUES ('285', '1901001', '日韩泡面', '1901', '1', '1');
INSERT INTO `vcos_category` VALUES ('287', '1901002', '奶粉/奶片', '1901', '2', '1');
INSERT INTO `vcos_category` VALUES ('289', '1902001', '纯净澳洲', '1902', '1', '1');
INSERT INTO `vcos_category` VALUES ('291', '1902002', '台湾美食', '1902', '2', '1');
INSERT INTO `vcos_category` VALUES ('293', '1704004', '手表', '1704', '4', '1');
INSERT INTO `vcos_category` VALUES ('295', '1901003', '果汁', '1901', '3', '1');
INSERT INTO `vcos_category` VALUES ('297', '1901004', '零食小吃', '1901', '4', '1');
INSERT INTO `vcos_category` VALUES ('299', '1901005', '热带果干', '1901', '5', '1');
INSERT INTO `vcos_category` VALUES ('301', '1802003', '唇膏', '1802', '4', '1');
INSERT INTO `vcos_category` VALUES ('307', '1001006', '奶粉', '1001', '6', '1');
INSERT INTO `vcos_category` VALUES ('309', '1704005', '项链', '1704', '5', '1');
INSERT INTO `vcos_category` VALUES ('311', '1704006', '墨镜', '1704', '6', '1');
INSERT INTO `vcos_category` VALUES ('313', '1804', '防晒修复', '18', '4', '1');
INSERT INTO `vcos_category` VALUES ('315', '1901006', '咖啡茶饮', '1901', '6', '1');
INSERT INTO `vcos_category` VALUES ('317', '1603', '女性必备', '16', '3', '1');
INSERT INTO `vcos_category` VALUES ('319', '1603001', '减肥瘦身', '1603', '1', '1');
INSERT INTO `vcos_category` VALUES ('321', '1603002', '胶原蛋白', '1603', '2', '1');
INSERT INTO `vcos_category` VALUES ('323', '1603003', '清肠排毒', '1603', '3', '1');
INSERT INTO `vcos_category` VALUES ('325', '1701006', '连衣裙', '1701', '5', '1');
INSERT INTO `vcos_category` VALUES ('327', '1005001', '搭塑胶火车', '1005', '6', '1');
INSERT INTO `vcos_category` VALUES ('329', '1005002', '宝宝零食', '1005', '2', '1');
INSERT INTO `vcos_category` VALUES ('331', '1005003', '宝宝零食', '1005', '2', '1');
INSERT INTO `vcos_category` VALUES ('333', '1006', '宝宝零食', '10', '2', '1');
INSERT INTO `vcos_category` VALUES ('335', '1006001', '薯片', '1006', '2', '1');
INSERT INTO `vcos_category` VALUES ('337', '1006002', '辣条', '1006', '2', '1');
INSERT INTO `vcos_category` VALUES ('339', '1007', '营养添加', '10', '3', '1');
INSERT INTO `vcos_category` VALUES ('341', '1008', '喂哺餐具', '10', '6', '1');
INSERT INTO `vcos_category` VALUES ('343', '20', '纸尿裤', '0', '10', '0');
INSERT INTO `vcos_category` VALUES ('345', '2001', ' Merries ', '20', '1', '0');
INSERT INTO `vcos_category` VALUES ('347', '2002', ' HUGGIES 好奇(韩国) ', '20', '2', '0');
INSERT INTO `vcos_category` VALUES ('349', '2003', 'moony', '20', '3', '0');
INSERT INTO `vcos_category` VALUES ('351', '2004', 'pampers帮宝适（德国）', '20', '4', '0');
INSERT INTO `vcos_category` VALUES ('353', '2005', 'muumi baby 姆明一族', '20', '5', '0');
INSERT INTO `vcos_category` VALUES ('355', '2006', 'libero丽贝乐', '20', '6', '0');
INSERT INTO `vcos_category` VALUES ('357', '1009', '营养奶粉', '10', '7', '1');
INSERT INTO `vcos_category` VALUES ('359', '1704007', '包', '1704', '5', '1');
INSERT INTO `vcos_category` VALUES ('361', '1106', '生活用品', '11', '1', '1');
INSERT INTO `vcos_category` VALUES ('363', '1106001', '毛巾', '1106', '2', '1');
INSERT INTO `vcos_category` VALUES ('365', '1001007', '喂哺餐具', '1001', '7', '1');
INSERT INTO `vcos_category` VALUES ('367', '2001001', 'S', '2001', '2', '0');
INSERT INTO `vcos_category` VALUES ('369', '2001002', 'NB', '2001', '1', '0');
INSERT INTO `vcos_category` VALUES ('371', '2001003', 'M', '2001', '3', '0');
INSERT INTO `vcos_category` VALUES ('373', '2001004', 'L', '2001', '4', '0');
INSERT INTO `vcos_category` VALUES ('375', '2001005', 'XL', '2001', '5', '0');
INSERT INTO `vcos_category` VALUES ('377', '2001006', 'XXL', '2001', '6', '0');
INSERT INTO `vcos_category` VALUES ('379', '2002001', 'NB', '2002', '1', '0');
INSERT INTO `vcos_category` VALUES ('381', '2002002', 'S', '2002', '2', '0');
INSERT INTO `vcos_category` VALUES ('383', '2002003', 'M', '2002', '3', '0');
INSERT INTO `vcos_category` VALUES ('385', '2002004', 'L', '2002', '4', '0');
INSERT INTO `vcos_category` VALUES ('387', '2002005', 'XL', '2002', '5', '0');
INSERT INTO `vcos_category` VALUES ('389', '2002006', 'XXL', '2002', '6', '0');
INSERT INTO `vcos_category` VALUES ('391', '2003001', 'NB', '2003', '1', '0');
INSERT INTO `vcos_category` VALUES ('393', '2003002', 'S', '2003', '2', '0');
INSERT INTO `vcos_category` VALUES ('395', '2003003', 'M', '2003', '3', '0');
INSERT INTO `vcos_category` VALUES ('397', '2003004', 'M', '2003', '4', '0');
INSERT INTO `vcos_category` VALUES ('399', '21', '母婴用品２', '0', '1', '0');
INSERT INTO `vcos_category` VALUES ('401', '1009001', '伊利奶粉', '1009', '1', '1');
INSERT INTO `vcos_category` VALUES ('402', '22', '家居生活１', '0', '3', '0');
INSERT INTO `vcos_category` VALUES ('404', '23', '服装', '0', '1', '0');
INSERT INTO `vcos_category` VALUES ('406', '24', '鞋子', '0', '2', '0');

-- ----------------------------
-- Table structure for `vcos_category_brand`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_category_brand`;
CREATE TABLE `vcos_category_brand` (
  `category_code` varchar(12) NOT NULL,
  `brand_id` int(11) NOT NULL COMMENT '品牌id',
  `cruise_id` int(11) NOT NULL COMMENT '邮轮id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类品牌表';

-- ----------------------------
-- Records of vcos_category_brand
-- ----------------------------

-- ----------------------------
-- Table structure for `vcos_country`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_country`;
CREATE TABLE `vcos_country` (
  `country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_cn_name` varchar(128) DEFAULT NULL COMMENT '国家名',
  `country_en_name` varchar(128) DEFAULT NULL COMMENT '国家英文名',
  `country_code` varchar(2) DEFAULT NULL COMMENT '国家编码',
  `country_short_code` varchar(3) DEFAULT NULL COMMENT '国家短编码',
  `country_number` int(11) DEFAULT NULL COMMENT '国家数字代号',
  `country_logo` varchar(128) DEFAULT NULL COMMENT '国旗logo',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='国家表';

-- ----------------------------
-- Records of vcos_country
-- ----------------------------
INSERT INTO `vcos_country` VALUES ('1', '美国', 'American', null, null, null, 'basic_images/201511/201511130911192491.jpg', '1');
INSERT INTO `vcos_country` VALUES ('2', '中国', 'China', null, null, null, 'basic_images/201511/201511161345048441.png', '1');
INSERT INTO `vcos_country` VALUES ('3', '意大利亚', 'Italy', null, null, null, 'basic_images/201511/201511130911356904.jpg', '1');
INSERT INTO `vcos_country` VALUES ('5', '欧洲', 'Europe', null, null, null, 'basic_images/201511/201511130914483005.jpg', '1');
INSERT INTO `vcos_country` VALUES ('7', '澳大利亚', 'Australia', null, null, null, 'basic_images/201511/201511130911461897.jpg', '1');
INSERT INTO `vcos_country` VALUES ('9', '日本', 'Japan', null, null, null, 'basic_images/201511/201511161345526574.png', '1');
INSERT INTO `vcos_country` VALUES ('11', '荷兰', 'Holland ', null, null, null, 'basic_images/201511/201511130912079106.jpg', '1');
INSERT INTO `vcos_country` VALUES ('13', '韩国', 'Korea', null, null, null, 'basic_images/201511/201511161346381329.png', '1');
INSERT INTO `vcos_country` VALUES ('15', '英国', ' England', null, null, null, 'basic_images/201511/201511161354003428.png', '1');
INSERT INTO `vcos_country` VALUES ('17', '叙利亚', 'Syria', null, null, null, 'basic_images/201511/201511160854053015.jpg', '0');
INSERT INTO `vcos_country` VALUES ('23', '法国', 'France', null, null, null, 'basic_images/201511/201511161344086438.jpg', '0');
INSERT INTO `vcos_country` VALUES ('24', '朝鲜', 'DPRK', null, null, null, 'basic_images/201512/201512150924282180.jpg', '0');
INSERT INTO `vcos_country` VALUES ('26', '英格兰英格兰英格兰英格兰英格兰英格兰英格兰英格兰英格兰英格兰英格兰英格兰英格兰英', 'englishenglishenglishenglishenglishenglishenglishenglishenglishenglishenglishenglishenglishenglishen', null, null, null, 'basic_images/201512/201512171356289637.jpg', '0');
INSERT INTO `vcos_country` VALUES ('28', '新西兰', 'xinxikan', null, null, null, 'basic_images/201512/201512301728036372.jpg', '0');

-- ----------------------------
-- Table structure for `vcos_cruise`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_cruise`;
CREATE TABLE `vcos_cruise` (
  `cruise_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '邮轮ID',
  `cruise_name` varchar(100) NOT NULL COMMENT '邮轮名',
  `cruise_basic_info` text NOT NULL COMMENT '邮轮简介',
  `cruise_detail_info` text NOT NULL COMMENT '邮轮详细信息',
  `cruise_logo_url` varchar(128) DEFAULT NULL,
  `cruise_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮轮状态',
  PRIMARY KEY (`cruise_id`),
  KEY `cruise_state` (`cruise_id`,`cruise_status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='邮轮表';

-- ----------------------------
-- Records of vcos_cruise
-- ----------------------------
INSERT INTO `vcos_cruise` VALUES ('1', '中华泰山号邮轮', '船  名：中华泰山 Chinese Taishan\n隶属于：（香港）渤海邮轮有限公司\n船  籍：巴拿马\n全  长：180.45米\n型  宽：25.5米\n吨  位：25000总吨\n最大航速：28节\n房间数量：416间\n额定载客: 927人\n服务人员：360人 ', '“中华泰山号”由德国制造，船舶总长180.45米，型宽25.5米，总吨位2.45万吨，拥有927个客位；邮轮的各种配套设施完善，剧院、画廊、图书馆、免税店、小教堂等一应俱全，可满足乘客多种生活和娱乐需求。 “中华泰山号”将主要立足于中国周边的亚洲国家开展邮轮业务，航线为5至7天，其中夏季将航行于中国-韩国-日本之间，冬季将航行于台湾地区以及东南亚国家。', null, '0');

-- ----------------------------
-- Table structure for `vcos_navigation`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_navigation`;
CREATE TABLE `vcos_navigation` (
  `navigation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_name` varchar(32) DEFAULT NULL COMMENT '导航名',
  `sort_order` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  `status` tinyint(4) DEFAULT '1' COMMENT '导航状态',
  `navigation_style_type` varchar(10) DEFAULT NULL COMMENT '1活动，2.店铺，3商品',
  `activity_id` int(11) DEFAULT NULL,
  `cruise_id` int(11) DEFAULT NULL COMMENT '邮轮id',
  `is_show` tinyint(4) DEFAULT NULL COMMENT '是否显示',
  `is_category` tinyint(4) DEFAULT NULL COMMENT '是否设置分类',
  `is_main` tinyint(4) DEFAULT NULL COMMENT '是否第一个显示',
  PRIMARY KEY (`navigation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='导航表';

-- ----------------------------
-- Records of vcos_navigation
-- ----------------------------
INSERT INTO `vcos_navigation` VALUES ('1', '推荐', '2', '1', '1,2,3', '78', '1', '1', '0', '1');
INSERT INTO `vcos_navigation` VALUES ('5', '店铺', '1', '1', '2', '37', '1', '1', '0', '0');
INSERT INTO `vcos_navigation` VALUES ('7', '活动', '3', '1', '1', '39', '1', '1', '0', '0');
INSERT INTO `vcos_navigation` VALUES ('29', '商品分类', '1', '1', '', '75', '1', '1', '1', '0');
INSERT INTO `vcos_navigation` VALUES ('32', 'aa', '1', '0', '2', '104', '1', '1', '0', '0');

-- ----------------------------
-- Table structure for `vcos_navigation_group`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_navigation_group`;
CREATE TABLE `vcos_navigation_group` (
  `navigation_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `navigation_id` int(11) DEFAULT NULL COMMENT '导航id',
  `navigation_group_name` varchar(64) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `show_type` tinyint(4) DEFAULT NULL COMMENT '1文字，2图片，3图文',
  `status` tinyint(4) DEFAULT '1' COMMENT '1可用',
  `activity_id` int(11) DEFAULT NULL COMMENT '活动id',
  `img_url` varchar(128) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`navigation_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='导航组表';

-- ----------------------------
-- Records of vcos_navigation_group
-- ----------------------------
INSERT INTO `vcos_navigation_group` VALUES ('13', '29', '家居生活', '17', null, '1', null, 'navigation_images/201512/201512091719395400.png');
INSERT INTO `vcos_navigation_group` VALUES ('14', '29', '母婴用品', '1', null, '1', null, 'navigation_images/201512/201512091649126553.png');
INSERT INTO `vcos_navigation_group` VALUES ('16', '29', '纸尿裤', '15', null, '1', null, 'navigation_images/201512/201512091711039802.png');

-- ----------------------------
-- Table structure for `vcos_navigation_group_brand`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_navigation_group_brand`;
CREATE TABLE `vcos_navigation_group_brand` (
  `navigation_group_bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_group_id` int(11) DEFAULT NULL COMMENT '导航组id',
  `brand_id` int(11) DEFAULT NULL COMMENT '品牌id',
  `sort_order` tinyint(4) DEFAULT NULL COMMENT '排序',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`navigation_group_bid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vcos_navigation_group_brand
-- ----------------------------
INSERT INTO `vcos_navigation_group_brand` VALUES ('1', '79', '1', '6', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('3', '39', '45', '1', '0');
INSERT INTO `vcos_navigation_group_brand` VALUES ('5', '85', '45', '1', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('7', '85', '41', '2', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('9', '87', '15', '2', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('11', '87', '13', '66', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('13', '39', '1', '1', '0');
INSERT INTO `vcos_navigation_group_brand` VALUES ('15', '43', '15', '1', '0');
INSERT INTO `vcos_navigation_group_brand` VALUES ('17', '79', '53', '1', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('19', '85', '51', '3', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('21', '85', '27', '7', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('23', '87', '7', '8', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('25', '85', '29', '54', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('27', '87', '19', '10', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('29', '85', '49', '11', '0');
INSERT INTO `vcos_navigation_group_brand` VALUES ('31', '85', '55', '33', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('33', '79', '47', '1', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('35', '85', '25', '56', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('37', '85', '57', '12', '0');
INSERT INTO `vcos_navigation_group_brand` VALUES ('39', '85', '17', '3', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('41', '85', '21', '12', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('43', '87', '23', '9', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('45', '85', '57', '55', '1');
INSERT INTO `vcos_navigation_group_brand` VALUES ('47', '85', '45', '1', '0');
INSERT INTO `vcos_navigation_group_brand` VALUES ('49', '85', '15', '1', '0');

-- ----------------------------
-- Table structure for `vcos_navigation_group_category`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_navigation_group_category`;
CREATE TABLE `vcos_navigation_group_category` (
  `navigation_group_cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_group_id` int(11) DEFAULT NULL COMMENT '分类id',
  `navigation_category_name` varchar(64) NOT NULL,
  `sort_order` int(11) DEFAULT '99' COMMENT '排序',
  `is_highlight` tinyint(4) DEFAULT '0' COMMENT '亮度，1高亮',
  `category_type` tinyint(4) DEFAULT NULL COMMENT '1分类，2品牌，3店铺，4活动，5广告，6商品',
  `mapping_id` varchar(255) DEFAULT NULL COMMENT '实际分类id(1,2,3)',
  `status` tinyint(4) DEFAULT '1' COMMENT '1启用，2禁用',
  PRIMARY KEY (`navigation_group_cid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='导航分类表';

-- ----------------------------
-- Records of vcos_navigation_group_category
-- ----------------------------
INSERT INTO `vcos_navigation_group_category` VALUES ('17', '13', '羽绒服', '1', '1', '1', '1701001,1701005,1701004', '1');
INSERT INTO `vcos_navigation_group_category` VALUES ('19', '13', '连衣裙', '2', '0', '1', '1701006', '1');
INSERT INTO `vcos_navigation_group_category` VALUES ('20', '16', '日本花王', '1', '0', '1', '2002002,2002001,2002004', '1');
INSERT INTO `vcos_navigation_group_category` VALUES ('22', '16', '德国帮宝适', '2', '0', '1', '2004', '1');
INSERT INTO `vcos_navigation_group_category` VALUES ('24', '14', '健康辅食', '1', '0', '1', '1001001,1001003,1001004,1001005,1001006', '1');
INSERT INTO `vcos_navigation_group_category` VALUES ('26', '14', '宝宝零食', '2', '0', '1', '1006001,1006002', '1');
INSERT INTO `vcos_navigation_group_category` VALUES ('30', '14', '宝宝清洁', '3', '0', '1', '1004002,1004001', '1');

-- ----------------------------
-- Table structure for `vcos_product`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_product`;
CREATE TABLE `vcos_product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_code` varchar(32) DEFAULT NULL COMMENT '商品编码',
  `product_name` varchar(128) DEFAULT NULL COMMENT '商品名',
  `product_desc` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `product_img` varchar(128) DEFAULT NULL COMMENT '商品图片',
  `inventory_num` int(11) DEFAULT NULL COMMENT '商品库存',
  `sale_price` int(11) DEFAULT NULL COMMENT '商品销售价',
  `standard_price` int(11) DEFAULT NULL COMMENT '商品原价',
  `category_code` varchar(12) DEFAULT NULL COMMENT '商品分类code',
  `cruise_id` int(11) DEFAULT NULL COMMENT '邮轮id',
  `shop_id` int(11) DEFAULT NULL COMMENT '商品店铺id',
  `brand_id` int(11) DEFAULT NULL COMMENT '商品品牌id',
  `sale_num` int(11) DEFAULT NULL COMMENT '商品销量',
  `comment_num` int(11) DEFAULT NULL COMMENT '商品评价数',
  `sale_start_time` datetime DEFAULT NULL COMMENT '商品开始销售时间',
  `sale_end_time` datetime DEFAULT '9999-12-31 23:59:59' COMMENT '商品结束销售时间',
  `creator_type` tinyint(4) DEFAULT '1' COMMENT '创建者类型1,店铺员工',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(64) DEFAULT NULL COMMENT '创建者',
  `creator_id` int(11) DEFAULT NULL COMMENT '创建者id',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `origin` varchar(100) DEFAULT NULL COMMENT '产地',
  `is_rubbish` tinyint(4) unsigned DEFAULT '0' COMMENT '是否已经删除',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of vcos_product
-- ----------------------------
INSERT INTO `vcos_product` VALUES ('19', 'SANA003', '豆乳美肌保湿乳液', '美白滋润，保湿不粘腻', 'product_images/201511/201511051357377381.png', '2', '12900', '35000', '1801001', '1', '21', '35', null, null, '2015-12-21 17:18:00', '9999-12-31 23:59:59', '1', '2015-11-03 16:36:44', '超级管理员', '1', '1', '加拿大', '0');
INSERT INTO `vcos_product` VALUES ('37', 'hf002', '巧克力丝滑肤如凝脂护肤水乳', '保湿去皱', 'product_images/201511/201511051407059901.png', '30', '12800', '13000', '1801001', '1', '29', '35', null, null, '2015-12-22 14:18:00', '9999-12-31 23:59:59', '1', '2015-11-05 14:07:05', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('41', 'yl001', '猕猴桃果汁', '果汁', 'product_images/201511/201511051454182736.jpg', '20', '2800', '3600', '1901003', '1', '25', '37', null, null, '2015-12-15 16:23:00', '2016-01-02 10:00:00', '1', '2015-11-05 14:54:18', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('43', 'wy002', '芒果干', '爽口', 'product_images/201511/201511051500586832.png', '200', '2000', '2300', '1901004', '1', '25', '41', null, null, '2015-12-18 15:57:00', '2016-04-22 14:24:00', '1', '2015-11-05 15:00:58', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('49', 'ac001', 'JAPAN 日本品牌口红', '不易褪色', 'product_images/201511/201511051520017783.png', '50', '4200', '4600', '1802003', '1', '17', '1', null, null, '2015-12-15 14:14:00', '2016-03-31 15:28:00', '1', '2015-11-05 15:20:01', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('51', 'ac002', '美国进口高档皮肤滋润膏', '保湿滋润', 'product_images/201511/201511051521243934.png', '300', '5800', '6300', '1801001', '1', '17', '37', null, null, '2015-12-11 14:38:00', '2016-01-02 16:35:00', '1', '2015-11-05 15:21:24', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('53', 'ac003', '韩国绿元素清新润发膏', '让您的头发长久湿润', 'product_images/201511/201511051522511488.png', '50', '4700', '4800', '1801001', '1', '17', '35', null, null, '2015-12-21 09:45:00', '9999-12-31 23:59:59', '1', '2015-11-05 15:22:51', '超级管理员', '1', '1', '韩国', '0');
INSERT INTO `vcos_product` VALUES ('55', 'ac004', '日本进口皮肤水润膏', '让你的皮肤持久保持弹性', 'product_images/201511/201511051523533122.png', '200', '4800', '5000', '1801001', '1', '17', '37', null, null, '2015-12-15 15:38:00', '2016-01-23 15:33:00', '1', '2015-11-05 15:23:53', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('57', 'yf001', '名媛范气质 设计无袖连衣裙 ', '名媛气质', 'product_images/201511/201511101724551491.jpg', '122', '19000', '20000', '1701006', '1', '7', '13', null, null, '2015-11-20 09:41:00', '2016-11-20 09:41:00', '1', '2015-11-06 16:00:42', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('61', 'spbm12345', '阿玛尼', '全球号的奢侈品，提高档次', 'product_images/201511/201511061741171177.png', '122', '500000', '700000', '1701001', '1', '17', '25', null, null, '2015-11-20 09:41:04', '2016-11-20 09:41:04', '1', '2015-11-06 17:41:17', '超级管理员', '1', '0', '英国', '0');
INSERT INTO `vcos_product` VALUES ('65', 'spbm003', '儿童益智游戏搭火车', '有益于儿童开发智力', 'product_images/201511/201511091033341657.jpg', '1000', '5000', '8000', '1005001', '1', '31', '45', null, null, '2015-12-22 16:42:10', '2015-12-22 16:42:10', '1', '2015-11-09 10:33:34', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('71', 'zero001', 'JAPAN JOOS日本猕猴桃果汁', '好吃', 'product_images/201511/201511101141339182.png', '100', '2800', '3600', '1901004', '1', '25', '41', null, null, '2015-12-21 10:43:18', '9999-12-31 23:59:59', '1', '2015-11-10 11:41:33', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('73', 'zero002', '良品铺子 芒果干108g', '便宜', 'product_images/201511/201511101143236545.png', '100', '2000', '2300', '1901004', '1', '25', '41', null, null, '2015-12-15 16:21:00', '9999-12-31 23:59:59', '1', '2015-11-10 11:43:23', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('75', 'zero003', '韩国营养海苔', '好吃', 'product_images/201511/201511101144477256.png', '100', '2800', '3200', '1901004', '1', '25', '41', null, null, '2015-12-16 10:43:00', '2016-02-29 09:51:00', '1', '2015-11-10 11:44:47', '超级管理员', '1', '1', '韩国', '0');
INSERT INTO `vcos_product` VALUES ('77', 'zero004', '日本北海道香脆饼干', '好吃', 'product_images/201511/201511101149132123.png', '100', '2800', '3200', '1901004', '1', '25', '41', null, null, '2015-12-16 10:44:00', '9999-12-31 23:59:59', '1', '2015-11-10 11:49:13', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('79', 'naifen1', 'JAPEN GALS PURE 5 ESSENCE 益智奶粉', '便宜', 'product_images/201511/201511101441435281.png', '12000', '38000', '46000', '1001006', '1', '27', '15', null, null, '2015-12-21 16:10:00', '9999-12-31 23:59:59', '1', '2015-11-10 14:39:01', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('81', '奶粉2', '嘉宝（Gerber）贝启嘉幼儿配方奶粉', '妈妈们的用心之选。取材黄金奶源，益生元组合，有助维持宝宝肠道健康，非常易于消化。营养均衡丰富，给宝宝打下好的基础，适合1岁以上的宝宝。', 'product_images/201511/201511101441228873.png', '1201', '27500', '52000', '1001006', '1', '27', '15', null, null, '2015-12-22 16:43:09', '2015-12-22 16:43:09', '1', '2015-11-10 14:41:22', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('89', 'xuezi', '乔丹', '轻盈耐用，篮球专用', 'product_images/201512/201512161418133443.jpg', '50', '150000', '20000', '1201004', '1', '3', '59', null, null, '2015-12-22 14:55:31', '2015-12-22 14:55:31', '1', '2015-11-10 17:48:51', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('91', '123', '米妮包', '时尚', 'product_images/201511/201511101754499939.jpg', '10', '10000', '12000', '1704007', '1', '9', '1', null, null, '2015-12-30 09:22:00', '2016-11-20 09:41:00', '1', '2015-11-10 17:54:49', '超级管理员', '1', '1', '韩国', '0');
INSERT INTO `vcos_product` VALUES ('93', 'xuezi2', 'NB-new balance', '好看', 'product_images/201511/201511101821359200.jpg', '501', '50000', '70000', '1201001', '1', '3', '21', null, null, '2015-12-28 16:28:00', '9999-12-31 23:59:59', '1', '2015-11-10 18:21:35', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('97', 'wwwww', 'JAPEN GALS PURE 5 ESSENCE 品质奶粉', '便宜', 'product_images/201511/201511101847424736.png', '102', '25000', '28000', '1001006', '1', '27', '15', null, null, '2015-12-22 16:43:09', '2015-12-22 16:43:09', '1', '2015-11-10 18:47:42', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('99', 'naifen22', '美国原生态奶粉-补充婴幼儿成长多种维生素', '便宜', 'product_images/201511/201511101849109707.png', '500', '25000', '281000', '1001001', '1', '27', '15', null, null, '2015-12-22 16:43:09', '2015-12-22 16:43:09', '1', '2015-11-10 18:49:10', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('101', '10000', '芒果汁', '甘甜', 'product_images/201511/201511110948051818.jpg', '100', '1000', '1500', '1901003', '1', '62', '39', null, null, '2015-12-22 16:42:10', '2015-12-22 16:42:10', '1', '2015-11-11 09:48:05', '超级管理员', '1', '1', '菲律宾', '0');
INSERT INTO `vcos_product` VALUES ('103', 'tebu2', '正品特步跑步鞋', '便宜耐用', 'product_images/201511/201511110953457847.jpg', '100', '25000', '30000', '1201001', '1', '3', '23', null, null, '2015-12-28 16:27:00', '9999-12-31 23:59:59', '1', '2015-11-11 09:53:45', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('105', 'anta2', '安踏正品鞋', '便宜正版', 'product_images/201511/201511111002358204.jpg', '500', '19000', '25000', '1201001', '1', '3', '23', null, null, '2015-12-28 16:27:00', '9999-12-31 23:59:59', '1', '2015-11-11 10:02:35', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('107', 'adi1', '正品阿迪达斯', '便宜正品', 'product_images/201511/201511111005382854.jpg', '500', '39000', '45000', '1201001', '1', '3', '23', null, null, '2015-12-15 16:17:00', '2016-01-15 10:30:00', '1', '2015-11-11 10:05:38', '超级管理员', '1', '0', '美国', '0');
INSERT INTO `vcos_product` VALUES ('109', 'naike1', '耐克篮球鞋', '耐用轻盈', 'product_images/201511/201511111022386196.jpg', '100', '50000', '70000', '1201004', '1', '3', '70', null, null, '2015-12-28 16:26:00', '9999-12-31 23:59:59', '1', '2015-11-11 10:22:38', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('111', 'anta21', '安踏篮球鞋', '便宜', 'product_images/201511/201511111024084636.jpg', '300', '29000', '35000', '1201004', '1', '3', '23', null, null, '2015-12-28 16:25:00', '9999-12-31 23:59:59', '1', '2015-11-11 10:24:08', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('113', 'pike1', '匹克篮球鞋', '耐用', 'product_images/201512/201512161355319512.jpg', '500', '35000', '45000', '1201004', '1', '3', '1', null, null, '2015-12-22 14:55:31', '2015-12-22 14:55:31', '1', '2015-11-11 10:25:04', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('115', '100000', '旺旺薯片', '又脆又香', 'product_images/201511/201511111056003351.jpg', '100', '1000', '1500', '1006001', '1', '25', '1', null, null, '2015-12-18 16:09:00', '2016-01-01 09:51:00', '1', '2015-11-11 10:56:00', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('117', 'toy', '儿童玩具智慧屋', '开启孩子的智力', 'product_images/201511/201511111107285391.jpg', '200', '9900', '13000', '1005001', '1', '31', '45', null, null, '2015-12-22 16:42:10', '2015-12-22 16:42:10', '1', '2015-11-11 11:07:28', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('125', 'smart1', '儿童益智玩具搭房子', '开发孩子的智力', 'product_images/201511/201511111444059707.jpg', '300', '10000', '13000', '1005001', '1', '31', '45', null, null, '2015-12-22 16:42:10', '2015-12-22 16:42:10', '1', '2015-11-11 14:44:05', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('127', 'smart1', '儿童益智玩具玻璃球', '开发儿童的智力', 'product_images/201511/201511111448449671.jpg', '300', '6500', '9000', '1005001', '1', '31', '45', null, null, '2015-12-16 16:22:00', '9999-12-31 23:59:59', '1', '2015-11-11 14:48:44', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('129', '0001', '苹果汁', '香甜', 'product_images/201511/201511111531548008.jpg', '100', '1000', '1500', '1901003', '1', '62', '1', null, null, '2015-12-15 17:12:21', '2015-12-15 17:12:21', '1', '2015-11-11 15:31:54', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('131', 'xibei123', '美国禧贝奶粉', 'HAPPY baby 禧贝是来自美国的高端市场领导品牌，百分百的有机原料，不用担心宝宝吃的不健康，而且从小就吃谷物有助于肠胃消化，增强宝宝抵抗力。', 'product_images/201511/201511131352122074.jpg', '100', '5000', '7000', '0', '1', '41', '67', null, null, '2015-12-16 15:27:05', '2015-12-16 15:27:05', '1', '2015-11-13 13:52:12', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('133', '212123', '美国进口禧贝婴幼儿奶粉', '美国高端奶粉', 'product_images/201511/201511131410474438.jpg', '45', '6500', '7500', '1001006', '1', '41', '67', null, null, '2015-12-16 15:27:05', '2015-12-16 15:27:05', '1', '2015-11-13 14:10:47', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('137', '123321', '电压力锅', '妈妈必选煲饭和煲粥神器', 'product_images/201511/201511161037317476.jpg', '847', '90000', '100000', '1101001', '1', '17', '53', null, null, '2015-12-15 15:21:00', '2016-02-26 10:46:00', '1', '2015-11-16 10:37:31', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('139', '122', '开司米快乐微风香水身体乳 400毫升', '韩国国民初恋裴秀智倾情代言品牌，融入独特香水配方的身体乳，超级滋润的一款，属于LG集团强力打造的品牌，所以质量肯定不会差哦！', 'product_images/201512/201512031646318843.jpg', '100', '5800', '6700', '1801001', '1', '17', '13', null, null, '2015-12-03 16:46:00', '9999-12-31 23:59:59', '1', '2015-12-03 16:46:31', '超级管理员', '1', '1', '韩国', '0');
INSERT INTO `vcos_product` VALUES ('162', 'nf001', 'Merries 花王妙而舒 NB 90片/包 4包装 纸尿裤/尿不湿 ', '来自日本的王牌纸尿裤，是受日本国人欢迎的纸尿裤品牌之一，花王纸尿裤注重通气性和柔软性，使用极细纤维柔软内衬棉，尿显精确，防漏护围设计，确保不含甲醛、不用燃料，控', 'product_images/201512/201512080946449115.jpg', '266', '34800', '35600', '1001006', '1', '17', '1', null, null, '2015-12-21 15:53:00', '9999-12-31 23:59:59', '1', '2015-12-08 09:46:44', '超级管理员', '1', '0', '日本', '0');
INSERT INTO `vcos_product` VALUES ('164', 'tuoxie001', '拖鞋', '正品拖鞋 便宜/耐用', 'product_images/201512/201512111136477339.gif', '500', '1500', '1600', '1201003', '1', '35', '47', null, null, '2015-12-15 12:06:00', '2015-12-16 10:15:00', '1', '2015-12-11 11:36:47', '超级管理员', '1', '0', '韩国', '1');
INSERT INTO `vcos_product` VALUES ('166', 'xiezi001', '耐克正品鞋', '好看', 'product_images/201512/201512111349405323.jpg', '200', '150000', '170000', '1201004', '1', '3', '70', null, null, '2015-12-15 16:21:00', '2015-12-24 14:30:00', '1', '2015-12-11 13:49:40', '超级管理员', '1', '1', '美国', '0');
INSERT INTO `vcos_product` VALUES ('168', 'lsgz', 'JAPAN JOOS日本日本猕猴桃果汁', '好喝', 'product_images/201512/201512141352474693.png', '500', '2600', '2800', '1901003', '1', '62', '41', null, null, '2015-12-31 10:03:57', '9999-12-31 23:59:59', '1', '2015-12-14 13:52:47', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('170', 'mangguogan', '良品铺子 芒果干108g', '脆香', 'product_images/201512/201512141622089236.png', '50', '2000', '2300', '1901004', '1', '62', '41', null, null, '2015-12-31 10:03:57', '9999-12-31 23:59:59', '1', '2015-12-14 16:22:08', '超级管理员', '1', '1', '澳洲', '0');
INSERT INTO `vcos_product` VALUES ('172', 'ying-yang-hai-tai', '韩国营养海苔', '营养健康', 'product_images/201512/201512141640098474.png', '200', '3000', '3200', '1901004', '1', '62', '41', null, null, '2015-12-21 16:12:00', '2016-05-24 14:18:00', '1', '2015-12-14 16:40:09', '超级管理员', '1', '1', '韩国', '0');
INSERT INTO `vcos_product` VALUES ('174', 'xiangcuibinggan', '日本北海道香脆饼干', '吃完还想吃', 'product_images/201512/201512141641486055.png', '200', '2900', '3000', '1901004', '1', '62', '41', null, null, '2015-12-22 16:10:00', '9999-12-31 23:59:59', '1', '2015-12-14 16:41:48', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('176', '789456123', '徐福记糖果', '脆香', 'product_images/201512/201512151001085162.jpg', '150', '2300', '2500', '1201001', '1', '66', '41', null, null, '2015-12-21 16:08:01', '2015-12-21 16:08:01', '1', '2015-12-15 10:01:08', '超级管理员', '1', '1', '香港', '0');
INSERT INTO `vcos_product` VALUES ('178', '1212', '订单', '阿萨德发', 'product_images/201512/201512151007293787.jpg', '12', '3200', '12300', '1201001', '1', '61', '1', null, null, '2016-01-14 14:34:18', '2016-01-14 14:34:18', '1', '2015-12-15 10:07:29', '超级管理员', '1', '1', '打', '1');
INSERT INTO `vcos_product` VALUES ('180', 'test011', '迷糊', '小孩迷糊 陪伴你的童年', 'product_images/201512/201512161002066371.jpg', '400', '5400', '5800', '1001001', '1', '72', '1', null, null, '2015-12-22 10:54:00', '9999-12-31 23:59:59', '1', '2015-12-16 10:02:06', '超级管理员', '1', '1', '韩国', '0');
INSERT INTO `vcos_product` VALUES ('182', 'baobao', '德国进口宝宝清洁', '清新自然', 'product_images/201512/201512161007296114.jpg', '400', '5000', '5600', '1004001', '1', '72', '1', null, null, '2015-12-17 17:42:57', '2015-12-17 17:42:57', '1', '2015-12-16 10:07:29', '超级管理员', '1', '1', '德国', '0');
INSERT INTO `vcos_product` VALUES ('184', 'maojin001', 'UCHINO 内野 7件套樱花套装毛巾礼盒 纯棉纱布面巾 婚庆结婚毛巾 礼物', '樱花礼盒组合，内野的经典人气商品，设计精致，粉色系列充满了节日的喜气洋洋。无捻纱材质，将棉花的轻柔蓬松感通过未经加捻的纱直接传达给您，蓬松柔软、吸水性强。该商品', 'product_images/201512/201512161113263885.png', '100', '4500', '5000', '1106001', '1', '29', '47', null, null, '2015-12-18 15:57:00', '2016-04-30 13:51:00', '1', '2015-12-16 11:13:26', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('186', '001', '001', '12', 'product_images/201512/201512161140265540.jpg', '12', '1200', '1200', '1001006', '1', '45', '63', null, null, '2015-12-16 12:00:00', '2015-12-16 12:00:00', '1', '2015-12-16 11:40:26', '超级管理员', '1', '1', '001', '1');
INSERT INTO `vcos_product` VALUES ('188', 'maojin002', 'UCHINO 内野 素色绣字纯棉方巾“6条装”', 'Hello Kitty正版授权，设计灵巧可爱。高档纯棉材质，不易变硬起絮，蓬松柔软、吸水性好。正面纱布，反面毛圈的特别组合，更能呵护您娇嫩的肌肤！该商品由网易秀', 'product_images/201512/201512161145073341.png', '201', '5000', '6000', '1106001', '1', '17', '47', null, null, '2015-12-18 14:00:00', '9999-12-31 23:59:59', '1', '2015-12-16 11:45:07', '超级管理员', '1', '1', '日本', '0');
INSERT INTO `vcos_product` VALUES ('190', '0015', '枕头巾', '柔软', 'product_images/201512/201512161436364337.jpg', '251', '1000', '1500', '1106001', '1', '76', '1', null, null, '2015-12-25 10:12:00', '9999-12-31 23:59:59', '1', '2015-12-16 14:36:36', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('192', '0911', 'aa', 'aa', 'product_images/201512/201512161604578626.jpg', '12', '1200', '1200', '1005001', '1', '76', '1', null, null, '2015-12-21 16:03:32', '2015-12-21 16:03:32', '1', '2015-12-16 16:04:57', '超级管理员', '1', '1', 'aa', '0');
INSERT INTO `vcos_product` VALUES ('194', 'shaungjianbao1', 'Kipling 凯浦林 学院风方形多层双肩包 ', 'Kipling凯浦林，世界著名时尚休闲包袋品牌，1987年创建于比利时安特卫普。 出现在每个手袋、背包或行李箱上的标志性小猴子传递着品牌快乐的精神，成就了独树一', 'product_images/201512/201512170931109919.png', '50', '25000', '29000', '1704007', '1', '7', '29', null, null, '2015-12-17 09:31:00', '9999-12-31 23:59:59', '1', '2015-12-17 09:31:10', '超级管理员', '1', '1', '英国', '0');
INSERT INTO `vcos_product` VALUES ('196', 'shuangjianbao2', 'EMPORIO ARMANI 安普里奥 阿玛尼 男士双肩包 蓝色', 'Giorgio Armani的年轻副牌，运动款剪裁挺拔、配色活泼，最可贵的是，还有点阿玛尼套装的正经劲儿。', 'product_images/201512/201512170938033698.png', '150', '39900', '110000', '1704007', '1', '7', '47', null, null, '2015-12-17 09:38:00', '9999-12-31 23:59:59', '1', '2015-12-17 09:38:03', '超级管理员', '1', '1', '意大利', '0');
INSERT INTO `vcos_product` VALUES ('198', 'lianyiqun1', 'LAP 女款宽松版型圆筒针织布连衣裙 蓝色', '优惠券不可用', 'product_images/201512/201512170953276002.png', '120', '39900', '45000', '1701006', '1', '7', '1', null, null, '2015-12-17 09:53:00', '9999-12-31 23:59:59', '1', '2015-12-17 09:53:27', '超级管理员', '1', '1', '韩国', '0');
INSERT INTO `vcos_product` VALUES ('200', '20151218', '卡诗顿手表', '卡诗顿', 'product_images/201512/201512171652266416.jpg', '100', '40000', '50000', '1704004', '1', '7', '27', null, null, '2015-12-17 16:52:00', '9999-12-31 23:59:59', '1', '2015-12-17 16:52:26', '超级管理员', '1', '0', '中国', '0');
INSERT INTO `vcos_product` VALUES ('202', '110', '123', '123', 'product_images/201512/201512171723403598.jpg', '123', '12300', '12300', '1104001', '1', '31', '63', null, null, '2016-01-14 14:34:27', '2016-01-14 14:34:27', '1', '2015-12-17 17:23:40', '超级管理员', '1', '1', '123', '1');
INSERT INTO `vcos_product` VALUES ('204', 'lsgz1123', '123', '123', 'product_images/201512/201512171724447907.jpg', '123', '12300', '12300', '1001003', '1', '61', '63', null, null, '2016-01-14 14:34:18', '2016-01-14 14:34:18', '1', '2015-12-17 17:24:44', '超级管理员', '1', '1', '123', '1');
INSERT INTO `vcos_product` VALUES ('206', 'lsgz1222', '333', '33', 'product_images/201512/201512171725433485.jpg', '300', '3300', '300', '1001001', '1', '39', '1', null, null, '2016-01-14 14:34:27', '2016-01-14 14:34:27', '1', '2015-12-17 17:25:43', '超级管理员', '1', '1', '3335', '1');
INSERT INTO `vcos_product` VALUES ('208', '0912', 'aa', 'aaa', 'product_images/201512/201512181138507103.jpg', '12', '1200', '1200', '1202003', '1', '9', '39', null, null, '2015-12-18 11:38:50', '9999-12-31 23:59:59', '1', '2015-12-18 11:38:50', '超级管理员', '1', '1', 'aa', '0');
INSERT INTO `vcos_product` VALUES ('210', '20151219', '旺旺雪饼', '1231456', 'product_images/201512/201512181544435770.jpg', '100', '1500', '2000', '1001003', '1', '25', '7', null, null, '2015-12-28 16:29:00', '9999-12-31 23:59:59', '1', '2015-12-18 15:44:43', '超级管理员', '1', '1', '长沙', '0');
INSERT INTO `vcos_product` VALUES ('212', '1231', '123', '12', 'product_images/201512/201512251146503253.jpg', '3', '1200', '1200', '1201001', '1', '39', '1', null, null, '2016-01-14 14:34:18', '2016-01-14 14:34:18', '1', '2015-12-25 11:46:50', '超级管理员', '1', '1', '123', '1');
INSERT INTO `vcos_product` VALUES ('214', 'computer1', '惠普电脑', '好看，快速，便宜', 'product_images/201512/201512301744205321.png', '44', '650000', '700000', '1301001', '1', '84', '65', null, null, '2015-12-30 17:45:59', '9999-12-31 23:59:59', '1', '2015-12-30 17:44:20', '超级管理员', '1', '1', '中国', '0');
INSERT INTO `vcos_product` VALUES ('216', 'MICHAElKORS', 'MICHAEL KORS 迈克高仕 女士手提单肩包', 'Michael Kors和那种纽约甜心的潇洒style，就是美式休闲风~MK的纯色单肩包，比较低调，尺寸大小也适合平时出门逛街，比较休闲的款式，上班背也很适合的', 'product_images/201601/201601140947318427.png', '40', '250000', '270000', '1704007', '1', '7', '55', null, null, '2016-01-14 09:49:00', '9999-12-31 23:59:59', '1', '2016-01-14 09:47:31', '超级管理员', '1', '1', '美国', '0');

-- ----------------------------
-- Table structure for `vcos_product_check`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_product_check`;
CREATE TABLE `vcos_product_check` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `check_code` varchar(255) DEFAULT NULL COMMENT '盘点编号',
  `check_time` datetime DEFAULT NULL COMMENT '盘点时间',
  `check_type` tinyint(3) unsigned DEFAULT '1' COMMENT '盘点类型1.在售2.待售',
  `check_shop` varchar(255) DEFAULT NULL COMMENT '盘点门店',
  `check_people` varchar(255) DEFAULT NULL COMMENT '盘点人',
  PRIMARY KEY (`id`),
  UNIQUE KEY `check_code` (`check_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='盘点主表';

-- ----------------------------
-- Records of vcos_product_check
-- ----------------------------
INSERT INTO `vcos_product_check` VALUES ('44', 'BC2016858827840807', '2016-01-12 16:04:42', '1', null, '超级管理员');
INSERT INTO `vcos_product_check` VALUES ('46', 'BC2016859931689330', '2016-01-12 16:06:33', '1', null, '超级管理员');
INSERT INTO `vcos_product_check` VALUES ('48', 'BC2016912962348023', '2016-01-12 17:34:56', '1', null, '超级管理员');
INSERT INTO `vcos_product_check` VALUES ('50', 'BD2016476040861095', '2016-01-13 09:13:24', '1', null, '超级管理员');
INSERT INTO `vcos_product_check` VALUES ('52', 'BD2016479128449198', '2016-01-13 09:18:32', '1', null, '超级管理员');
INSERT INTO `vcos_product_check` VALUES ('54', 'BD2016538378913634', '2016-01-13 10:57:17', '2', null, '超级管理员');
INSERT INTO `vcos_product_check` VALUES ('56', 'BD2016542907558115', '2016-01-13 11:04:50', '1', null, '超级管理员');

-- ----------------------------
-- Table structure for `vcos_product_check_detail`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_product_check_detail`;
CREATE TABLE `vcos_product_check_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `check_code` varchar(255) DEFAULT NULL COMMENT '盘点编号',
  `product_name` varchar(255) DEFAULT NULL COMMENT '商品名',
  `inventory_num` int(10) unsigned DEFAULT NULL COMMENT '原库存',
  `check_num` int(11) DEFAULT NULL COMMENT '盘点库存',
  `product_code` varchar(255) DEFAULT NULL COMMENT '条码（商品编码）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8 COMMENT='盘点附表';

-- ----------------------------
-- Records of vcos_product_check_detail
-- ----------------------------
INSERT INTO `vcos_product_check_detail` VALUES ('66', 'BC2016858827840807', '电压力锅', '850', '847', '123321');
INSERT INTO `vcos_product_check_detail` VALUES ('68', 'BC2016858827840807', 'UCHINO 内野 7件套樱花套装毛巾礼盒 纯棉纱布面巾 婚庆结婚毛巾 礼物', '100', '100', 'maojin001');
INSERT INTO `vcos_product_check_detail` VALUES ('70', 'BC2016858827840807', 'UCHINO 内野 素色绣字纯棉方巾“6条装”', '200', '201', 'maojin002');
INSERT INTO `vcos_product_check_detail` VALUES ('72', 'BC2016858827840807', '枕头巾', '251', '251', '15');
INSERT INTO `vcos_product_check_detail` VALUES ('74', 'BC2016858827840807', '123', '123', '123', '110');
INSERT INTO `vcos_product_check_detail` VALUES ('76', 'BC2016859931689330', 'NB-new balance', '500', '501', 'xuezi2');
INSERT INTO `vcos_product_check_detail` VALUES ('78', 'BC2016859931689330', '正品特步跑步鞋', '100', '100', 'tebu2');
INSERT INTO `vcos_product_check_detail` VALUES ('80', 'BC2016859931689330', '安踏正品鞋', '500', '500', 'anta2');
INSERT INTO `vcos_product_check_detail` VALUES ('82', 'BC2016859931689330', '正品阿迪达斯', '500', '500', 'adi1');
INSERT INTO `vcos_product_check_detail` VALUES ('84', 'BC2016859931689330', '耐克篮球鞋', '100', '100', 'naike1');
INSERT INTO `vcos_product_check_detail` VALUES ('86', 'BC2016859931689330', '安踏篮球鞋', '300', '300', 'anta21');
INSERT INTO `vcos_product_check_detail` VALUES ('88', 'BC2016859931689330', '订单', '12', '12', '1212');
INSERT INTO `vcos_product_check_detail` VALUES ('90', 'BC2016859931689330', 'aa', '12', '12', '912');
INSERT INTO `vcos_product_check_detail` VALUES ('92', 'BC2016859931689330', '123', '3', '3', '1231');
INSERT INTO `vcos_product_check_detail` VALUES ('94', 'BC2016912962348023', 'NB-new balance', '500', '501', 'xuezi2');
INSERT INTO `vcos_product_check_detail` VALUES ('96', 'BC2016912962348023', '正品特步跑步鞋', '100', '100', 'tebu2');
INSERT INTO `vcos_product_check_detail` VALUES ('98', 'BC2016912962348023', '安踏正品鞋', '500', '500', 'anta2');
INSERT INTO `vcos_product_check_detail` VALUES ('100', 'BC2016912962348023', '正品阿迪达斯', '500', '500', 'adi1');
INSERT INTO `vcos_product_check_detail` VALUES ('102', 'BC2016912962348023', '耐克篮球鞋', '100', '100', 'naike1');
INSERT INTO `vcos_product_check_detail` VALUES ('104', 'BC2016912962348023', '安踏篮球鞋', '300', '300', 'anta21');
INSERT INTO `vcos_product_check_detail` VALUES ('106', 'BC2016912962348023', '订单', '12', '12', '1212');
INSERT INTO `vcos_product_check_detail` VALUES ('108', 'BC2016912962348023', 'aa', '12', '12', '912');
INSERT INTO `vcos_product_check_detail` VALUES ('110', 'BC2016912962348023', '123', '3', '3', '1231');
INSERT INTO `vcos_product_check_detail` VALUES ('112', 'BD2016476040861095', '电压力锅', '847', '847', '123321');
INSERT INTO `vcos_product_check_detail` VALUES ('114', 'BD2016476040861095', 'UCHINO 内野 7件套樱花套装毛巾礼盒 纯棉纱布面巾 婚庆结婚毛巾 礼物', '100', '100', 'maojin001');
INSERT INTO `vcos_product_check_detail` VALUES ('116', 'BD2016476040861095', 'UCHINO 内野 素色绣字纯棉方巾“6条装”', '201', '201', 'maojin002');
INSERT INTO `vcos_product_check_detail` VALUES ('118', 'BD2016476040861095', '枕头巾', '251', '251', '15');
INSERT INTO `vcos_product_check_detail` VALUES ('120', 'BD2016476040861095', '123', '123', '123', '110');
INSERT INTO `vcos_product_check_detail` VALUES ('122', 'BD2016479128449198', '电压力锅', '847', '847', '123321');
INSERT INTO `vcos_product_check_detail` VALUES ('124', 'BD2016479128449198', 'UCHINO 内野 7件套樱花套装毛巾礼盒 纯棉纱布面巾 婚庆结婚毛巾 礼物', '100', '100', 'maojin001');
INSERT INTO `vcos_product_check_detail` VALUES ('126', 'BD2016479128449198', 'UCHINO 内野 素色绣字纯棉方巾“6条装”', '201', '201', 'maojin002');
INSERT INTO `vcos_product_check_detail` VALUES ('128', 'BD2016479128449198', '枕头巾', '251', '251', '15');
INSERT INTO `vcos_product_check_detail` VALUES ('130', 'BD2016479128449198', '123', '123', '123', '110');
INSERT INTO `vcos_product_check_detail` VALUES ('132', 'BD2016538378913634', '儿童益智游戏搭火车', '1000', '1000', 'spbm003');
INSERT INTO `vcos_product_check_detail` VALUES ('134', 'BD2016538378913634', '嘉宝（Gerber）贝启嘉幼儿配方奶粉', '1200', '1201', '奶粉2');
INSERT INTO `vcos_product_check_detail` VALUES ('136', 'BD2016538378913634', 'JAPEN GALS PURE 5 ESSENCE 品质奶粉', '100', '102', 'wwwww');
INSERT INTO `vcos_product_check_detail` VALUES ('138', 'BD2016538378913634', '美国原生态奶粉-补充婴幼儿成长多种维生素', '500', '500', 'naifen22');
INSERT INTO `vcos_product_check_detail` VALUES ('140', 'BD2016538378913634', '旺旺薯片', '100', '100', '100000');
INSERT INTO `vcos_product_check_detail` VALUES ('142', 'BD2016538378913634', '儿童玩具智慧屋', '200', '200', 'toy');
INSERT INTO `vcos_product_check_detail` VALUES ('144', 'BD2016538378913634', '儿童益智玩具搭房子', '300', '300', 'smart1');
INSERT INTO `vcos_product_check_detail` VALUES ('146', 'BD2016538378913634', '美国进口禧贝婴幼儿奶粉', '45', '45', '212123');
INSERT INTO `vcos_product_check_detail` VALUES ('148', 'BD2016538378913634', '德国进口宝宝清洁', '400', '400', 'baobao');
INSERT INTO `vcos_product_check_detail` VALUES ('150', 'BD2016538378913634', '1', '12', '12', '1');
INSERT INTO `vcos_product_check_detail` VALUES ('152', 'BD2016538378913634', 'aa', '12', '12', '911');
INSERT INTO `vcos_product_check_detail` VALUES ('154', 'BD2016542907558115', '电压力锅', '847', '847', '123321');
INSERT INTO `vcos_product_check_detail` VALUES ('156', 'BD2016542907558115', 'UCHINO 内野 7件套樱花套装毛巾礼盒 纯棉纱布面巾 婚庆结婚毛巾 礼物', '100', '100', 'maojin001');
INSERT INTO `vcos_product_check_detail` VALUES ('158', 'BD2016542907558115', 'UCHINO 内野 素色绣字纯棉方巾“6条装”', '201', '201', 'maojin002');
INSERT INTO `vcos_product_check_detail` VALUES ('160', 'BD2016542907558115', '枕头巾', '251', '251', '0015');
INSERT INTO `vcos_product_check_detail` VALUES ('162', 'BD2016542907558115', '123', '123', '123', '110');

-- ----------------------------
-- Table structure for `vcos_product_comment`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_product_comment`;
CREATE TABLE `vcos_product_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_type` tinyint(4) DEFAULT '1' COMMENT '1主评，2追加',
  `product_id` int(11) DEFAULT NULL,
  `comment_content` varchar(255) DEFAULT NULL,
  `crater_time` datetime DEFAULT NULL,
  `member_code` varchar(32) DEFAULT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `score` tinyint(4) DEFAULT NULL COMMENT '评分',
  `url_img1` varchar(128) DEFAULT NULL,
  `url_img2` varchar(128) DEFAULT NULL,
  `url_img3` varchar(128) DEFAULT NULL,
  `url_img4` varchar(128) DEFAULT NULL,
  `is_upload_img` tinyint(4) DEFAULT NULL,
  `is_add_comment` tinyint(4) DEFAULT '0' COMMENT '1有追评',
  `reply_content` varchar(255) DEFAULT NULL,
  `reply_create_time` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1可用，0禁用',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品评论表';

-- ----------------------------
-- Records of vcos_product_comment
-- ----------------------------
INSERT INTO `vcos_product_comment` VALUES ('1', '1', '47', '商品主评论', '2015-11-04 17:49:56', '1', '1', '4', null, null, null, null, '0', '1', '回复1', '2015-11-07 00:35:29', '1');
INSERT INTO `vcos_product_comment` VALUES ('2', '2', '47', '追加评论内容', '2015-11-05 17:50:02', '1', '1', '0', null, null, null, null, '0', '0', '回复1', '2015-11-07 00:35:34', '1');
INSERT INTO `vcos_product_comment` VALUES ('3', '1', '47', '商品主评论', '2015-11-04 17:50:13', '2', '2', '3', null, null, null, null, '0', '1', '回复1', '2015-11-07 00:35:36', '1');
INSERT INTO `vcos_product_comment` VALUES ('4', '2', '47', '追评', '2015-11-05 13:57:27', '1', '1', '0', null, null, null, null, '0', '0', '回复1', '2015-11-07 00:35:39', '1');
INSERT INTO `vcos_product_comment` VALUES ('28', null, null, '', '2015-12-09 10:49:16', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-09 10:49:16', '1');
INSERT INTO `vcos_product_comment` VALUES ('30', '1', '47', '很好', '2015-12-09 10:55:07', null, null, '5', 'Mall/47/201512091055076167.jpg', '', '', '', '0', '0', '回复1', '2015-12-09 10:55:07', '1');
INSERT INTO `vcos_product_comment` VALUES ('32', '1', '47', '很好', '2015-12-09 10:56:36', null, null, '5', 'Mall/47/201512091056369949.jpg', 'Mall/47/201512091056367895.jpg', '', '', '1', '0', '回复1', '2015-12-09 10:56:36', '1');
INSERT INTO `vcos_product_comment` VALUES ('34', '1', '47', '很好', '2015-12-09 10:58:01', null, null, '5', 'Mall/47/201512091058018374.jpg', '', '', '', '1', '0', '回复1', '2015-12-09 10:58:01', '1');
INSERT INTO `vcos_product_comment` VALUES ('36', '1', '47', '很好', '2015-12-09 10:58:16', null, null, '5', '', '', '', '', '0', '0', '回复1', '2015-12-09 10:58:16', '1');
INSERT INTO `vcos_product_comment` VALUES ('38', '1', '47', '很好', '2015-12-09 11:05:39', '010000000203', null, '5', '', '', '', '', '0', '0', '回复1', '2015-12-09 11:05:39', '1');
INSERT INTO `vcos_product_comment` VALUES ('40', '1', '47', '很好', '2015-12-09 11:08:12', '010000000708', null, '5', '', '', '', '', '0', '0', '回复1', '2015-12-09 11:08:12', '1');
INSERT INTO `vcos_product_comment` VALUES ('42', '1', '47', '很好', '2015-12-09 11:09:22', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-09 11:09:22', '1');
INSERT INTO `vcos_product_comment` VALUES ('44', '2', '47', '很好', '2015-12-09 11:09:47', '010000000708', 'abcd', '5', 'Mall/47/201512091109479157.jpg', '', '', '', '1', '0', '回复1', '2015-12-09 11:09:47', '1');
INSERT INTO `vcos_product_comment` VALUES ('46', '2', '47', '很好', '2015-12-10 01:36:58', '010000000708', 'abcd', '5', 'Mall/47/201512100136596703.jpg', 'Mall/47/201512100136594391.jpg', 'Mall/47/201512100136595975.jpg', 'Mall/47/201512100136593240.jpg', '1', '0', '回复1', '2015-12-10 01:36:59', '1');
INSERT INTO `vcos_product_comment` VALUES ('48', '2', '47', '很好', '2015-12-10 03:42:44', '010000000708', 'abcd', '5', '', '', '', '', '0', '0', '回复1', '2015-12-10 03:42:44', '1');
INSERT INTO `vcos_product_comment` VALUES ('50', '2', '47', '很好', '2015-12-10 03:57:16', '010000000708', 'abcd', '5', 'Mall/47/201512100357175522.jpg', '', '', '', '1', '0', '回复1', '2015-12-10 03:57:17', '1');
INSERT INTO `vcos_product_comment` VALUES ('52', '1', '47', '好看', '2015-12-10 03:59:17', '010000010902', null, '5', '', '', '', '', '0', '0', '回复1', '2015-12-10 03:59:17', '1');
INSERT INTO `vcos_product_comment` VALUES ('54', '1', '47', '好看', '2015-12-10 04:00:25', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 04:00:25', '1');
INSERT INTO `vcos_product_comment` VALUES ('56', '1', '47', '好看', '2015-12-10 04:00:55', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 04:00:55', '1');
INSERT INTO `vcos_product_comment` VALUES ('58', null, null, '', '2015-12-10 04:06:36', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 04:06:36', '1');
INSERT INTO `vcos_product_comment` VALUES ('60', '1', '47', '好看', '2015-12-10 04:07:41', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 04:07:41', '1');
INSERT INTO `vcos_product_comment` VALUES ('62', null, null, '', '2015-12-10 04:31:46', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 04:31:46', '1');
INSERT INTO `vcos_product_comment` VALUES ('64', null, null, '', '2015-12-10 04:32:18', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 04:32:18', '1');
INSERT INTO `vcos_product_comment` VALUES ('66', '1', '47', '好看', '2015-12-10 05:43:35', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 05:43:35', '1');
INSERT INTO `vcos_product_comment` VALUES ('68', '1', '47', '好看', '2015-12-10 05:43:43', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 05:43:43', '1');
INSERT INTO `vcos_product_comment` VALUES ('70', '1', '47', '好看', '2015-12-10 05:44:58', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 05:44:58', '1');
INSERT INTO `vcos_product_comment` VALUES ('72', '1', '47', '好看', '2015-12-10 05:46:52', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 05:46:52', '1');
INSERT INTO `vcos_product_comment` VALUES ('74', '1', '47', '好看', '2015-12-10 05:52:11', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 05:52:11', '1');
INSERT INTO `vcos_product_comment` VALUES ('76', '1', '47', '好看', '2015-12-10 05:57:01', '010000000708', 'abcd', '5', '', '', '', '', '0', '1', '回复1', '2015-12-10 05:57:01', '1');
INSERT INTO `vcos_product_comment` VALUES ('78', '1', '47', '好看', '2015-12-10 05:59:30', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 05:59:30', '1');
INSERT INTO `vcos_product_comment` VALUES ('80', '1', '48', '很好Very nice ', '2015-12-10 06:01:51', '010000000708', 'abcd', '5', 'Mall/48/201512100601514658.jpg', null, null, null, '1', '1', '回复1', '2015-12-10 06:01:51', '1');
INSERT INTO `vcos_product_comment` VALUES ('82', '2', '48', '很好Very nice ', '2015-12-10 06:02:58', '010000000708', 'abcd', '5', 'Mall/48/201512100602584779.jpg', null, null, null, '1', '0', '回复1', '2015-12-10 06:02:58', '1');
INSERT INTO `vcos_product_comment` VALUES ('84', '1', '47', '好看', '2015-12-10 06:10:24', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:10:24', '1');
INSERT INTO `vcos_product_comment` VALUES ('86', '1', '47', '好看', '2015-12-10 06:17:34', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:17:34', '1');
INSERT INTO `vcos_product_comment` VALUES ('88', '1', '47', '好看', '2015-12-10 06:18:40', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:18:40', '1');
INSERT INTO `vcos_product_comment` VALUES ('90', '1', '47', '好看', '2015-12-10 06:19:24', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:19:24', '1');
INSERT INTO `vcos_product_comment` VALUES ('92', '1', '47', '好看', '2015-12-10 06:19:58', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:19:58', '1');
INSERT INTO `vcos_product_comment` VALUES ('94', '1', '47', '好看', '2015-12-10 06:20:37', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:20:37', '1');
INSERT INTO `vcos_product_comment` VALUES ('96', '1', '47', '好看', '2015-12-10 06:20:54', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:20:54', '1');
INSERT INTO `vcos_product_comment` VALUES ('98', '1', '47', '好看', '2015-12-10 06:28:22', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:28:22', '1');
INSERT INTO `vcos_product_comment` VALUES ('100', '1', '47', '好看', '2015-12-10 06:32:09', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:32:09', '1');
INSERT INTO `vcos_product_comment` VALUES ('102', '1', '47', '好看', '2015-12-10 06:32:36', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:32:36', '1');
INSERT INTO `vcos_product_comment` VALUES ('104', '1', '47', '好看', '2015-12-10 06:32:51', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:32:51', '1');
INSERT INTO `vcos_product_comment` VALUES ('106', '1', '47', '好看', '2015-12-10 06:33:08', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:33:08', '1');
INSERT INTO `vcos_product_comment` VALUES ('108', '1', '47', '好看', '2015-12-10 06:34:45', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:34:45', '1');
INSERT INTO `vcos_product_comment` VALUES ('110', '1', '47', '好看', '2015-12-10 06:37:31', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:37:31', '1');
INSERT INTO `vcos_product_comment` VALUES ('112', '1', '47', '好看', '2015-12-10 06:41:37', '010000000708', 'abcd', '5', '', null, null, 'a:0:{}', '0', '1', '回复1', '2015-12-10 06:41:37', '1');
INSERT INTO `vcos_product_comment` VALUES ('114', '1', '47', '好看', '2015-12-10 06:41:51', '010000000708', 'abcd', '5', '', null, null, 'a:0:{}', '0', '1', '回复1', '2015-12-10 06:41:51', '1');
INSERT INTO `vcos_product_comment` VALUES ('116', '1', '47', '好看', '2015-12-10 06:41:55', '010000000708', 'abcd', '5', '', null, null, 'a:0:{}', '0', '1', '回复1', '2015-12-10 06:41:55', '1');
INSERT INTO `vcos_product_comment` VALUES ('118', '1', '47', '好看', '2015-12-10 06:42:20', '010000000708', 'abcd', '5', '', null, null, 'a:0:{}', '0', '1', '回复1', '2015-12-10 06:42:20', '1');
INSERT INTO `vcos_product_comment` VALUES ('120', '1', '47', '好看', '2015-12-10 06:42:41', '010000000708', 'abcd', '5', '', null, null, 'a:0:{}', '0', '1', '回复1', '2015-12-10 06:42:41', '1');
INSERT INTO `vcos_product_comment` VALUES ('122', '1', '47', '好看', '2015-12-10 06:43:00', '010000000708', 'abcd', '5', '', null, null, 'a:0:{}', '0', '1', '回复1', '2015-12-10 06:43:01', '1');
INSERT INTO `vcos_product_comment` VALUES ('124', '1', '47', '好看', '2015-12-10 06:51:03', '010000000708', 'abcd', '5', '', null, null, null, '0', '1', '回复1', '2015-12-10 06:51:03', '1');
INSERT INTO `vcos_product_comment` VALUES ('126', null, null, '', '2015-12-10 07:28:46', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:28:46', '1');
INSERT INTO `vcos_product_comment` VALUES ('128', '1', '47', '好看', '2015-12-10 07:35:25', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 07:35:25', '1');
INSERT INTO `vcos_product_comment` VALUES ('130', null, null, '', '2015-12-10 07:44:00', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:44:00', '1');
INSERT INTO `vcos_product_comment` VALUES ('132', null, null, '', '2015-12-10 07:44:03', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:44:03', '1');
INSERT INTO `vcos_product_comment` VALUES ('134', null, null, '', '2015-12-10 07:44:37', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:44:37', '1');
INSERT INTO `vcos_product_comment` VALUES ('136', '2', '48', '很好Very nice ', '2015-12-10 07:46:22', '010000000708', 'abcd', '5', null, null, null, null, '0', '0', '回复1', '2015-12-10 07:46:22', '1');
INSERT INTO `vcos_product_comment` VALUES ('138', '1', '47', '好看', '2015-12-10 07:48:42', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 07:48:42', '1');
INSERT INTO `vcos_product_comment` VALUES ('140', '1', '47', '好看', '2015-12-10 07:49:13', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 07:49:13', '1');
INSERT INTO `vcos_product_comment` VALUES ('142', null, null, '', '2015-12-10 07:49:27', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:49:27', '1');
INSERT INTO `vcos_product_comment` VALUES ('144', null, null, '', '2015-12-10 07:49:33', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:49:33', '1');
INSERT INTO `vcos_product_comment` VALUES ('146', null, null, '', '2015-12-10 07:49:38', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:49:38', '1');
INSERT INTO `vcos_product_comment` VALUES ('148', null, null, '', '2015-12-10 07:50:18', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:50:18', '1');
INSERT INTO `vcos_product_comment` VALUES ('150', '2', '48', '很好Very nice ', '2015-12-10 07:50:40', '010000000708', 'abcd', '5', null, null, null, null, '0', '0', '回复1', '2015-12-10 07:50:40', '1');
INSERT INTO `vcos_product_comment` VALUES ('152', '1', '47', '好看', '2015-12-10 07:51:27', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 07:51:27', '1');
INSERT INTO `vcos_product_comment` VALUES ('154', '1', '47', '好看', '2015-12-10 07:51:36', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 07:51:36', '1');
INSERT INTO `vcos_product_comment` VALUES ('156', '2', '48', '很好Very nice ', '2015-12-10 07:52:21', '010000000708', 'abcd', '5', null, null, null, null, '0', '0', '回复1', '2015-12-10 07:52:21', '1');
INSERT INTO `vcos_product_comment` VALUES ('158', null, null, '', '2015-12-10 07:53:13', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:53:13', '1');
INSERT INTO `vcos_product_comment` VALUES ('160', null, null, '', '2015-12-10 07:53:34', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 07:53:34', '1');
INSERT INTO `vcos_product_comment` VALUES ('162', '1', '47', 'ok?', '2015-12-10 07:53:57', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 07:53:57', '1');
INSERT INTO `vcos_product_comment` VALUES ('164', '1', '47', 'ok?', '2015-12-10 07:54:31', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 07:54:32', '1');
INSERT INTO `vcos_product_comment` VALUES ('166', '2', '48', '很好Very nice ', '2015-12-10 07:55:53', '010000000708', 'abcd', '5', null, null, null, null, '0', '0', '回复1', '2015-12-10 07:55:53', '1');
INSERT INTO `vcos_product_comment` VALUES ('168', '2', '48', '很好Very nice ', '2015-12-10 08:01:40', '010000000708', 'abcd', '5', null, null, null, null, '0', '0', '回复1', '2015-12-10 08:01:40', '1');
INSERT INTO `vcos_product_comment` VALUES ('170', '1', '47', 'ok?', '2015-12-10 08:02:24', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:02:24', '1');
INSERT INTO `vcos_product_comment` VALUES ('172', '1', '47', 'ok?', '2015-12-10 08:03:22', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:03:22', '1');
INSERT INTO `vcos_product_comment` VALUES ('174', '1', '47', 'ok?', '2015-12-10 08:03:36', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:03:36', '1');
INSERT INTO `vcos_product_comment` VALUES ('176', '1', '47', 'ok?', '2015-12-10 08:04:33', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:04:34', '1');
INSERT INTO `vcos_product_comment` VALUES ('178', '1', '47', 'ok?', '2015-12-10 08:05:42', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:05:42', '1');
INSERT INTO `vcos_product_comment` VALUES ('180', null, null, '', '2015-12-10 08:11:09', '', '', null, null, null, null, null, '0', '0', '回复1', '2015-12-10 08:11:09', '1');
INSERT INTO `vcos_product_comment` VALUES ('182', '1', '47', 'ok?', '2015-12-10 08:20:43', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:20:43', '1');
INSERT INTO `vcos_product_comment` VALUES ('184', '1', '47', 'ok?', '2015-12-10 08:24:06', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:24:06', '1');
INSERT INTO `vcos_product_comment` VALUES ('186', '1', '47', 'ok?', '2015-12-10 08:25:03', '010000000708', 'abcd', '5', null, null, null, null, '0', '1', '回复1', '2015-12-10 08:25:03', '1');
INSERT INTO `vcos_product_comment` VALUES ('188', null, null, '', '2015-12-10 09:16:08', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 09:16:08', '1');
INSERT INTO `vcos_product_comment` VALUES ('190', null, null, '', '2015-12-10 09:32:44', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 09:32:44', '1');
INSERT INTO `vcos_product_comment` VALUES ('192', '2', '48', '很好Very nice ', '2015-12-10 09:33:14', '010000000708', 'abcd', '5', 'Mall/48/', 'Mall/48/', 'Mall/48/', 'Mall/48/', '1', '0', '回复1', '2015-12-10 09:33:14', '1');
INSERT INTO `vcos_product_comment` VALUES ('194', '2', '48', '很好Very nice ', '2015-12-10 09:37:07', '010000000708', 'abcd', '5', 'Mall/48/201512100937078787.png', 'Mall/48/201512100937079565.png', 'Mall/48/201512100937076461.png', 'Mall/48/201512100937075119.png', '1', '0', '回复1', '2015-12-10 09:37:07', '1');
INSERT INTO `vcos_product_comment` VALUES ('196', '1', '47', 'ok?', '2015-12-10 09:38:12', '010000000708', 'abcd', '5', 'Mall/47/201512100938125781.png', 'Mall/47/201512100938125851.png', 'Mall/47/201512100938126319.png', 'Mall/47/201512100938121191.png', '1', '1', '回复1', '2015-12-10 09:38:12', '1');
INSERT INTO `vcos_product_comment` VALUES ('198', '1', '47', 'ok?', '2015-12-10 09:38:52', '010000000708', 'abcd', '5', 'Mall/47/201512100938525348.png', '', '', '', '1', '1', '回复1', '2015-12-10 09:38:52', '1');
INSERT INTO `vcos_product_comment` VALUES ('200', '1', '47', 'ok?', '2015-12-10 09:45:39', '010000000708', 'abcd', '5', 'Mall/47/201512100945397759.png', '', '', '', '1', '1', '回复1', '2015-12-10 09:45:39', '1');
INSERT INTO `vcos_product_comment` VALUES ('202', '1', '47', 'ok?', '2015-12-10 09:53:17', '010000000708', 'abcd', '5', 'Mall/47/201512100953174114.png', '', '', '', '1', '1', '回复1', '2015-12-10 09:53:17', '1');
INSERT INTO `vcos_product_comment` VALUES ('204', null, null, '', '2015-12-10 09:56:11', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 09:56:11', '1');
INSERT INTO `vcos_product_comment` VALUES ('206', '2', '48', '很好Very nice ', '2015-12-10 09:57:05', '010000000708', 'abcd', '5', 'Mall/48/201512100957058846.png', 'Mall/48/201512100957059820.png', 'Mall/48/201512100957054608.png', 'Mall/48/201512100957057581.png', '1', '0', '回复1', '2015-12-10 09:57:05', '1');
INSERT INTO `vcos_product_comment` VALUES ('208', '2', '48', '很好Very nice ', '2015-12-10 10:00:36', '010000000708', 'abcd', '5', 'Mall/48/201512101000364223.png', 'Mall/48/201512101000366659.png', 'Mall/48/201512101000366084.png', 'Mall/48/201512101000365642.png', '1', '0', '回复1', '2015-12-10 10:00:36', '1');
INSERT INTO `vcos_product_comment` VALUES ('210', null, null, '', '2015-12-10 10:04:33', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 10:04:33', '1');
INSERT INTO `vcos_product_comment` VALUES ('212', null, null, '', '2015-12-10 10:05:38', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 10:05:38', '1');
INSERT INTO `vcos_product_comment` VALUES ('214', null, null, '', '2015-12-10 10:06:38', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 10:06:38', '1');
INSERT INTO `vcos_product_comment` VALUES ('216', null, null, '', '2015-12-10 10:07:48', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 10:07:48', '1');
INSERT INTO `vcos_product_comment` VALUES ('218', null, null, '', '2015-12-10 10:08:22', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 10:08:22', '1');
INSERT INTO `vcos_product_comment` VALUES ('220', null, null, '', '2015-12-10 10:08:56', '', '', null, '', '', '', '', '0', '0', '回复1', '2015-12-10 10:08:56', '1');
INSERT INTO `vcos_product_comment` VALUES ('222', '1', '46', '和描述一样', '2015-12-11 02:34:08', '010000009798', null, '4', 'Mall/46/201512110234083094.png', '', '', '', '1', '0', '回复1', '2015-12-11 02:34:08', '1');
INSERT INTO `vcos_product_comment` VALUES ('224', '1', '46', '和描述一样', '2015-12-11 02:40:06', '010000009798', null, '4', 'Mall/46/201512110240062685.png', 'Mall/46/201512110240064232.png', 'Mall/46/201512110240066027.png', 'Mall/46/201512110240065996.png', '1', '0', '回复1', '2015-12-11 02:40:06', '1');
INSERT INTO `vcos_product_comment` VALUES ('226', '1', '47', 'ok?', '2015-12-17 11:22:01', '010000000708', 'abcd', '5', 'Mall/47/201512171122016685.png', 'Mall/47/201512171122014339.png', 'Mall/47/201512171122018821.png', 'Mall/47/201512171122019583.png', '1', '1', '回复1', '2015-12-17 11:22:01', '1');
INSERT INTO `vcos_product_comment` VALUES ('228', '1', '47', 'ok?', '2015-12-17 11:23:12', '010000000708', 'abcd', '5', 'Mall/47/201512171123124932.png', 'Mall/47/201512171123122986.png', 'Mall/47/201512171123129811.png', 'Mall/47/201512171123121930.png', '1', '1', '回复1', '2015-12-17 11:23:12', '1');
INSERT INTO `vcos_product_comment` VALUES ('230', '1', '47', 'ok?', '2015-12-17 11:24:31', '010000000708', 'abcd', '5', 'Mall/47/201512171124316658.png', 'Mall/47/201512171124311995.png', 'Mall/47/201512171124315916.png', 'Mall/47/201512171124318434.png', '1', '1', '回复1', '2015-12-17 11:24:31', '1');
INSERT INTO `vcos_product_comment` VALUES ('232', '1', '47', 'ok?', '2015-12-17 11:25:12', '010000000708', 'abcd', '5', 'Mall/47/201512171125129732.png', 'Mall/47/201512171125127472.png', 'Mall/47/201512171125121951.png', 'Mall/47/201512171125121182.png', '1', '1', '回复1', '2015-12-17 11:25:12', '1');
INSERT INTO `vcos_product_comment` VALUES ('234', '1', '47', 'ok?', '2015-12-21 16:15:56', '010000000708', 'abcd', '5', 'Mall/47/201512211615572593.png', 'Mall/47/201512211615573809.png', 'Mall/47/201512211615571584.png', 'Mall/47/201512211615575540.png', '1', '1', '回复1', '2015-12-21 16:15:57', '1');
INSERT INTO `vcos_product_comment` VALUES ('236', '1', '47', 'ok?', '2015-12-25 16:51:52', '010000000708', 'abcd', '5', 'Mall/47/201512251651525736.png', 'Mall/47/201512251651529694.png', 'Mall/47/201512251651522837.png', 'Mall/47/201512251651524526.png', '1', '1', '回复1', '2015-12-25 16:51:52', '1');
INSERT INTO `vcos_product_comment` VALUES ('238', '1', '47', 'ok?', '2015-12-28 15:31:21', '010000000708', 'abcd', '5', 'Mall/47/201512281531217518.png', 'Mall/47/201512281531212714.png', 'Mall/47/201512281531211170.png', 'Mall/47/201512281531219038.png', '1', '1', '回复1', '2015-12-28 15:31:21', '1');
INSERT INTO `vcos_product_comment` VALUES ('240', '1', '47', 'ok?', '2015-12-30 11:25:09', '010000000708', 'abcd', '5', 'Mall/47/201512301125096019.png', 'Mall/47/201512301125091827.png', 'Mall/47/201512301125092552.png', 'Mall/47/201512301125094958.png', '1', '1', '回复1', '2015-12-30 11:25:09', '1');
INSERT INTO `vcos_product_comment` VALUES ('242', '1', '47', 'ok?', '2015-12-30 11:26:02', '010000000708', 'abcd', '5', 'Mall/47/201512301126026952.png', 'Mall/47/201512301126029475.png', 'Mall/47/201512301126026261.png', 'Mall/47/201512301126021967.png', '1', '1', '回复1', '2015-12-30 11:26:02', '1');
INSERT INTO `vcos_product_comment` VALUES ('244', '1', '47', 'ok?', '2015-12-30 11:27:51', '010000000708', 'abcd', '5', 'Mall/47/201512301127513630.png', 'Mall/47/201512301127514366.png', 'Mall/47/201512301127515764.png', 'Mall/47/201512301127518098.png', '1', '1', '回复1', '2015-12-30 11:27:51', '1');
INSERT INTO `vcos_product_comment` VALUES ('246', '1', '47', 'ok?', '2015-12-30 11:28:25', '010000000708', 'abcd', '5', 'Mall/47/201512301128259770.png', 'Mall/47/201512301128258423.png', 'Mall/47/201512301128255079.png', 'Mall/47/201512301128254666.png', '1', '1', '回复1', '2015-12-30 11:28:25', '1');
INSERT INTO `vcos_product_comment` VALUES ('248', '1', '47', 'ok?', '2015-12-30 11:31:21', '010000000708', 'abcd', '5', 'Mall/47/201512301131213799.png', 'Mall/47/201512301131214395.png', 'Mall/47/201512301131217214.png', 'Mall/47/201512301131216202.png', '1', '1', '回复1', '2015-12-30 11:31:21', '1');
INSERT INTO `vcos_product_comment` VALUES ('250', '1', '47', 'ok?', '2015-12-30 11:32:54', '010000000708', 'abcd', '5', 'Mall/47/201512301132548627.png', 'Mall/47/201512301132546830.png', 'Mall/47/201512301132547370.png', 'Mall/47/201512301132542423.png', '1', '1', '回复1', '2015-12-30 11:32:54', '1');
INSERT INTO `vcos_product_comment` VALUES ('252', '1', '47', 'ok?', '2015-12-30 11:35:16', '010000000708', 'abcd', '5', 'Mall/47/201512301135166230.png', 'Mall/47/201512301135163886.png', 'Mall/47/201512301135164228.png', 'Mall/47/201512301135167457.png', '1', '1', '回复1', '2015-12-30 11:35:16', '1');
INSERT INTO `vcos_product_comment` VALUES ('262', '1', '73', '121313', '2015-12-31 16:23:25', '010000009798', null, null, 'Mall/73/', 'Mall/73/', 'Mall/73/', 'Mall/73/', '1', '0', '回复1', '2015-12-31 16:23:26', '1');
INSERT INTO `vcos_product_comment` VALUES ('264', '1', '73', '121313', '2015-12-31 16:24:21', '010000009798', null, '5', 'Mall/73/', 'Mall/73/', 'Mall/73/', 'Mall/73/', '1', '0', '回复1', '2015-12-31 16:24:21', '1');
INSERT INTO `vcos_product_comment` VALUES ('266', '1', '73', '121313', '2015-12-31 16:26:22', '010000009798', null, null, '', '', '', '', '0', '0', '回复1', '2015-12-31 16:26:22', '1');
INSERT INTO `vcos_product_comment` VALUES ('268', '1', '73', '121313', '2015-12-31 16:26:38', '010000009798', null, '3', '', '', '', '', '0', '0', '回复1', '2015-12-31 16:26:38', '1');
INSERT INTO `vcos_product_comment` VALUES ('270', '1', '73', '看看', '2015-12-31 16:27:17', '010000009798', null, '5', '', '', '', '', '0', '0', '回复1', '2015-12-31 16:27:17', '1');
INSERT INTO `vcos_product_comment` VALUES ('272', '1', '73', '卡机', '2015-12-31 16:41:57', '010000009798', null, '5', '', '', '', '', '0', '0', '回复1', '2015-12-31 16:41:57', '1');
INSERT INTO `vcos_product_comment` VALUES ('274', '1', '73', '121313', '2015-12-31 16:48:17', '010000009798', null, '3', 'Mall/73/201512311648173194.png', 'Mall/73/', 'Mall/73/', 'Mall/73/', '1', '0', '回复1', '2015-12-31 16:48:17', '1');
INSERT INTO `vcos_product_comment` VALUES ('276', '1', '73', '121313', '2015-12-31 16:49:01', '010000009798', null, '3', 'Mall/73/201512311649027215.png', 'Mall/73/', 'Mall/73/', 'Mall/73/', '1', '0', '回复1', '2015-12-31 16:49:02', '1');
INSERT INTO `vcos_product_comment` VALUES ('278', '1', '73', '121313', '2015-12-31 16:51:20', '010000009798', null, '3', 'Mall/73/201512311651201497.png', 'Mall/73/', 'Mall/73/', 'Mall/73/', '1', '0', '回复1', '2015-12-31 16:51:20', '1');
INSERT INTO `vcos_product_comment` VALUES ('280', '1', '73', '121313', '2015-12-31 16:55:04', '010000009798', null, '3', 'Mall/73/201512311655053542.png', '', 'Mall/73/', 'Mall/73/', '1', '0', '回复1', '2015-12-31 16:55:05', '1');
INSERT INTO `vcos_product_comment` VALUES ('282', '1', '73', '121313', '2015-12-31 16:55:45', '010000009798', null, '3', 'Mall/73/201512311655454764.png', '', '', '', '1', '0', '回复1', '2015-12-31 16:55:45', '1');
INSERT INTO `vcos_product_comment` VALUES ('284', '1', '73', '卡卡', '2015-12-31 16:56:37', '010000009798', null, '5', 'Mall/73/201512311656374511.png', '', '', '', '1', '0', '回复1', '2015-12-31 16:56:37', '1');
INSERT INTO `vcos_product_comment` VALUES ('286', '1', '73', '火花', '2015-12-31 17:10:30', '010000009798', null, '5', 'Mall/73/201512311710305022.png', '', '', '', '1', '0', '回复1', '2015-12-31 17:10:30', '1');
INSERT INTO `vcos_product_comment` VALUES ('288', '1', '73', '啦啦啦', '2015-12-31 17:30:45', '010000009798', null, '5', 'Mall/73/201512311730456321.png', '', '', '', '1', '0', '回复1', '2015-12-31 17:30:45', '1');
INSERT INTO `vcos_product_comment` VALUES ('290', '1', '73', '来来来', '2015-12-31 17:35:19', '010000009798', null, '5', 'Mall/73/201512311735191980.png', '', '', '', '1', '0', '回复1', '2015-12-31 17:35:19', '1');
INSERT INTO `vcos_product_comment` VALUES ('292', '1', '73', '金将军', '2015-12-31 17:43:00', '010000009798', null, '5', 'Mall/73/201512311743006810.png', '', '', '', '1', '0', '回复1', '2015-12-31 17:43:00', '1');
INSERT INTO `vcos_product_comment` VALUES ('294', '1', '73', '晋级赛', '2015-12-31 17:49:11', '010000009798', null, '5', 'Mall/73/201512311749118758.png', '', '', '', '1', '0', '回复1', '2015-12-31 17:49:11', '1');
INSERT INTO `vcos_product_comment` VALUES ('296', '1', '73', '你睡吧', '2015-12-31 17:51:19', '010000009798', null, '5', 'Mall/73/201512311751197033.png', '', '', '', '1', '0', '回复1', '2015-12-31 17:51:19', '1');
INSERT INTO `vcos_product_comment` VALUES ('298', '1', '73', '看看', '2015-12-31 18:00:22', '010000009798', null, '5', 'Mall/73/201512311800227147.png', '', '', '', '1', '0', '回复1', '2015-12-31 18:00:22', '1');
INSERT INTO `vcos_product_comment` VALUES ('300', '1', '47', 'ok?', '2016-01-06 15:58:59', '010000000708', 'abcd', '5', 'Mall/47/201601061558593599.png', 'Mall/47/201601061558597120.png', 'Mall/47/201601061558593608.png', 'Mall/47/201601061558591095.png', '1', '0', '回复1', '2016-01-06 15:58:59', '1');

-- ----------------------------
-- Table structure for `vcos_product_detail`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_product_detail`;
CREATE TABLE `vcos_product_detail` (
  `product_detail_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  `text_detail` text COMMENT '商品文本详情',
  `graphic_detail` text COMMENT '商品图文详情',
  PRIMARY KEY (`product_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='商品详情表';

-- ----------------------------
-- Records of vcos_product_detail
-- ----------------------------
INSERT INTO `vcos_product_detail` VALUES ('11', '19', '<p>不管你每天的饮食如何，每日一颗复合维生素，是一种营养摄入平衡的保障，也是一种健康的“廉价保险”。美国诸多医生和营养学家都推荐每日一颗复合维生素，善存复合维生素家庭装，给全家健康投保。</p>', '');
INSERT INTO `vcos_product_detail` VALUES ('15', '19', '<p>不管你每天的饮食如何，每日一颗复合维生素，是一种营养摄入平衡的保障，也是一种健康的“廉价保险”。美国诸多医生和营养学家都推荐每日一颗复合维生素，善存复合维生素家庭装，给全家健康投保</p>', '');
INSERT INTO `vcos_product_detail` VALUES ('21', '19', '<p>美白滋润，保湿不粘腻<br/></p>', '');
INSERT INTO `vcos_product_detail` VALUES ('27', '57', '<h3 class=\"tb-main-title\" data-title=\"【双11限量5折】西西小可定制款 名媛范气质 设计无袖连衣裙 包邮\">双11限量5折</h3><p><br/></p>', '');
INSERT INTO `vcos_product_detail` VALUES ('29', '61', '<p>阿玛尼是世界知名奢侈品牌，1975年由时尚设计大师乔治·阿玛尼（Giorgio Armani）创立于意大利米兰，乔治·阿玛尼是在美国销量最大的欧洲设计师品牌，他以使用新型面料及优良制作而闻名。&nbsp;&nbsp; <br/></p>', '');
INSERT INTO `vcos_product_detail` VALUES ('35', '73', '<p></p><p>芒果干108g<br/></p>', '');
INSERT INTO `vcos_product_detail` VALUES ('41', '81', '<p>丹麦顶级纸尿裤闪电来“吸”，3-6千克宝宝通用。更轻更薄，3重干爽透气，防漏锁水。天然防过敏材料，顶级绵柔表层。完美贴合裁剪，拒绝O型腿，妈妈们囤货必收款哦。<br/></p>', '');

-- ----------------------------
-- Table structure for `vcos_product_graphic`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_product_graphic`;
CREATE TABLE `vcos_product_graphic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `img_url` varchar(128) DEFAULT NULL,
  `graphic_desc` varchar(255) DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vcos_product_graphic
-- ----------------------------
INSERT INTO `vcos_product_graphic` VALUES ('1', '19', 'product_images/201511/201511051438241395.jpg', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('7', '19', 'product_images/201511/201511051438371170.jpg', '', '2');
INSERT INTO `vcos_product_graphic` VALUES ('9', '19', 'product_images/201511/201511051438496948.jpg', '', '3');
INSERT INTO `vcos_product_graphic` VALUES ('11', '19', 'product_images/201511/201511051439017349.jpg', '', '4');
INSERT INTO `vcos_product_graphic` VALUES ('13', '19', 'product_images/201511/201511051442136686.jpg', '', '5');
INSERT INTO `vcos_product_graphic` VALUES ('15', '19', 'product_images/201511/201511051442238450.jpg', '', '6');
INSERT INTO `vcos_product_graphic` VALUES ('17', '19', 'product_images/201511/201511051442353844.jpg', '', '7');
INSERT INTO `vcos_product_graphic` VALUES ('19', '19', 'product_images/201511/201511051442466997.jpg', '', '8');
INSERT INTO `vcos_product_graphic` VALUES ('21', '19', 'product_images/201511/201511051442572368.jpg', '', '9');
INSERT INTO `vcos_product_graphic` VALUES ('23', '19', 'product_images/201511/201511051443097176.jpg', '', '10');
INSERT INTO `vcos_product_graphic` VALUES ('39', '43', 'product_images/201511/201511051550333641.jpg', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('41', '43', 'product_images/201511/201511051550421993.jpg', '', '2');
INSERT INTO `vcos_product_graphic` VALUES ('43', '43', 'product_images/201511/201511051555148202.jpg', '', '3');
INSERT INTO `vcos_product_graphic` VALUES ('45', '43', 'product_images/201511/201511051555249678.jpg', '', '4');
INSERT INTO `vcos_product_graphic` VALUES ('47', '43', 'product_images/201511/201511051555361596.jpg', '', '5');
INSERT INTO `vcos_product_graphic` VALUES ('49', '49', 'product_images/201511/201511051558303976.jpg', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('53', '57', 'product_images/201511/201511061603166618.jpg', null, '1');
INSERT INTO `vcos_product_graphic` VALUES ('55', '57', 'product_images/201511/201511061603315828.jpg', null, '2');
INSERT INTO `vcos_product_graphic` VALUES ('57', '57', 'product_images/201511/201511061603442936.jpg', null, '3');
INSERT INTO `vcos_product_graphic` VALUES ('59', '57', 'product_images/201511/201511061603574217.jpg', null, '4');
INSERT INTO `vcos_product_graphic` VALUES ('75', '49', 'product_images/201601/201601141141112911.png', '顶级口红', '2');
INSERT INTO `vcos_product_graphic` VALUES ('77', '81', 'product_images/201511/201511101447305868.jpg', null, '0');
INSERT INTO `vcos_product_graphic` VALUES ('79', '81', 'product_images/201511/201511101447503071.jpg', null, '-1');
INSERT INTO `vcos_product_graphic` VALUES ('81', '81', 'product_images/201511/201511101448207647.jpg', null, '22');
INSERT INTO `vcos_product_graphic` VALUES ('85', '81', 'product_images/201511/201511101449137722.jpg', null, '23');
INSERT INTO `vcos_product_graphic` VALUES ('87', '81', 'product_images/201511/201511101449287071.jpg', null, '3');
INSERT INTO `vcos_product_graphic` VALUES ('89', '81', 'product_images/201511/201511101449436743.jpg', null, '4');
INSERT INTO `vcos_product_graphic` VALUES ('91', '81', 'product_images/201511/201511101449598524.jpg', null, '5');
INSERT INTO `vcos_product_graphic` VALUES ('93', '81', 'product_images/201511/201511101450267654.jpg', null, '6');
INSERT INTO `vcos_product_graphic` VALUES ('95', '81', 'product_images/201511/201511101450427662.jpg', null, '7');
INSERT INTO `vcos_product_graphic` VALUES ('97', '81', 'product_images/201511/201511101451028876.jpg', null, '8');
INSERT INTO `vcos_product_graphic` VALUES ('103', '81', 'product_images/201511/201511111648124426.jpg', null, '9');
INSERT INTO `vcos_product_graphic` VALUES ('105', '81', 'product_images/201511/201511111648328788.jpg', null, '10');
INSERT INTO `vcos_product_graphic` VALUES ('107', '81', 'product_images/201511/201511111649327049.jpg', null, '11');
INSERT INTO `vcos_product_graphic` VALUES ('109', '81', 'product_images/201511/201511111649485233.jpg', null, '12');
INSERT INTO `vcos_product_graphic` VALUES ('111', '81', 'product_images/201511/201511111650072804.jpg', null, '13');
INSERT INTO `vcos_product_graphic` VALUES ('113', '81', 'product_images/201511/201511111650276340.jpg', null, '14');
INSERT INTO `vcos_product_graphic` VALUES ('115', '81', 'product_images/201511/201511111650434003.jpg', null, '15');
INSERT INTO `vcos_product_graphic` VALUES ('117', '81', 'product_images/201511/201511111651091999.jpg', null, '16');
INSERT INTO `vcos_product_graphic` VALUES ('119', '81', 'product_images/201511/201511111651308603.jpg', null, '17');
INSERT INTO `vcos_product_graphic` VALUES ('121', '81', 'product_images/201511/201511111651477553.jpg', null, '18');
INSERT INTO `vcos_product_graphic` VALUES ('123', '81', 'product_images/201511/201511111652052303.jpg', null, '19');
INSERT INTO `vcos_product_graphic` VALUES ('125', '81', 'product_images/201511/201511111652269585.jpg', null, '20');
INSERT INTO `vcos_product_graphic` VALUES ('127', '81', 'product_images/201511/201511111652425168.jpg', null, '21');
INSERT INTO `vcos_product_graphic` VALUES ('142', '170', 'product_images/201512/201512141623553830.jpg', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('144', '170', 'product_images/201512/201512141624069799.jpg', '', '2');
INSERT INTO `vcos_product_graphic` VALUES ('146', '170', 'product_images/201512/201512141624125945.jpg', '', '3');
INSERT INTO `vcos_product_graphic` VALUES ('148', '170', 'product_images/201512/201512141624226539.jpg', '', '4');
INSERT INTO `vcos_product_graphic` VALUES ('150', '170', 'product_images/201512/201512141624368873.jpg', '', '5');
INSERT INTO `vcos_product_graphic` VALUES ('152', '190', 'product_images/201512/201512161437258463.jpg', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('154', '196', 'product_images/201512/201512170940538961.png', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('156', '196', 'product_images/201512/201512170941044745.png', '', '2');
INSERT INTO `vcos_product_graphic` VALUES ('158', '196', 'product_images/201512/201512170942341904.png', '', '3');
INSERT INTO `vcos_product_graphic` VALUES ('160', '196', 'product_images/201512/201512170946448865.png', '', '4');
INSERT INTO `vcos_product_graphic` VALUES ('162', '196', 'product_images/201512/201512170946555843.png', '', '5');
INSERT INTO `vcos_product_graphic` VALUES ('164', '196', 'product_images/201512/201512170947086719.png', '', '6');
INSERT INTO `vcos_product_graphic` VALUES ('166', '196', 'product_images/201512/201512170947242909.png', '', '7');
INSERT INTO `vcos_product_graphic` VALUES ('168', '196', 'product_images/201512/201512170947379779.png', '', '8');
INSERT INTO `vcos_product_graphic` VALUES ('170', '196', 'product_images/201512/201512170947474725.png', '', '9');
INSERT INTO `vcos_product_graphic` VALUES ('172', '198', 'product_images/201512/201512171001128767.png', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('174', '198', 'product_images/201512/201512171011204429.png', '', '2');
INSERT INTO `vcos_product_graphic` VALUES ('176', '198', 'product_images/201512/201512171013149759.png', '', '5');
INSERT INTO `vcos_product_graphic` VALUES ('178', '198', 'product_images/201512/201512171014117398.png', '', '6');
INSERT INTO `vcos_product_graphic` VALUES ('180', '198', 'product_images/201512/201512171015232288.png', '', '7');
INSERT INTO `vcos_product_graphic` VALUES ('182', '198', 'product_images/201512/201512171020082078.png', '', '8');
INSERT INTO `vcos_product_graphic` VALUES ('184', '198', 'product_images/201512/201512171020191245.png', '', '9');
INSERT INTO `vcos_product_graphic` VALUES ('186', '198', 'product_images/201512/201512171020313606.png', '', '10');
INSERT INTO `vcos_product_graphic` VALUES ('188', '198', 'product_images/201512/201512171020534447.png', '', '11');
INSERT INTO `vcos_product_graphic` VALUES ('190', '198', 'product_images/201512/201512171021078590.png', '', '12');
INSERT INTO `vcos_product_graphic` VALUES ('192', '214', 'product_images/201512/201512301744507505.png', '哈哈哈哈', '1');
INSERT INTO `vcos_product_graphic` VALUES ('194', '214', 'product_images/201512/201512301745023884.png', '呵呵', '2');
INSERT INTO `vcos_product_graphic` VALUES ('196', '216', 'product_images/201601/201601140955006702.png', '', '1');
INSERT INTO `vcos_product_graphic` VALUES ('198', '216', 'product_images/201601/201601140955145382.png', '', '2');
INSERT INTO `vcos_product_graphic` VALUES ('200', '216', 'product_images/201601/201601140955229550.png', '', '3');
INSERT INTO `vcos_product_graphic` VALUES ('202', '216', 'product_images/201601/201601140955307439.png', '', '4');
INSERT INTO `vcos_product_graphic` VALUES ('204', '216', 'product_images/201601/201601140955389265.png', '', '5');
INSERT INTO `vcos_product_graphic` VALUES ('206', '216', 'product_images/201601/201601140955489923.png', '', '6');
INSERT INTO `vcos_product_graphic` VALUES ('208', '216', 'product_images/201601/201601140956032375.jpg', '', '7');
INSERT INTO `vcos_product_graphic` VALUES ('210', '216', 'product_images/201601/201601140956137994.png', '', '8');
INSERT INTO `vcos_product_graphic` VALUES ('212', '216', 'product_images/201601/201601140956245431.png', '', '9');
INSERT INTO `vcos_product_graphic` VALUES ('214', '49', 'product_images/201601/201601141141218808.png', '', '3');
INSERT INTO `vcos_product_graphic` VALUES ('216', '49', 'product_images/201601/201601141141327807.png', '', '4');
INSERT INTO `vcos_product_graphic` VALUES ('218', '49', 'product_images/201601/201601141141412120.png', '', '5');
INSERT INTO `vcos_product_graphic` VALUES ('220', '49', 'product_images/201601/201601141142054675.png', '', '6');

-- ----------------------------
-- Table structure for `vcos_product_img`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_product_img`;
CREATE TABLE `vcos_product_img` (
  `product_img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  `img_url` varchar(128) DEFAULT NULL COMMENT '商品图片',
  `img_type` tinyint(4) DEFAULT '1' COMMENT '商品类型',
  `sort_order` int(11) NOT NULL DEFAULT '99' COMMENT '图片排序',
  PRIMARY KEY (`product_img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=345 DEFAULT CHARSET=utf8 COMMENT='商品图片表';

-- ----------------------------
-- Records of vcos_product_img
-- ----------------------------
INSERT INTO `vcos_product_img` VALUES ('13', '19', 'product_images/201511/201511051437091514.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('15', '19', 'product_images/201511/201511051437426303.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('49', '43', 'product_images/201511/201511051550063730.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('51', '43', 'product_images/201511/201511051550152976.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('53', '57', 'product_images/201511/201511101725215257.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('57', '57', 'product_images/201511/201511101725581394.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('59', '57', 'product_images/201511/201511101725432075.jpg', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('63', '61', 'product_images/201511/201511061743553271.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('65', '61', 'product_images/201511/201511061744474020.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('67', '65', 'product_images/201511/201511091051007385.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('73', '77', 'product_images/201511/201511101243548404.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('75', '71', 'product_images/201511/201511101346404196.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('77', '73', 'product_images/201511/201511101347316672.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('79', '75', 'product_images/201511/201511101348058874.png', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('89', '73', 'product_images/201511/201511101529588477.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('91', '51', 'product_images/201511/201511110907555166.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('93', '53', 'product_images/201511/201511101629287406.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('95', '49', 'product_images/201511/201511101633349732.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('97', '55', 'product_images/201511/201511101641555478.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('99', '91', 'product_images/201511/201511101802237749.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('101', '91', 'product_images/201511/201511101802515298.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('103', '89', 'product_images/201511/201511101819125425.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('105', '89', 'product_images/201511/201511101819405731.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('107', '93', 'product_images/201511/201511101822283394.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('109', '93', 'product_images/201511/201511101822511763.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('111', '93', 'product_images/201511/201511101823075203.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('113', '37', 'product_images/201511/201511101827425981.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('115', '37', 'product_images/201511/201511101828141305.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('121', '41', 'product_images/201511/201511101846377990.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('123', '41', 'product_images/201511/201511101847354067.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('125', '97', 'product_images/201511/201511101853157705.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('127', '99', 'product_images/201511/201511101853333552.png', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('129', '79', 'product_images/201511/201511110907257178.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('131', '79', 'product_images/201511/201511110907477851.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('133', '79', 'product_images/201511/201511110908043789.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('135', '19', 'product_images/201511/201511110942536274.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('137', '19', 'product_images/201511/201511110943322709.jpg', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('139', '101', 'product_images/201511/201511110949127539.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('141', '101', 'product_images/201511/201511110949525998.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('143', '101', 'product_images/201511/201511110950312247.jpg', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('145', '103', 'product_images/201511/201511110954185426.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('147', '103', 'product_images/201511/201511110954325754.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('149', '103', 'product_images/201511/201511110954478957.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('151', '105', 'product_images/201511/201511111002599431.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('153', '105', 'product_images/201511/201511111003215650.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('155', '55', 'product_images/201511/201511111003305725.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('157', '105', 'product_images/201511/201511111003398056.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('159', '55', 'product_images/201511/201511111003474640.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('161', '107', 'product_images/201511/201511111005575199.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('163', '107', 'product_images/201511/201511111006104521.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('165', '107', 'product_images/201511/201511111006333047.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('171', '109', 'product_images/201511/201511111025511999.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('173', '109', 'product_images/201511/201511111026186748.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('175', '109', 'product_images/201511/201511111026476969.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('177', '111', 'product_images/201511/201511111027074108.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('179', '111', 'product_images/201511/201511111027268031.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('181', '111', 'product_images/201511/201511111027486162.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('183', '113', 'product_images/201511/201511111028081316.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('185', '113', 'product_images/201511/201511111028284490.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('187', '49', 'product_images/201511/201511111052422520.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('189', '49', 'product_images/201511/201511111053067733.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('191', '65', 'product_images/201511/201511111059513925.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('193', '65', 'product_images/201511/201511111100061406.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('195', '117', 'product_images/201511/201511111108285207.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('197', '117', 'product_images/201511/201511111108443702.jpg', '1', '-2');
INSERT INTO `vcos_product_img` VALUES ('201', '115', 'product_images/201511/201511111112187722.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('203', '115', 'product_images/201511/201511111112391750.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('205', '115', 'product_images/201511/201511111113098645.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('207', '125', 'product_images/201511/201511111444387146.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('209', '125', 'product_images/201511/201511111445128654.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('211', '127', 'product_images/201511/201511111449081649.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('213', '127', 'product_images/201511/201511111449371200.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('215', '127', 'product_images/201511/201511111450082858.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('217', '129', 'product_images/201511/201511111532258620.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('219', '129', 'product_images/201511/201511111532486628.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('221', '129', 'product_images/201511/201511111533178613.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('223', '133', 'product_images/201511/201511131421508647.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('229', '133', 'product_images/201511/201511131422314935.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('231', '137', 'product_images/201511/201511161137444571.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('233', '41', 'product_images/201511/201511231142174437.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('241', '81', 'product_images/201512/201512021100517009.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('251', '81', 'product_images/201512/201512021107179561.jpg', '1', '5');
INSERT INTO `vcos_product_img` VALUES ('257', '81', 'product_images/201512/201512021107056792.jpg', '1', '6');
INSERT INTO `vcos_product_img` VALUES ('258', '164', 'product_images/201512/201512111137588368.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('260', '164', 'product_images/201512/201512111138075480.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('262', '164', 'product_images/201512/201512111138149389.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('264', '168', 'product_images/201512/201512141615483564.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('266', '172', 'product_images/201512/201512141640192620.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('268', '174', 'product_images/201512/201512141641567865.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('270', '176', 'product_images/201512/201512151001229527.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('272', '176', 'product_images/201512/201512151001316800.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('274', '180', 'product_images/201512/201512161002163071.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('276', '180', 'product_images/201512/201512161002282912.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('278', '180', 'product_images/201512/201512161002386337.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('280', '182', 'product_images/201512/201512161007468484.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('282', '170', 'product_images/201512/201512161048341595.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('284', '170', 'product_images/201512/201512161048414347.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('286', '184', 'product_images/201512/201512161113438332.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('288', '184', 'product_images/201512/201512161113552821.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('290', '184', 'product_images/201512/201512161114136427.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('292', '184', 'product_images/201512/201512161114258428.png', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('294', '188', 'product_images/201512/201512161145192048.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('296', '188', 'product_images/201512/201512161145289979.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('298', '188', 'product_images/201512/201512161145526801.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('300', '188', 'product_images/201512/201512161146156438.png', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('302', '190', 'product_images/201512/201512161437005531.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('304', '190', 'product_images/201512/201512161437118486.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('306', '194', 'product_images/201512/201512170931242735.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('308', '194', 'product_images/201512/201512170931408806.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('310', '194', 'product_images/201512/201512170931521141.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('312', '196', 'product_images/201512/201512170938181460.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('314', '196', 'product_images/201512/201512170938252970.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('316', '196', 'product_images/201512/201512170938399654.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('318', '196', 'product_images/201512/201512170938505786.png', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('320', '198', 'product_images/201512/201512170956023806.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('322', '198', 'product_images/201512/201512170956138470.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('324', '198', 'product_images/201512/201512170956253816.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('326', '198', 'product_images/201512/201512170956463768.jpg', '1', '4');
INSERT INTO `vcos_product_img` VALUES ('328', '210', 'product_images/201512/201512181545005417.jpg', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('330', '210', 'product_images/201512/201512181545111984.jpg', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('332', '210', 'product_images/201512/201512181545207327.jpg', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('334', '214', 'product_images/201512/201512301744307633.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('336', '214', 'product_images/201512/201512301744369137.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('338', '216', 'product_images/201601/201601140947487029.png', '1', '1');
INSERT INTO `vcos_product_img` VALUES ('340', '216', 'product_images/201601/201601140947561179.png', '1', '2');
INSERT INTO `vcos_product_img` VALUES ('342', '216', 'product_images/201601/201601140948068507.png', '1', '3');
INSERT INTO `vcos_product_img` VALUES ('344', '216', 'product_images/201601/201601140948134358.png', '1', '4');

-- ----------------------------
-- Table structure for `vcos_shop`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_shop`;
CREATE TABLE `vcos_shop` (
  `shop_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_code` varchar(32) DEFAULT NULL COMMENT '店铺code',
  `shop_tel` varchar(255) DEFAULT NULL COMMENT '电话',
  `shop_title` varchar(100) DEFAULT NULL COMMENT '店铺名',
  `shop_logo` varchar(100) DEFAULT NULL COMMENT '店铺logo',
  `shop_img_url` varchar(128) DEFAULT NULL COMMENT '店铺封面图',
  `shop_desc` varchar(200) DEFAULT NULL COMMENT '店铺描述',
  `legal_representative` varchar(100) DEFAULT NULL COMMENT '店铺法人',
  `company_name` varchar(100) DEFAULT NULL COMMENT '所属公司名',
  `shop_address` varchar(100) DEFAULT NULL COMMENT '店铺地址',
  `cash_deposit` int(11) DEFAULT NULL COMMENT '店铺保证金',
  `main_products` varchar(255) DEFAULT NULL COMMENT '店铺主营',
  `created` datetime DEFAULT NULL COMMENT '2015-10-28 12:01:01 入驻时间',
  `business_license` varchar(100) DEFAULT NULL COMMENT '营业执照 pdf扫描件上传地址',
  `shop_status` tinyint(4) DEFAULT NULL COMMENT '店铺状态，1、可用，2、封店',
  `cruise_id` int(11) DEFAULT NULL COMMENT '所属邮轮',
  `is_delete` tinyint(4) DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COMMENT='店铺表';

-- ----------------------------
-- Records of vcos_shop
-- ----------------------------
INSERT INTO `vcos_shop` VALUES ('3', 'qjxp', '工', 'PONT运动', 'shop_images/201511/201511091626385727.jpg', 'shop_images/201511/201511091630023605.png', '主打运动系列', '张某某', 'PONT集团', '甲板三层', '2000000', '休闲裤、休闲衫、运动鞋', '2016-01-06 15:08:40', 'shop_images/201511/201511281115188888.jpg', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('7', '0002', null, '卡米龙', 'shop_images/201511/201511041642144075.jpg', 'shop_images/201511/201511091630147530.png', '双肩包、单肩包', '李某某', '卡米龙有限集团', '甲板四层A区', '1000000', '休闲包、运动包、双肩包', '2015-12-21 09:57:31', 'shop_images/201511/201511091607583442.png', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('9', '0013', null, '米妮箱包专营店', 'shop_images/201511/201511041643127129.jpg', 'shop_images/201511/201511091630359704.png', '时尚风', '张某某', 'test1', '甲板二层', '100000', '女装，包包', '2015-12-17 17:19:16', 'shop_images/201511/201511041643124567.png', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('17', '002', '1102020', '采妍国际海外旗舰店', 'shop_images/201511/201511051416092891.jpg', 'shop_images/201511/201511051416093500.jpg', '正品护肤品', '张某某', '采妍国际', '甲板三层', '1000000', '护肤品，化妆品', '2015-11-05 14:16:09', 'shop_images/201511/201511051416093175.jpg', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('21', '001', null, '西西小可', 'shop_images/201511/201511061527425790.jpg', 'shop_images/201511/201511061527427433.jpg', '时尚女装', '张某某', '西西有限公司', '甲板二层', '200000', '女装', '2015-11-16 09:39:07', 'shop_images/201511/201511061527429879.jpg', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('23', '0003', null, ' 良心正品断码折扣店', 'shop_images/201511/201511061529163700.jpg', 'shop_images/201511/201511061529164954.jpg', '正品', '李某某', '良心品牌', '甲板四层左转', '1000000', '球服、休闲鞋、运动鞋', '2015-11-06 15:29:16', 'shop_images/201511/201511061529163312.jpg', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('25', '005', null, '良品铺子', 'shop_images/201511/201511061530232319.jpg', 'shop_images/201511/201511061530236327.jpg', '坚果', '张某某', '良品铺子', '甲板五层中部', '2000000', '坚果、饮料', '2015-12-16 15:02:21', 'shop_images/201511/201511061530232774.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('27', '004', null, '牛栏旗舰店', 'shop_images/201511/201511061620001742.jpg', 'shop_images/201511/201511281113493090.jpg', '婴儿奶粉', '陆某某', '荷兰牛栏集团', '甲板三层', '2000000', '奶粉', '2015-11-28 11:13:49', 'shop_images/201511/201511061620003550.jpg', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('29', '001', null, '奢侈品时装店', 'shop_images/201511/201511061749417436.jpg', 'shop_images/201511/201511061749413880.jpg', '世界上奢侈品', '林', '毕升', '珠海', '5000000', '奢侈品', '2015-11-06 17:49:41', 'shop_images/201511/201511061749413299.jpg', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('31', '1020', null, '儿童益智玩具', 'shop_images/201511/201511091044191986.jpg', 'shop_images/201511/201511091044199838.jpg', '便宜', 'Michael', '百利威', '三层甲板', '5000000', '儿童玩具', '2015-12-16 17:01:23', 'shop_images/201511/201511091044198313.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('33', '20151109', null, 'its skin', 'shop_images/201511/201511091413511282.jpg', 'shop_images/201511/201511091413514135.jpg', 'it\'s skin一个护肤品品牌，在2007年获得英国kifus顶级化妆品有限公司技术配方支持，成为韩国时尚品牌新宠，韩国三大化妆品之一', '李明浩', 'it\'s skin', '四层甲板', '10000000', '化妆品', '2015-11-09 14:13:51', 'shop_images/201511/201511091413517369.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('35', '0001', null, 'aaaaaaaaaa', 'shop_images/201511/201511091604052803.jpg', 'shop_images/201511/201511091604059540.jpg', 'aaa', 'aa', 'aaa', 'aa', '1200', 'aa', '2015-11-09 16:14:21', 'shop_images/201511/201511091614219700.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('37', '001', null, 'bb', 'shop_images/201511/201511091607056212.png', 'shop_images/201511/201511091607059223.png', 'bb', 'bbb', 'bbb', 'bbb', '154600', 'bbb', '2015-11-09 16:07:05', 'shop_images/201511/201511091607051735.png', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('39', 'aaa', null, 'aaaaaaaaaa', 'shop_images/201511/201511111045414163.jpg', 'shop_images/201511/201511111045413556.jpg', 'aaa', 'aa', 'aa', 'aa', '1200', 'aa', '2015-11-11 10:45:41', 'shop_images/201511/201511111045417274.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('41', 'shop001', null, '湘南服装', 'shop_images/201511/201511130849187239.jpg', 'shop_images/201511/201511130849183834.jpg', '物美价廉', '成龙', '鑫鑫制衣', '湖南', '1000000', '男女服装', '2015-11-13 08:49:18', 'shop_images/201511/201511130849187819.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('43', 'shop001', null, '123', 'shop_images/201511/201511130904217411.jpg', 'shop_images/201511/201511130904212681.jpg', '123', '12', '312', '312', '312300', '123', '2015-11-13 09:04:21', 'shop_images/201511/201511130904219254.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('45', '121212', null, '进口婴幼儿奶粉专卖店', 'shop_images/201511/201511131343262574.jpg', 'shop_images/201511/201511131343261591.jpg', '妈妈们必选的奶粉，这里应有尽有。', 'lin', '船舶公司', '四层甲板', '10000000', '奶粉', '2015-11-13 13:43:26', 'shop_images/201511/201511131343268371.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('61', 'aaa', null, 'aaaaaaaaaa', 'shop_images/201511/201511181603007307.jpg', 'shop_images/201511/201511181603005744.jpg', 'aa', 'aa', 'aa', 'aa', '121200', 'aa', '2015-11-18 16:03:00', 'shop_images/201511/201511181603007960.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('62', 'lsww', null, '零食物语', 'shop_images/201512/201512141344118132.png', 'shop_images/201512/201512141344113574.png', '好吃', '张三', '毕升', '珠海香洲', '5000000', '零食', '2015-12-14 13:44:11', 'shop_images/201512/201512141344119371.png', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('66', '110', null, 'B&G糖果店', 'shop_images/201512/201512150941239448.png', 'shop_images/201512/201512150941237161.png', '酸甜苦辣', '李四', '毕升', '顶层甲板', '5000000', '糖果', '2015-12-15 09:41:23', 'shop_images/201512/201512150941238008.png', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('68', '1101', null, '1', 'shop_images/201512/201512150942598812.png', 'shop_images/201512/201512150942597081.png', '1', '1', '11', '1', '1100', '1', '2015-12-15 09:42:59', 'shop_images/201512/201512150942595516.png', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('70', 'a004', null, 'addidas阿迪达斯正品', 'shop_images/201512/201512151501582335.jpg', 'shop_images/201512/201512151501583080.jpg', '运动鞋，运动衣', '张三', '阿迪达斯', '甲板三层', '3000000', '运动鞋，运动衣', '2015-12-15 15:01:58', 'shop_images/201512/201512151501583314.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('72', 'test001', null, '婴幼儿营养辅食专卖店', 'shop_images/201512/201512160926506604.png', 'shop_images/201512/201512161059025436.png', '测试店铺', '23345', '毕升234', '甲板四层左转2201', '500000', 'test', '2015-12-16 11:07:07', 'shop_images/201512/201512160926504653.png', '1', '1', '0');
INSERT INTO `vcos_shop` VALUES ('74', 'xn001', null, '湘南小吃', 'shop_images/201512/201512161005154020.jpg', 'shop_images/201512/201512161005159438.jpg', '美味，可口', '刘备', '湘南餐饮', '湖南', '1000000', '小吃', '2015-12-16 11:32:39', 'shop_images/201512/201512161005152887.jpg', '0', '1', '1');
INSERT INTO `vcos_shop` VALUES ('76', '1111', null, '美宜家', 'shop_images/201512/201512161359509183.jpg', 'shop_images/201512/201512161359506661.jpg', '百货公司', '刘能', '美宜家', '甲板二层', '1000000', '各类商品', '2015-12-16 14:42:44', 'shop_images/201512/201512161359505889.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('78', '33', null, '33', 'shop_images/201512/201512161503148685.png', 'shop_images/201512/201512161503143418.jpg', '33', '33', '33', '33', '3300', '33', '2015-12-16 15:03:14', 'shop_images/201512/201512161503149023.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('80', '20151218', null, '宝宝服饰', 'shop_images/201512/201512171514325784.jpg', 'shop_images/201512/201512171514328726.jpg', '宝宝服饰', '刘能', '鑫鑫服装公司', '珠海', '1000000', '童装', '2015-12-17 15:14:32', 'shop_images/201512/201512171514323961.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('82', 'SANA003', null, '123456', 'shop_images/201512/201512171533269188.jpg', 'shop_images/201512/201512171533261133.jpg', '宝宝服饰', '刘能', '美宜家', '湖南', '1000000', '123', '2015-12-17 15:33:26', 'shop_images/201512/201512171533269959.jpg', '1', '1', '1');
INSERT INTO `vcos_shop` VALUES ('84', 'supermarket001', null, '百货商场', 'shop_images/201512/201512301733583893.png', 'shop_images/201512/201512301733581652.png', '百货', '防火堤', '毕升', '现在', '333300', '百货', '2015-12-30 17:33:58', 'shop_images/201512/201512301733586504.png', '1', '1', '0');

-- ----------------------------
-- Table structure for `vcos_shop_brand`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_shop_brand`;
CREATE TABLE `vcos_shop_brand` (
  `shop_brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned NOT NULL,
  `brand_id` int(11) DEFAULT NULL COMMENT '品牌id',
  `sort_order` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  PRIMARY KEY (`shop_brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='店铺品牌表';

-- ----------------------------
-- Records of vcos_shop_brand
-- ----------------------------
INSERT INTO `vcos_shop_brand` VALUES ('1', '3', '1', '2');
INSERT INTO `vcos_shop_brand` VALUES ('7', '3', '7', '1');
INSERT INTO `vcos_shop_brand` VALUES ('9', '7', '13', '1');
INSERT INTO `vcos_shop_brand` VALUES ('13', '3', '37', '1');
INSERT INTO `vcos_shop_brand` VALUES ('15', '9', '21', '1');
INSERT INTO `vcos_shop_brand` VALUES ('17', '17', '17', '1');
INSERT INTO `vcos_shop_brand` VALUES ('25', '23', '15', '1');
INSERT INTO `vcos_shop_brand` VALUES ('27', '25', '41', '1');
INSERT INTO `vcos_shop_brand` VALUES ('29', '27', '15', '1');
INSERT INTO `vcos_shop_brand` VALUES ('31', '29', '47', '1');
INSERT INTO `vcos_shop_brand` VALUES ('33', '3', '13', '1');
INSERT INTO `vcos_shop_brand` VALUES ('35', '29', '47', '2');
INSERT INTO `vcos_shop_brand` VALUES ('37', '29', '47', '1');
INSERT INTO `vcos_shop_brand` VALUES ('39', '31', '49', '4');
INSERT INTO `vcos_shop_brand` VALUES ('41', '33', '57', '1');
INSERT INTO `vcos_shop_brand` VALUES ('43', '3', '1', '1');
INSERT INTO `vcos_shop_brand` VALUES ('45', '3', '59', '1');
INSERT INTO `vcos_shop_brand` VALUES ('47', '27', '45', '2');
INSERT INTO `vcos_shop_brand` VALUES ('49', '3', '1', '12');
INSERT INTO `vcos_shop_brand` VALUES ('53', '45', '67', '1');

-- ----------------------------
-- Table structure for `vcos_shop_category`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_shop_category`;
CREATE TABLE `vcos_shop_category` (
  `sc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned NOT NULL,
  `shop_category_id` int(11) NOT NULL COMMENT '商品分类id',
  `shop_category_name` varchar(64) NOT NULL DEFAULT '1' COMMENT '分类类型',
  `parent_cid` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '99' COMMENT '排序',
  `is_show_main` tinyint(4) DEFAULT '1' COMMENT '是否首页显示',
  PRIMARY KEY (`sc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COMMENT='店铺分类表';

-- ----------------------------
-- Records of vcos_shop_category
-- ----------------------------
INSERT INTO `vcos_shop_category` VALUES ('5', '3', '1002', '高档铝框箱', '10', '14', '1');
INSERT INTO `vcos_shop_category` VALUES ('9', '3', '1101', '硬箱', '11', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('13', '3', '1003', '休闲布面箱', '10', '15', '1');
INSERT INTO `vcos_shop_category` VALUES ('21', '3', '12', '专项运动篮球鞋', '0', '3', '1');
INSERT INTO `vcos_shop_category` VALUES ('25', '3', '1202', '耐克', '12', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('27', '3', '1203', '乔丹', '12', '5', '1');
INSERT INTO `vcos_shop_category` VALUES ('31', '3', '1205', '匹克', '12', '4', '1');
INSERT INTO `vcos_shop_category` VALUES ('33', '3', '1206', '安踏', '12', '2', '1');
INSERT INTO `vcos_shop_category` VALUES ('35', '3', '13', '跑步鞋１', '0', '4', '1');
INSERT INTO `vcos_shop_category` VALUES ('37', '3', '1301', '新百伦', '13', '2', '1');
INSERT INTO `vcos_shop_category` VALUES ('39', '3', '1302', '耐克', '13', '2', '1');
INSERT INTO `vcos_shop_category` VALUES ('41', '3', '1303', '阿迪达斯', '13', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('43', '3', '1304', '李宁', '13', '4', '1');
INSERT INTO `vcos_shop_category` VALUES ('46', '3', '1401', '33245', '14', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('48', '3', '1305', '匹克', '13', '5', '1');
INSERT INTO `vcos_shop_category` VALUES ('52', '72', '10', '营养添加', '0', '1', '0');
INSERT INTO `vcos_shop_category` VALUES ('58', '72', '1101', '洗漱护肤', '11', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('60', '72', '1001', '米糊', '10', '1', '0');
INSERT INTO `vcos_shop_category` VALUES ('62', '72', '10', '营养添加', '0', '1', '0');
INSERT INTO `vcos_shop_category` VALUES ('64', '76', '1001', '床上用品', '10', '2', '1');
INSERT INTO `vcos_shop_category` VALUES ('66', '76', '1002', '厨房用品', '10', '3', '1');
INSERT INTO `vcos_shop_category` VALUES ('72', '76', '1101', '饼干', '11', '2', '1');
INSERT INTO `vcos_shop_category` VALUES ('74', '76', '1102', '麻辣', '11', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('76', '3', '1207', '李宁', '12', '6', '1');
INSERT INTO `vcos_shop_category` VALUES ('80', '84', '10', '饮料区', '0', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('82', '84', '1001', '果汁', '10', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('84', '84', '1002', '矿泉水', '10', '2', '1');
INSERT INTO `vcos_shop_category` VALUES ('86', '84', '1003', '牛奶', '10', '3', '1');
INSERT INTO `vcos_shop_category` VALUES ('90', '84', '1101', '电视', '11', '1', '1');
INSERT INTO `vcos_shop_category` VALUES ('92', '84', '1102', '电脑', '11', '2', '1');
INSERT INTO `vcos_shop_category` VALUES ('94', '84', '12', '日用品区', '0', '3', '1');
INSERT INTO `vcos_shop_category` VALUES ('96', '84', '1201', '0', '12', '1', '1');

-- ----------------------------
-- Table structure for `vcos_shop_category_product`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_shop_category_product`;
CREATE TABLE `vcos_shop_category_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COMMENT='店铺分类产品表';

-- ----------------------------
-- Records of vcos_shop_category_product
-- ----------------------------
INSERT INTO `vcos_shop_category_product` VALUES ('28', '1301', '113');
INSERT INTO `vcos_shop_category_product` VALUES ('30', '1304', '113');
INSERT INTO `vcos_shop_category_product` VALUES ('80', '1001', '190');
INSERT INTO `vcos_shop_category_product` VALUES ('82', '1202', '109');
INSERT INTO `vcos_shop_category_product` VALUES ('84', '1206', '105');
INSERT INTO `vcos_shop_category_product` VALUES ('86', '1001', '180');
INSERT INTO `vcos_shop_category_product` VALUES ('88', '1001', '180');

-- ----------------------------
-- Table structure for `vcos_shop_operation_category`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_shop_operation_category`;
CREATE TABLE `vcos_shop_operation_category` (
  `so_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `category_code` varchar(12) DEFAULT NULL,
  `tree_type` tinyint(4) DEFAULT NULL,
  `is_sub_all` tinyint(4) DEFAULT '0' COMMENT '1:all',
  `status` tinyint(4) DEFAULT NULL,
  `parent_catogory_code` varchar(12) DEFAULT '0',
  PRIMARY KEY (`so_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3893 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vcos_shop_operation_category
-- ----------------------------
INSERT INTO `vcos_shop_operation_category` VALUES ('139', '9', '1202003', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('141', '9', '1203003', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('143', '9', '1203001', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('145', '9', '1203002', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('147', '9', '1203', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('149', '9', '1202', '2', '0', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('151', '9', '12', '1', '0', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('255', '19', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('257', '19', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('259', '19', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('261', '19', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('263', '19', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('265', '19', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('267', '19', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('269', '19', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('271', '19', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('273', '19', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('275', '19', '19', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('441', '61', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('443', '61', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('445', '61', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('447', '61', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('449', '61', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('451', '61', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('453', '61', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('455', '61', '10', '1', '0', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('481', '17', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('483', '17', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('485', '17', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('487', '17', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('489', '17', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('491', '17', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('493', '17', '1004001', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('495', '17', '1004002', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('497', '17', '1005001', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('499', '17', '1101001', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('501', '17', '1101002', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('503', '17', '1102001', '3', '1', '1', '1102');
INSERT INTO `vcos_shop_operation_category` VALUES ('505', '17', '1103002', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('507', '17', '1103001', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('509', '17', '1104003', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('511', '17', '1104002', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('513', '17', '1104001', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('515', '17', '1105002', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('517', '17', '1105001', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('519', '17', '1106001', '3', '1', '1', '1106');
INSERT INTO `vcos_shop_operation_category` VALUES ('521', '17', '1201003', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('523', '17', '1201001', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('525', '17', '1201002', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('527', '17', '1201004', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('529', '17', '1201005', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('531', '17', '1202004', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('533', '17', '1202003', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('535', '17', '1202002', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('537', '17', '1202001', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('539', '17', '1203001', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('541', '17', '1203002', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('543', '17', '1203003', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('545', '17', '1801001', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('547', '17', '1801002', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('549', '17', '1802003', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('551', '17', '1802001', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('553', '17', '1802002', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('555', '17', '1803001', '3', '1', '1', '1803');
INSERT INTO `vcos_shop_operation_category` VALUES ('557', '17', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('559', '17', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('561', '17', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('563', '17', '1004', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('565', '17', '1105', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('567', '17', '1104', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('569', '17', '1106', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('571', '17', '1101', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('573', '17', '1102', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('575', '17', '1103', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('577', '17', '1201', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('579', '17', '1202', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('581', '17', '1203', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('583', '17', '1804', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('585', '17', '1803', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('587', '17', '1802', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('589', '17', '1801', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('591', '17', '11', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('593', '17', '12', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('595', '17', '18', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('597', '17', '10', '1', '0', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('972', '25', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('974', '25', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('976', '25', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('978', '25', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('980', '25', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('982', '25', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('984', '25', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('986', '25', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('988', '25', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('990', '25', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('992', '25', '19', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1048', '62', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1050', '62', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1052', '62', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1054', '62', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1056', '62', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1058', '62', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1060', '62', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1062', '62', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1064', '62', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('1066', '62', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('1068', '62', '19', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1160', '64', '', '3', '1', '1', '');
INSERT INTO `vcos_shop_operation_category` VALUES ('1162', '64', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1164', '64', '1009', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1166', '64', '1008', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1168', '64', '1007', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1170', '64', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1172', '64', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1174', '64', '1004', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1176', '64', '10', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1492', '72', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1494', '72', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1496', '72', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1498', '72', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1500', '72', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1502', '72', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1504', '72', '1004001', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('1506', '72', '1004002', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('1508', '72', '1005001', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('1510', '72', '1009001', '3', '1', '1', '1009');
INSERT INTO `vcos_shop_operation_category` VALUES ('1512', '72', '1101001', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('1514', '72', '1101002', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('1516', '72', '1102001', '3', '1', '1', '1102');
INSERT INTO `vcos_shop_operation_category` VALUES ('1518', '72', '1103002', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('1520', '72', '1103001', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('1522', '72', '1104003', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('1524', '72', '1104002', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('1526', '72', '1104001', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('1528', '72', '1105002', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('1530', '72', '1105001', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('1532', '72', '1106001', '3', '1', '1', '1106');
INSERT INTO `vcos_shop_operation_category` VALUES ('1534', '72', '1201003', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1536', '72', '1201001', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1538', '72', '1201002', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1540', '72', '1201004', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1542', '72', '1201005', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1544', '72', '1202004', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1546', '72', '1202003', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1548', '72', '1202002', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1550', '72', '1202001', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1552', '72', '1203001', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('1554', '72', '1203002', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('1556', '72', '1203003', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('1558', '72', '1301001', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('1560', '72', '1301002', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('1562', '72', '1301003', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('1564', '72', '1302002', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('1566', '72', '1302001', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('1568', '72', '1402001', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('1570', '72', '1402002', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('1572', '72', '1403001', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('1574', '72', '1403003', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('1576', '72', '1403002', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('1578', '72', '1601001', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('1580', '72', '1601002', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('1582', '72', '1602002', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('1584', '72', '1602003', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('1586', '72', '1602001', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('1588', '72', '1603003', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('1590', '72', '1603002', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('1592', '72', '1603001', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('1594', '72', '1701004', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1596', '72', '1701005', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1598', '72', '1701006', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1600', '72', '1701001', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1602', '72', '1701002', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1604', '72', '1701003', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1606', '72', '1702004', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1608', '72', '1702003', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1610', '72', '1702001', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1612', '72', '1702002', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1614', '72', '1703002', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('1616', '72', '1703001', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('1618', '72', '1703003', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('1620', '72', '1704001', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1622', '72', '1704002', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1624', '72', '1704006', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1626', '72', '1704005', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1628', '72', '1704003', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1630', '72', '1704007', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1632', '72', '1704004', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1634', '72', '1801001', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('1636', '72', '1801002', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('1638', '72', '1802003', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('1640', '72', '1802001', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('1642', '72', '1802002', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('1644', '72', '1803001', '3', '1', '1', '1803');
INSERT INTO `vcos_shop_operation_category` VALUES ('1646', '72', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1648', '72', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1650', '72', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1652', '72', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1654', '72', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1656', '72', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1658', '72', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1660', '72', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1662', '72', '2001005', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1664', '72', '2001006', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1666', '72', '2001004', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1668', '72', '2001003', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1670', '72', '2001001', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1672', '72', '2001002', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1674', '72', '2002001', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('1676', '72', '2002006', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('1678', '72', '2002004', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('1680', '72', '2002003', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('1682', '72', '2002002', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('1684', '72', '2002005', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('1686', '72', '2003001', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('1688', '72', '2003002', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('1690', '72', '2003003', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('1692', '72', '2003004', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('1694', '72', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1696', '72', '1009', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1698', '72', '1008', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1700', '72', '1007', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1702', '72', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1704', '72', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1706', '72', '1004', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('1708', '72', '1105', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('1710', '72', '1104', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('1712', '72', '1106', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('1714', '72', '1101', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('1716', '72', '1102', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('1718', '72', '1103', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('1720', '72', '1201', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('1722', '72', '1202', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('1724', '72', '1203', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('1726', '72', '1302', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('1728', '72', '1301', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('1730', '72', '1402', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('1732', '72', '1403', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('1734', '72', '1602', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('1736', '72', '1601', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('1738', '72', '1603', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('1740', '72', '1704', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('1742', '72', '1701', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('1744', '72', '1702', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('1746', '72', '1703', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('1748', '72', '1804', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('1750', '72', '1803', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('1752', '72', '1802', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('1754', '72', '1801', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('1756', '72', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('1758', '72', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('1760', '72', '2003', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('1762', '72', '2004', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('1764', '72', '2005', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('1766', '72', '2006', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('1768', '72', '2001', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('1770', '72', '2002', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('1772', '72', '10', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1774', '72', '11', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1776', '72', '12', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1778', '72', '13', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1780', '72', '14', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1782', '72', '16', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1784', '72', '17', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1786', '72', '18', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1788', '72', '19', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1790', '72', '20', '1', '1', '0', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1792', '74', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1794', '74', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1796', '74', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1798', '74', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1800', '74', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1802', '74', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1804', '74', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1806', '74', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1808', '74', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('1810', '74', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('1812', '74', '19', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('1814', '76', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1816', '76', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1818', '76', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1820', '76', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1822', '76', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1824', '76', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1826', '76', '1004002', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('1828', '76', '1004001', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('1830', '76', '1005002', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('1832', '76', '1005001', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('1834', '76', '1005003', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('1836', '76', '1006002', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('1838', '76', '1006001', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('1840', '76', '1009001', '3', '1', '1', '1009');
INSERT INTO `vcos_shop_operation_category` VALUES ('1842', '76', '1101002', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('1844', '76', '1101001', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('1846', '76', '1102001', '3', '1', '1', '1102');
INSERT INTO `vcos_shop_operation_category` VALUES ('1848', '76', '1103001', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('1850', '76', '1103002', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('1852', '76', '1104001', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('1854', '76', '1104003', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('1856', '76', '1104002', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('1858', '76', '1105002', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('1860', '76', '1105001', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('1862', '76', '1106001', '3', '1', '1', '1106');
INSERT INTO `vcos_shop_operation_category` VALUES ('1864', '76', '1201003', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1866', '76', '1201001', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1868', '76', '1201002', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1870', '76', '1201004', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1872', '76', '1201005', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('1874', '76', '1202004', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1876', '76', '1202003', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1878', '76', '1202002', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1880', '76', '1202001', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('1882', '76', '1203001', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('1884', '76', '1203002', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('1886', '76', '1203003', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('1888', '76', '1301001', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('1890', '76', '1301002', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('1892', '76', '1301003', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('1894', '76', '1302002', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('1896', '76', '1302001', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('1898', '76', '1402001', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('1900', '76', '1402002', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('1902', '76', '1403003', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('1904', '76', '1403002', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('1906', '76', '1403001', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('1908', '76', '1601001', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('1910', '76', '1601002', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('1912', '76', '1602001', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('1914', '76', '1602002', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('1916', '76', '1602003', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('1918', '76', '1603001', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('1920', '76', '1603002', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('1922', '76', '1603003', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('1924', '76', '1701005', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1926', '76', '1701004', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1928', '76', '1701003', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1930', '76', '1701001', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1932', '76', '1701006', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1934', '76', '1701002', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('1936', '76', '1702001', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1938', '76', '1702002', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1940', '76', '1702003', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1942', '76', '1702004', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('1944', '76', '1703002', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('1946', '76', '1703003', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('1948', '76', '1703001', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('1950', '76', '1704006', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1952', '76', '1704005', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1954', '76', '1704003', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1956', '76', '1704001', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1958', '76', '1704002', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1960', '76', '1704004', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1962', '76', '1704007', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('1964', '76', '1801002', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('1966', '76', '1801001', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('1968', '76', '1802001', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('1970', '76', '1802002', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('1972', '76', '1802003', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('1974', '76', '1803001', '3', '1', '1', '1803');
INSERT INTO `vcos_shop_operation_category` VALUES ('1976', '76', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1978', '76', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1980', '76', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1982', '76', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1984', '76', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1986', '76', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('1988', '76', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1990', '76', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('1992', '76', '2001004', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1994', '76', '2001006', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1996', '76', '2001005', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('1998', '76', '2001003', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2000', '76', '2001002', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2002', '76', '2001001', '3', '1', '0', '2001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2004', '76', '2002006', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('2006', '76', '2002004', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('2008', '76', '2002003', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('2010', '76', '2002002', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('2012', '76', '2002001', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('2014', '76', '2002005', '3', '1', '0', '2002');
INSERT INTO `vcos_shop_operation_category` VALUES ('2016', '76', '2003001', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('2018', '76', '2003002', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('2020', '76', '2003003', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('2022', '76', '2003004', '3', '1', '0', '2003');
INSERT INTO `vcos_shop_operation_category` VALUES ('2024', '76', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('2026', '76', '1009', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('2028', '76', '1008', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('2030', '76', '1007', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('2032', '76', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('2034', '76', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('2036', '76', '1004', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('2038', '76', '1105', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('2040', '76', '1104', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('2042', '76', '1106', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('2044', '76', '1101', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('2046', '76', '1102', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('2048', '76', '1103', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('2050', '76', '1201', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('2052', '76', '1202', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('2054', '76', '1203', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('2056', '76', '1302', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('2058', '76', '1301', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('2060', '76', '1402', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('2062', '76', '1403', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('2064', '76', '1602', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('2066', '76', '1601', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('2068', '76', '1603', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('2070', '76', '1704', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('2072', '76', '1701', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('2074', '76', '1702', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('2076', '76', '1703', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('2078', '76', '1804', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('2080', '76', '1803', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('2082', '76', '1802', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('2084', '76', '1801', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('2086', '76', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('2088', '76', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('2090', '76', '2003', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('2092', '76', '2004', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('2094', '76', '2005', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('2096', '76', '2006', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('2098', '76', '2001', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('2100', '76', '2002', '2', '1', '0', '20');
INSERT INTO `vcos_shop_operation_category` VALUES ('2102', '76', '10', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2104', '76', '11', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2106', '76', '12', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2108', '76', '13', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2110', '76', '14', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2112', '76', '16', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2114', '76', '17', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2116', '76', '18', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2118', '76', '19', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2120', '76', '20', '1', '1', '0', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('2970', '41', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2972', '41', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2974', '41', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2976', '41', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2978', '41', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2980', '41', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('2986', '41', '1005002', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('2988', '41', '1005001', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('2990', '41', '1005003', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('2992', '41', '1006002', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('2994', '41', '1006001', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('2996', '41', '1009001', '3', '1', '1', '1009');
INSERT INTO `vcos_shop_operation_category` VALUES ('2998', '41', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3000', '41', '1009', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3002', '41', '1008', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3004', '41', '1007', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3006', '41', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3008', '41', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3012', '41', '10', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3014', '7', '1701005', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3016', '7', '1701004', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3018', '7', '1701003', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3020', '7', '1701001', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3022', '7', '1701006', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3024', '7', '1701002', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3026', '7', '1704006', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3028', '7', '1704005', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3030', '7', '1704003', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3032', '7', '1704001', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3034', '7', '1704002', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3036', '7', '1704004', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3038', '7', '1704007', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3040', '7', '1704', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3042', '7', '1701', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3044', '7', '17', '1', '0', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3258', '82', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3260', '82', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3262', '82', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3264', '82', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3266', '82', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3268', '82', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3270', '82', '1004001', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('3272', '82', '1004002', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('3274', '82', '1005001', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3276', '82', '1005003', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3278', '82', '1005002', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3280', '82', '1006001', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('3282', '82', '1006002', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('3284', '82', '1009001', '3', '1', '1', '1009');
INSERT INTO `vcos_shop_operation_category` VALUES ('3286', '82', '1101001', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('3288', '82', '1101002', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('3290', '82', '1102001', '3', '1', '1', '1102');
INSERT INTO `vcos_shop_operation_category` VALUES ('3296', '82', '1104002', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3298', '82', '1104001', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3300', '82', '1104003', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3302', '82', '1105002', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('3304', '82', '1105001', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('3306', '82', '1106001', '3', '1', '1', '1106');
INSERT INTO `vcos_shop_operation_category` VALUES ('3308', '82', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3310', '82', '1009', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3312', '82', '1008', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3314', '82', '1007', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3316', '82', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3318', '82', '1004', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3320', '82', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3322', '82', '1104', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3324', '82', '1105', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3326', '82', '1106', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3328', '82', '1101', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3330', '82', '1102', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3334', '82', '10', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3336', '82', '11', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3338', '3', '1201001', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3340', '3', '1201003', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3342', '3', '1201005', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3344', '3', '1201004', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3346', '3', '1201002', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3348', '3', '1202001', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3350', '3', '1202002', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3352', '3', '1202003', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3354', '3', '1202004', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3356', '3', '1203001', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3358', '3', '1203002', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3360', '3', '1203003', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3362', '3', '1202', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3364', '3', '1203', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3366', '3', '1201', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3368', '3', '12', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3370', '66', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3372', '66', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3374', '66', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3376', '66', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3378', '66', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3380', '66', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3382', '66', '1004001', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('3384', '66', '1004002', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('3386', '66', '1005001', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3388', '66', '1005003', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3390', '66', '1005002', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3392', '66', '1006001', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('3394', '66', '1006002', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('3396', '66', '1009001', '3', '1', '1', '1009');
INSERT INTO `vcos_shop_operation_category` VALUES ('3398', '66', '1101001', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('3400', '66', '1101002', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('3402', '66', '1102001', '3', '1', '1', '1102');
INSERT INTO `vcos_shop_operation_category` VALUES ('3404', '66', '1103002', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('3406', '66', '1103001', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('3408', '66', '1104002', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3410', '66', '1104001', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3412', '66', '1104003', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3414', '66', '1105002', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('3416', '66', '1105001', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('3418', '66', '1106001', '3', '1', '1', '1106');
INSERT INTO `vcos_shop_operation_category` VALUES ('3420', '66', '1201001', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3422', '66', '1201003', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3424', '66', '1201005', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3426', '66', '1201004', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3428', '66', '1201002', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3430', '66', '1202001', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3432', '66', '1202002', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3434', '66', '1202003', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3436', '66', '1202004', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3438', '66', '1203001', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3440', '66', '1203002', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3442', '66', '1203003', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3444', '66', '1301003', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('3446', '66', '1301002', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('3448', '66', '1301001', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('3450', '66', '1302001', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('3452', '66', '1302002', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('3454', '66', '1402002', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('3456', '66', '1402001', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('3458', '66', '1403002', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('3460', '66', '1403001', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('3462', '66', '1403003', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('3464', '66', '1601001', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('3466', '66', '1601002', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('3468', '66', '1602002', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('3470', '66', '1602001', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('3472', '66', '1602003', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('3474', '66', '1603001', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('3476', '66', '1603002', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('3478', '66', '1603003', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('3480', '66', '1701004', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3482', '66', '1701006', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3484', '66', '1701005', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3486', '66', '1701003', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3488', '66', '1701001', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3490', '66', '1701002', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3492', '66', '1702002', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3494', '66', '1702001', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3496', '66', '1702004', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3498', '66', '1702003', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3500', '66', '1703003', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('3502', '66', '1703001', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('3504', '66', '1703002', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('3506', '66', '1704004', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3508', '66', '1704006', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3510', '66', '1704005', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3512', '66', '1704007', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3514', '66', '1704003', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3516', '66', '1704002', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3518', '66', '1704001', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3520', '66', '1801001', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('3522', '66', '1801002', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('3524', '66', '1802001', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('3526', '66', '1802002', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('3528', '66', '1802003', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('3530', '66', '1803001', '3', '1', '1', '1803');
INSERT INTO `vcos_shop_operation_category` VALUES ('3532', '66', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3534', '66', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3536', '66', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3538', '66', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3540', '66', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3542', '66', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3544', '66', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('3546', '66', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('3548', '66', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3550', '66', '1009', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3552', '66', '1008', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3554', '66', '1007', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3556', '66', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3558', '66', '1004', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3560', '66', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3562', '66', '1104', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3564', '66', '1105', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3566', '66', '1106', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3568', '66', '1101', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3570', '66', '1102', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3572', '66', '1103', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3574', '66', '1202', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3576', '66', '1203', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3578', '66', '1201', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3580', '66', '1302', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('3582', '66', '1301', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('3584', '66', '1403', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('3586', '66', '1402', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('3588', '66', '1602', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('3590', '66', '1601', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('3592', '66', '1603', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('3594', '66', '1704', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3596', '66', '1701', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3598', '66', '1702', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3600', '66', '1703', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3602', '66', '1803', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3604', '66', '1802', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3606', '66', '1804', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3608', '66', '1801', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3610', '66', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('3612', '66', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('3614', '66', '10', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3616', '66', '11', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3618', '66', '12', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3620', '66', '13', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3622', '66', '14', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3624', '66', '16', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3626', '66', '17', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3628', '66', '18', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3630', '66', '19', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3632', '84', '1001001', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3634', '84', '1001005', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3636', '84', '1001004', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3638', '84', '1001003', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3640', '84', '1001007', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3642', '84', '1001006', '3', '1', '1', '1001');
INSERT INTO `vcos_shop_operation_category` VALUES ('3644', '84', '1004001', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('3646', '84', '1004002', '3', '1', '1', '1004');
INSERT INTO `vcos_shop_operation_category` VALUES ('3648', '84', '1005001', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3650', '84', '1005003', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3652', '84', '1005002', '3', '1', '1', '1005');
INSERT INTO `vcos_shop_operation_category` VALUES ('3654', '84', '1006001', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('3656', '84', '1006002', '3', '1', '1', '1006');
INSERT INTO `vcos_shop_operation_category` VALUES ('3658', '84', '1009001', '3', '1', '1', '1009');
INSERT INTO `vcos_shop_operation_category` VALUES ('3660', '84', '1101001', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('3662', '84', '1101002', '3', '1', '1', '1101');
INSERT INTO `vcos_shop_operation_category` VALUES ('3664', '84', '1102001', '3', '1', '1', '1102');
INSERT INTO `vcos_shop_operation_category` VALUES ('3666', '84', '1103002', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('3668', '84', '1103001', '3', '1', '1', '1103');
INSERT INTO `vcos_shop_operation_category` VALUES ('3670', '84', '1104002', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3672', '84', '1104001', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3674', '84', '1104003', '3', '1', '1', '1104');
INSERT INTO `vcos_shop_operation_category` VALUES ('3676', '84', '1105002', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('3678', '84', '1105001', '3', '1', '1', '1105');
INSERT INTO `vcos_shop_operation_category` VALUES ('3680', '84', '1106001', '3', '1', '1', '1106');
INSERT INTO `vcos_shop_operation_category` VALUES ('3682', '84', '1201001', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3684', '84', '1201003', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3686', '84', '1201005', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3688', '84', '1201004', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3690', '84', '1201002', '3', '1', '1', '1201');
INSERT INTO `vcos_shop_operation_category` VALUES ('3692', '84', '1202001', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3694', '84', '1202002', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3696', '84', '1202003', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3698', '84', '1202004', '3', '1', '1', '1202');
INSERT INTO `vcos_shop_operation_category` VALUES ('3700', '84', '1203001', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3702', '84', '1203002', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3704', '84', '1203003', '3', '1', '1', '1203');
INSERT INTO `vcos_shop_operation_category` VALUES ('3706', '84', '1301003', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('3708', '84', '1301002', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('3710', '84', '1301001', '3', '1', '1', '1301');
INSERT INTO `vcos_shop_operation_category` VALUES ('3712', '84', '1302001', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('3714', '84', '1302002', '3', '1', '1', '1302');
INSERT INTO `vcos_shop_operation_category` VALUES ('3716', '84', '1402002', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('3718', '84', '1402001', '3', '1', '1', '1402');
INSERT INTO `vcos_shop_operation_category` VALUES ('3720', '84', '1403002', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('3722', '84', '1403001', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('3724', '84', '1403003', '3', '1', '1', '1403');
INSERT INTO `vcos_shop_operation_category` VALUES ('3726', '84', '1601001', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('3728', '84', '1601002', '3', '1', '1', '1601');
INSERT INTO `vcos_shop_operation_category` VALUES ('3730', '84', '1602002', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('3732', '84', '1602001', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('3734', '84', '1602003', '3', '1', '1', '1602');
INSERT INTO `vcos_shop_operation_category` VALUES ('3736', '84', '1603001', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('3738', '84', '1603002', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('3740', '84', '1603003', '3', '1', '1', '1603');
INSERT INTO `vcos_shop_operation_category` VALUES ('3742', '84', '1701004', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3744', '84', '1701006', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3746', '84', '1701005', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3748', '84', '1701003', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3750', '84', '1701001', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3752', '84', '1701002', '3', '1', '1', '1701');
INSERT INTO `vcos_shop_operation_category` VALUES ('3754', '84', '1702002', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3756', '84', '1702001', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3758', '84', '1702004', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3760', '84', '1702003', '3', '1', '1', '1702');
INSERT INTO `vcos_shop_operation_category` VALUES ('3762', '84', '1703003', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('3764', '84', '1703001', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('3766', '84', '1703002', '3', '1', '1', '1703');
INSERT INTO `vcos_shop_operation_category` VALUES ('3768', '84', '1704004', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3770', '84', '1704006', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3772', '84', '1704005', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3774', '84', '1704007', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3776', '84', '1704003', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3778', '84', '1704002', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3780', '84', '1704001', '3', '1', '1', '1704');
INSERT INTO `vcos_shop_operation_category` VALUES ('3782', '84', '1801001', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('3784', '84', '1801002', '3', '1', '1', '1801');
INSERT INTO `vcos_shop_operation_category` VALUES ('3786', '84', '1802001', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('3788', '84', '1802002', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('3790', '84', '1802003', '3', '1', '1', '1802');
INSERT INTO `vcos_shop_operation_category` VALUES ('3792', '84', '1803001', '3', '1', '1', '1803');
INSERT INTO `vcos_shop_operation_category` VALUES ('3794', '84', '1901006', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3796', '84', '1901005', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3798', '84', '1901004', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3800', '84', '1901003', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3802', '84', '1901002', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3804', '84', '1901001', '3', '1', '1', '1901');
INSERT INTO `vcos_shop_operation_category` VALUES ('3806', '84', '1902001', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('3808', '84', '1902002', '3', '1', '1', '1902');
INSERT INTO `vcos_shop_operation_category` VALUES ('3810', '84', '1001', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3812', '84', '1009', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3814', '84', '1008', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3816', '84', '1007', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3818', '84', '1006', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3820', '84', '1004', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3822', '84', '1005', '2', '1', '1', '10');
INSERT INTO `vcos_shop_operation_category` VALUES ('3824', '84', '1104', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3826', '84', '1105', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3828', '84', '1106', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3830', '84', '1101', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3832', '84', '1102', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3834', '84', '1103', '2', '1', '1', '11');
INSERT INTO `vcos_shop_operation_category` VALUES ('3836', '84', '1202', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3838', '84', '1203', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3840', '84', '1201', '2', '1', '1', '12');
INSERT INTO `vcos_shop_operation_category` VALUES ('3842', '84', '1302', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('3844', '84', '1301', '2', '1', '1', '13');
INSERT INTO `vcos_shop_operation_category` VALUES ('3846', '84', '1403', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('3848', '84', '1402', '2', '1', '1', '14');
INSERT INTO `vcos_shop_operation_category` VALUES ('3850', '84', '1602', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('3852', '84', '1601', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('3854', '84', '1603', '2', '1', '1', '16');
INSERT INTO `vcos_shop_operation_category` VALUES ('3856', '84', '1704', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3858', '84', '1701', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3860', '84', '1702', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3862', '84', '1703', '2', '1', '1', '17');
INSERT INTO `vcos_shop_operation_category` VALUES ('3864', '84', '1803', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3866', '84', '1802', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3868', '84', '1804', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3870', '84', '1801', '2', '1', '1', '18');
INSERT INTO `vcos_shop_operation_category` VALUES ('3872', '84', '1902', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('3874', '84', '1901', '2', '1', '1', '19');
INSERT INTO `vcos_shop_operation_category` VALUES ('3876', '84', '10', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3878', '84', '11', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3880', '84', '12', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3882', '84', '13', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3884', '84', '14', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3886', '84', '16', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3888', '84', '17', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3890', '84', '18', '1', '1', '1', '0');
INSERT INTO `vcos_shop_operation_category` VALUES ('3892', '84', '19', '1', '1', '1', '0');

-- ----------------------------
-- Table structure for `vcos_shop_user`
-- ----------------------------
DROP TABLE IF EXISTS `vcos_shop_user`;
CREATE TABLE `vcos_shop_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='店铺用户表';

-- ----------------------------
-- Records of vcos_shop_user
-- ----------------------------
INSERT INTO `vcos_shop_user` VALUES ('1', 'test1', '123', '1', '1', '1');
INSERT INTO `vcos_shop_user` VALUES ('2', 'test2', '12', '1', '0', '1');

-- ----------------------------
-- Procedure structure for `fun_activity_product`
-- ----------------------------
DROP PROCEDURE IF EXISTS `fun_activity_product`;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `fun_activity_product`(IN aid int)
BEGIN
declare _curr_time datetime;
set _curr_time = NOW();
SELECT
	(
		CASE
		WHEN (`t1`.`product_type` = 3) THEN
			(
				SELECT
					`t2`.`shop_title`
				FROM
					`vcos_shop` `t2`
				WHERE
					(
						`t2`.`shop_id` = `t1`.`product_id`
					)
			)
		WHEN (`t1`.`product_type` = 6) THEN
			(
				SELECT
					`t2`.`product_name`
				FROM
					`vcos_product` `t2`
				WHERE
					(
						`t2`.`product_id` = `t1`.`product_id`
					)
			)
		WHEN (`t1`.`product_type` = 4) THEN
			(
				SELECT
					`t2`.`activity_name`
				FROM
					`vcos_activity` `t2`
				WHERE
					(
						`t2`.`activity_id` = `t1`.`product_id`
					)
			)
		END
	) AS `title`,
	`t1`.`id` AS `id`,
	`t1`.`activity_id` AS `activity_id`,
	`t1`.`product_id` AS `product_id`,
	`t1`.`activity_cid` AS `activity_cid`,
	`t1`.`sort_order` AS `sort_order`,
	`t1`.`start_show_time` AS `start_show_time`,
	`t1`.`end_show_time` AS `end_show_time`,
	`t1`.`product_type` AS `product_type`
FROM
	`vcos_activity_product` `t1` 
WHERE `t1`.`activity_id` = aid 
ORDER BY
	`t1`.`product_type`,
	`t1`.`sort_order`;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `fun_activity_product_t1`
-- ----------------------------
DROP PROCEDURE IF EXISTS `fun_activity_product_t1`;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `fun_activity_product_t1`(IN aid int, IN atype int,IN page int)
BEGIN
declare _curr_time datetime;
set _curr_time = NOW();

SET @m_merage_sql_view = CONCAT('
SELECT
	(
		CASE
		WHEN (`t1`.`product_type` = 3) THEN
			(
				SELECT
					`t2`.`shop_title`
				FROM
					`vcos_shop` `t2`
				WHERE
					(
						`t2`.`shop_id` = `t1`.`product_id`
					)
			)
		WHEN (`t1`.`product_type` = 6) THEN
			(
				SELECT
					`t2`.`product_name`
				FROM
					`vcos_product` `t2`
				WHERE
					(
						`t2`.`product_id` = `t1`.`product_id`
					)
			)
		WHEN (`t1`.`product_type` = 4) THEN
			(
				SELECT
					`t2`.`activity_name`
				FROM
					`vcos_activity` `t2`
				WHERE
					(
						`t2`.`activity_id` = `t1`.`product_id`
					)
			)
		END
	) AS `title`,
	`t1`.`id` AS `id`,
	`t1`.`activity_id` AS `activity_id`,
	`t1`.`product_id` AS `product_id`,
	`t1`.`activity_cid` AS `activity_cid`,
	`t1`.`sort_order` AS `sort_order`,
	`t1`.`start_show_time` AS `start_show_time`,
	`t1`.`end_show_time` AS `end_show_time`,
	`t1`.`product_type` AS `product_type`,
	`t1`.`is_overdue` AS `is_overdue`
FROM
	`vcos_activity_product` `t1` 
WHERE `t1`.`activity_id` = ',aid);

IF atype>0 THEN
	SET @m_merage_sql_view = CONCAT(@m_merage_sql_view,' AND `t1`.`product_type` =',atype);
END IF;
SET @m_merage_sql_view = CONCAT(@m_merage_sql_view,' ORDER BY `t1`.`product_type`,`t1`.`sort_order`');
IF page>=0 THEN
	SET @m_merage_sql_view = CONCAT(@m_merage_sql_view,' LIMIT ',page);
	SET @m_merage_sql_view = CONCAT(@m_merage_sql_view,',10 ;');
END IF;

PREPARE main_stmt FROM @m_merage_sql_view;    
EXECUTE main_stmt;   

END
;;
DELIMITER ;
