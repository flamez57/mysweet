<?php
namespace zhangapi\models;
/**
** @ClassName: accountBookModels
** @Description: 文章
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class accountBookModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_account_book';
    /*
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
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
