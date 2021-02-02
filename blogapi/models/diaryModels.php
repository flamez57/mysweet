<?php
namespace blogapi\models;
/**
** @ClassName: diaryModels
** @Description: 日记
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class diaryModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_article_diary';
    
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
