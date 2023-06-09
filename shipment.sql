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

 Date: 17/05/2023 18:12:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for container
-- ----------------------------
DROP TABLE IF EXISTS `container`;
CREATE TABLE `container`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shipment_id` int NOT NULL COMMENT 'shipment_id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'container name #CCCC',
  `pl` int NULL DEFAULT 0 COMMENT '0-new 1-older',
  `asst` int NULL DEFAULT NULL COMMENT '1-active 0-non',
  `tops` int NOT NULL COMMENT '1-single top, 2-multi tops',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'created_date',
  `show_flag` int NOT NULL DEFAULT 1 COMMENT '1-show 0-hide',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shipment_foregin`(`shipment_id` ASC) USING BTREE,
  CONSTRAINT `shipment_foregin` FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for shipment
-- ----------------------------
DROP TABLE IF EXISTS `shipment`;
CREATE TABLE `shipment`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'folder name',
  `input_1_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Bill of Lading file name',
  `input_2_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Invoice name',
  `input_3_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'packging list file name',
  `input_4_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'other file name',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'comment',
  `created_at` time NULL DEFAULT NULL COMMENT 'created date',
  `show_flag` tinyint NOT NULL DEFAULT 1 COMMENT '1-show 0-hide',
  `out_1_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SHIPMENT FILE',
  `out_2_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'MASTER FILE IMPORT FILE',
  `out_3_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Receiver Upload',
  `out_4_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'PL S',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for shipment_details
-- ----------------------------
DROP TABLE IF EXISTS `shipment_details`;
CREATE TABLE `shipment_details`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shipment_id` int NULL DEFAULT NULL COMMENT 'shipment_id',
  `container_id` int NULL DEFAULT NULL COMMENT 'container_id',
  `po` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'PO#',
  `style` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Style',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'description',
  `hts` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'HTS',
  `pcs_carton` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'PCS/CARTON',
  `ctn` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'CTN',
  `total` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TOTAL',
  `uom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'UOM',
  `ds` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'DS',
  `customer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Customer',
  `ship` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ship',
  `cancel` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'CANCEL',
  `customer_po` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'CUSTOMER PO',
  `inv` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'INV',
  `ext_req` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'EXT_REQ',
  `rcvd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'RCVD',
  `short_over` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SHORT/OVER',
  `so` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SO',
  `notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'NOTES',
  `upc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'UPC',
  `length` double NULL DEFAULT NULL COMMENT 'Length',
  `width` double NULL DEFAULT NULL COMMENT 'Width',
  `height` double NULL DEFAULT NULL COMMENT 'Height',
  `weight` double NULL DEFAULT NULL COMMENT 'weight',
  `cbm` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'CBM',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT 'PRICE',
  `show_flag` int NOT NULL DEFAULT 1 COMMENT '1-show 0-hide',
  `pl_new` int NOT NULL DEFAULT 0 COMMENT '0-old, 1-new',
  `asst` int UNSIGNED NULL DEFAULT 0 COMMENT '0-non active, 1-active',
  `single_top` int NULL DEFAULT 0 COMMENT '0-non active, 1-active',
  `multi_top` int NULL DEFAULT 0 COMMENT '0-non active, 1-active',
  `pl_add_flag` int NULL DEFAULT 0 COMMENT '0-add 1-new',
  `description2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'description2',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `container_forgin`(`container_id` ASC) USING BTREE,
  INDEX `shipment`(`shipment_id` ASC) USING BTREE,
  CONSTRAINT `container_forgin` FOREIGN KEY (`container_id`) REFERENCES `container` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `shipment` FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for shipment_header
-- ----------------------------
DROP TABLE IF EXISTS `shipment_header`;
CREATE TABLE `shipment_header`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shipment_id` int NOT NULL COMMENT 'shipment id',
  `date_entered` date NULL DEFAULT NULL COMMENT 'DATA ENTERED',
  `shipment_type` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'SHIPMENT TYPE',
  `factory` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'FACTORY',
  `carrier` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'CARRIERP',
  `bl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'BL#',
  `bill_date` date NULL DEFAULT NULL COMMENT 'BILL/INV DATE',
  `docs_date` date NULL DEFAULT NULL COMMENT 'DOCS RCVD DATE',
  `bill` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'BILL#',
  `amount` double NULL DEFAULT NULL COMMENT 'AMOUNT',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'created date',
  `bill_check` int NOT NULL DEFAULT 0 COMMENT 'bill_check step4 0-non 1-active',
  `po_check` int NOT NULL DEFAULT 0 COMMENT 'po_check 0-non 1-active',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shipment_id`(`shipment_id` ASC) USING BTREE,
  CONSTRAINT `shipment_header_ibfk_1` FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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

-- ----------------------------
-- Table structure for upc
-- ----------------------------
DROP TABLE IF EXISTS `upc`;
CREATE TABLE `upc`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `upc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'upc code-f',
  `sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Mpn-d',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 700 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
