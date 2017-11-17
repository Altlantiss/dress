/*
 Navicat Premium Data Transfer

 Source Server         : dress
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : dress

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 14/11/2017 11:09:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dress_admin
-- ----------------------------
DROP TABLE IF EXISTS `dress_admin`;
CREATE TABLE `dress_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dress_admin
-- ----------------------------
INSERT INTO `dress_admin` VALUES (1, 'admin', 'admin');

-- ----------------------------
-- Table structure for dress_dresses
-- ----------------------------
DROP TABLE IF EXISTS `dress_dresses`;
CREATE TABLE `dress_dresses`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `did` int(255) NULL DEFAULT NULL,
  `dress_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dress_sex` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dress_dresses
-- ----------------------------
INSERT INTO `dress_dresses` VALUES (1, 1, '中式婚服', 1);
INSERT INTO `dress_dresses` VALUES (2, 2, '黑色西装婚服', 1);
INSERT INTO `dress_dresses` VALUES (3, 3, '烟灰色西装婚服', 1);
INSERT INTO `dress_dresses` VALUES (4, 4, '中式旗袍婚纱', 0);
INSERT INTO `dress_dresses` VALUES (5, 5, '公主婚纱', 0);
INSERT INTO `dress_dresses` VALUES (6, 6, '鱼尾婚纱', 0);

-- ----------------------------
-- Table structure for dress_rent
-- ----------------------------
DROP TABLE IF EXISTS `dress_rent`;
CREATE TABLE `dress_rent`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NULL DEFAULT NULL,
  `uid` int(255) NULL DEFAULT NULL,
  `dress_ma` int(15) NULL DEFAULT NULL,
  `dress_receive` int(15) NULL DEFAULT NULL,
  `plan_return` int(15) NULL DEFAULT NULL,
  `actual_return` int(15) NULL DEFAULT NULL,
  `overdue_return` int(11) NULL DEFAULT 0,
  `dress_man` int(11) NULL DEFAULT 0,
  `dress_woman` int(11) NULL DEFAULT 0,
  `deposit` decimal(65, 2) NULL DEFAULT NULL,
  `receipt_number` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '201701010000',
  `handler` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` int(15) NULL DEFAULT NULL,
  `state` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dress_rent
-- ----------------------------
INSERT INTO `dress_rent` VALUES (1, 1, 1, 20170101, 20170101, 20170102, 20170102, 0, 8, 0, 500.00, '201701010000', '小明', 20170101, 3);
INSERT INTO `dress_rent` VALUES (2, 2, 2, 20170301, 20170301, 20170302, 20170302, 0, 16, 1, 2500.00, '201701010001', '小明', 20170301, 3);

-- ----------------------------
-- Table structure for dress_storage
-- ----------------------------
DROP TABLE IF EXISTS `dress_storage`;
CREATE TABLE `dress_storage`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `dress_number` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of dress_storage
-- ----------------------------
INSERT INTO `dress_storage` VALUES (1, 34);
INSERT INTO `dress_storage` VALUES (2, 10);
INSERT INTO `dress_storage` VALUES (3, 10);
INSERT INTO `dress_storage` VALUES (4, 10);
INSERT INTO `dress_storage` VALUES (5, 10);
INSERT INTO `dress_storage` VALUES (6, 10);

-- ----------------------------
-- Table structure for dress_udrm
-- ----------------------------
DROP TABLE IF EXISTS `dress_udrm`;
CREATE TABLE `dress_udrm`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NULL DEFAULT NULL,
  `uid` int(11) NULL DEFAULT NULL,
  `did` int(11) NULL DEFAULT NULL,
  `number` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of dress_udrm
-- ----------------------------
INSERT INTO `dress_udrm` VALUES (1, 1, 1, 1, 3);
INSERT INTO `dress_udrm` VALUES (2, 1, 1, 2, 5);
INSERT INTO `dress_udrm` VALUES (3, 2, 2, 1, 9);
INSERT INTO `dress_udrm` VALUES (4, 2, 2, 4, 1);
INSERT INTO `dress_udrm` VALUES (5, 2, 2, 2, 7);

-- ----------------------------
-- Table structure for dress_user
-- ----------------------------
DROP TABLE IF EXISTS `dress_user`;
CREATE TABLE `dress_user`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qq` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total_consumption` decimal(65, 2) NULL DEFAULT 0.00,
  `total_integral` int(255) NULL DEFAULT 0,
  `esidual_integral` int(255) NULL DEFAULT 0,
  `card_number` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0001001001',
  `discount` decimal(10, 1) NULL DEFAULT 10.0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 85 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dress_user
-- ----------------------------
INSERT INTO `dress_user` VALUES (1, 1, '张三三', '13815139353', '597936721', 10000.00, 10000, 10000, '0001001001', 5.0);
INSERT INTO `dress_user` VALUES (2, 2, '李四', '13901928475', '283758493', 1500.00, 1500, 1000, '0001001002', 9.5);
INSERT INTO `dress_user` VALUES (3, 3, '王五', '12938475932', '293847501', 100.00, 100, 100, '0001001003', 10.0);
INSERT INTO `dress_user` VALUES (4, 4, '赵六', '13026749202', '738294037', 7000.00, 7000, 4000, '0001001004', 8.0);

SET FOREIGN_KEY_CHECKS = 1;
