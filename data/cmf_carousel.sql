/*
Navicat MariaDB Data Transfer

Source Server         : localhost
Source Server Version : 100312
Source Host           : localhost:3307
Source Database       : demo

Target Server Type    : MariaDB
Target Server Version : 100312
File Encoding         : 65001

Date: 2020-08-14 16:15:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cmf_carousel
-- ----------------------------
DROP TABLE IF EXISTS `cmf_carousel`;
CREATE TABLE `cmf_carousel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '轮播图编号',
  `image` varchar(255) DEFAULT NULL COMMENT '轮播图图片',
  `name` varchar(255) DEFAULT NULL COMMENT '轮播图名称',
  `link` varchar(255) DEFAULT NULL COMMENT '轮播图链接',
  `sort` int(11) DEFAULT 1000 COMMENT '轮播图排序',
  `status` int(11) DEFAULT 1 COMMENT '轮播图状态 1-启用 2-禁用',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
