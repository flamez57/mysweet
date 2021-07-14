<?php
namespace zhangapi\models;
/**
** @ClassName: accountBookMemberModels
** @Description: 文章
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class accountBookMemberModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_account_book_member';
    /*
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '账号手机号',
  `password` varchar(80) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密码加密盐',
  `account_book_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '当前使用的账本id',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别：0女士 1男士',
     */
    
    public function __construct()
    {
        parent::__construct();
    }

    public function doSql($sql, $db = '')
    {
        return $this->query($sql, $db);
    }

    public function insert($param = [])
    {
        $this->db->insert($this->tableName, $param);
    }
}
