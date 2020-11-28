<?php
namespace blogapi\models;
/**
** @ClassName: cateModels
** @Description: 文章分类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class cateModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_article_categories';
    
    public function __construct()
    {
        parent::__construct();
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
