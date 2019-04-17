-- ==============================================权限管理============================================================

--
-- 表的结构 `hl_admin`
--
CREATE TABLE IF NOT EXISTS `hl_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录标识',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '组id',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `login_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '登陆名',
  `password` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(10) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0' COMMENT '加密盐',
  `username` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '用户姓名',
  `mobile` varchar(20) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '邮箱',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上次登陆时间',
  `login_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';
--
-- 表的结构 `hl_role`
--
CREATE TABLE IF NOT EXISTS `hl_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级角色id',
  `role_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '角色名称',
  `description` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色表';
--
-- 表的结构 `hl_node`
--
CREATE TABLE IF NOT EXISTS `hl_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点id',
  `menu_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `node_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '节点名',
  `rule` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '节点规则',
  `preg` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否正则匹配 0否',
  `description` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='节点表';
--
-- 表的结构 `hl_group`
--
CREATE TABLE IF NOT EXISTS `hl_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '组id',
  `role_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '组名称',
  `description` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '组描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='组表';
--
-- 表的结构 `hl_menu`
--
CREATE TABLE IF NOT EXISTS `hl_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级菜单id',
  `menu_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '菜单名',
  `description` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '菜单描述',
  `icon` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0' COMMENT '菜单图标',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='菜单表';
--
-- 表的结构 `hl_group_role`
--
CREATE TABLE IF NOT EXISTS `hl_group_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录标识',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '组id',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='组和角色关联表';
--
-- 表的结构 `hl_group_menu`
--
CREATE TABLE IF NOT EXISTS `hl_group_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录标识',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '组id',
  `menu_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='组和菜单关联表';
--
-- 表的结构 `hl_role_node`
--
CREATE TABLE IF NOT EXISTS `hl_role_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录标识',
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点id',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='节点角色关联表';
--
-- 表的结构 `hl_log`
--
CREATE TABLE IF NOT EXISTS `hl_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作类型 节点id',
  `content` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '操作内容',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='操作日志表';
-- --------------------------------------------------------
--
-- 转存表中的数据 `data`
--
