/*
 Navicat Premium Data Transfer

 Source Server         : mysql_7.x
 Source Server Type    : MySQL
 Source Server Version : 100137 (10.1.37-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : shipment

 Target Server Type    : MySQL
 Target Server Version : 100137 (10.1.37-MariaDB)
 File Encoding         : 65001

 Date: 16/05/2023 21:14:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sku_list
-- ----------------------------
DROP TABLE IF EXISTS `sku_list`;
CREATE TABLE `sku_list`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `sku` varbinary(255) NOT NULL COMMENT 'SKU',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'description',
  `description2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'description2',
  `qty` int NULL DEFAULT NULL COMMENT 'packing Uom QTY',
  `style` varbinary(255) NULL DEFAULT NULL COMMENT 'style category',
  `pack` int NULL DEFAULT NULL COMMENT 'pack',
  `length` double NULL DEFAULT NULL COMMENT 'length',
  `width` double NULL DEFAULT NULL COMMENT 'width',
  `height` double NULL DEFAULT NULL COMMENT 'height',
  `weight` double NULL DEFAULT NULL COMMENT 'weight',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
