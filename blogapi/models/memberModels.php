<?php
namespace blogapi\models;
/**
** @ClassName: memberModels
** @Description: 成员
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class memberModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_member';
    
    public function __construct()
    {
        parent::__construct();
    }

    /*
    ** 根据code获取member_id
    */
    public function getMemberIdByCode($code)
    {
        $sql = "SELECT id FROM {$this->tableName} WHERE code = :code";
        return $this->getOne($sql, ['code' => $code]);
    }

    public function doSql($sql, $db = '')
    {
        return $this->query($sql, $db);
    }

    public function insert($table, $param = [])
    {
        $this->db->insert($table, $param);
    }
}
