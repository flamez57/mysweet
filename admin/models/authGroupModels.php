<?php
namespace admin\models;
/**
** @ClassName: installModels
** @Description: 安装数据模型
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class authGroupModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'default';
    
    /*
    ** 数据表
    */
    public $tableName = 'hl_auth_group';
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
    ** 执行sql并选择数据表
    ** @param $sql string sql
    ** @param $db string 库名
    ** @return bool
    */
    public function execSql($sql, $db = '')
    {
        $this->query($sql, $db);
    }
}
