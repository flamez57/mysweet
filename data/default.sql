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
-- 转存表中的数据 `data`
--

-- --------------------------------------------------------
