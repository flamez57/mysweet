/*
Navicat MySQL Data Transfer

Source Server         : wamp64
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2020-11-28 15:07:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yx_article
-- ----------------------------
DROP TABLE IF EXISTS `yx_article`;
CREATE TABLE `yx_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(4) NOT NULL DEFAULT '0' COMMENT '用户id',
  `cate_id` int(4) NOT NULL DEFAULT '0' COMMENT '分类id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容',
  `drafts_content` text COMMENT '草稿内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0草稿 1发布',
  `pv` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问量',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='博文表';

-- ----------------------------
-- Records of yx_article
-- ----------------------------

-- ----------------------------
-- Table structure for yx_article_categories
-- ----------------------------
DROP TABLE IF EXISTS `yx_article_categories`;
CREATE TABLE `yx_article_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启 1开启 0禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='博文分类表';

-- ----------------------------
-- Records of yx_article_categories
-- ----------------------------

-- ----------------------------
-- Table structure for yx_article_comment
-- ----------------------------
DROP TABLE IF EXISTS `yx_article_comment`;
CREATE TABLE `yx_article_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(4) NOT NULL DEFAULT '0' COMMENT '文章id',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `nickname` varchar(30) NOT NULL DEFAULT '' COMMENT '评价人昵称',
  `ip` char(15) NOT NULL DEFAULT '' COMMENT '评价人IP',
  `reply_content` varchar(255) NOT NULL DEFAULT '' COMMENT '回复内容',
  `reply_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='评论表';

-- ----------------------------
-- Records of yx_article_comment
-- ----------------------------

-- ----------------------------
-- Table structure for yx_article_diary
-- ----------------------------
DROP TABLE IF EXISTS `yx_article_diary`;
CREATE TABLE `yx_article_diary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(4) NOT NULL DEFAULT '0' COMMENT '用户id',
  `year` int(4) unsigned NOT NULL DEFAULT '2020' COMMENT '年',
  `mon` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '月',
  `day` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '日',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='日记表';

-- ----------------------------
-- Records of yx_article_diary
-- ----------------------------

-- ----------------------------
-- Table structure for yx_article_tags
-- ----------------------------
DROP TABLE IF EXISTS `yx_article_tags`;
CREATE TABLE `yx_article_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '标签名称',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0待审核 1审核通过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='博文标签表';

-- ----------------------------
-- Records of yx_article_tags
-- ----------------------------

-- ----------------------------
-- Table structure for yx_article_tags_relevance
-- ----------------------------
DROP TABLE IF EXISTS `yx_article_tags_relevance`;
CREATE TABLE `yx_article_tags_relevance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(4) NOT NULL DEFAULT '0' COMMENT '文章id',
  `tag_id` int(4) NOT NULL DEFAULT '0' COMMENT '标签id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='博文标签关联表';

-- ----------------------------
-- Records of yx_article_tags_relevance
-- ----------------------------

-- ----------------------------
-- Table structure for yx_member
-- ----------------------------
DROP TABLE IF EXISTS `yx_member`;
CREATE TABLE `yx_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '账号',
  `nickname` varchar(30) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `password` varchar(40) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密码加密盐',
  `motto` varchar(255) NOT NULL DEFAULT '' COMMENT '座右铭',
  `home_page` varchar(255) NOT NULL DEFAULT '' COMMENT '主页',
  `github` varchar(255) NOT NULL DEFAULT '' COMMENT 'github',
  `qq` varchar(255) NOT NULL DEFAULT '' COMMENT 'qq',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `content` text COMMENT '简介',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `regip` char(15) NOT NULL DEFAULT '' COMMENT '注册IP',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，0禁止，1正常',
  `token` varchar(40) NOT NULL DEFAULT '' COMMENT '登陆密钥',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

-- ----------------------------
-- Records of yx_member
-- ----------------------------

-- ----------------------------
-- Table structure for yx_member_log
-- ----------------------------
DROP TABLE IF EXISTS `yx_member_log`;
CREATE TABLE `yx_member_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `before_data` text COMMENT '变动前数据',
  `after_data` text COMMENT '变动后数据',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `relevant_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联ID',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='日志';

-- ----------------------------
-- Records of yx_member_log
-- ----------------------------
