<?php
namespace admin\services;
/**
** @ClassName: adminServices
** @Description: 管理员
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年2月26日 晚上21:49
** @version V1.0
*/
use hl\HLServices;
use admin\models\auth\adminModels;
use admin\models\auth\groupMenuModels;
use admin\models\auth\groupModels;
use admin\models\auth\groupRoleModels;
use admin\models\auth\logModels;
use admin\models\auth\menuModels;
use admin\models\auth\nodeModels;
use admin\models\auth\roleModels;
use admin\models\auth\roleNodeModels;

class adminServices extends HLServices
{
    /*
     * 管理员列表
     */
    public function adminList()
    {
        adminModels::getInstance();
    }
    /*CREATE TABLE `hl_auth_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录标识',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '组id',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `login_name` varchar(64) NOT NULL DEFAULT '' COMMENT '登陆名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(10) NOT NULL DEFAULT '0' COMMENT '加密盐',
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户姓名',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上次登陆时间',
  `login_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
    deleted_at  删除时间
*/

    /*
     * 编辑用详情
     */
    /*
     * 保存
     */
    /*
     * 删除
     */
}
