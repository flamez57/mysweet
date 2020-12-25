<?php
namespace blogapi\models;
/**
** @ClassName: articleModels
** @Description: 文章
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class articleModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_article';
    
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

    public function articleList($where = [], $fields = '*', $orderBy = '', $limit = 1)
    {
        $whereStr = $this->db->getPreparingWhereCondition($where, $bindParam);
        if (!empty($orderBy)) {
            $orderBy = " ORDER BY {$orderBy} ";
        }
        $limit = " LIMIT {$limit}";
        $sql = "SELECT {$fields} FROM {$this->tableName} a ".
            "left join yx_article_tags_relevance atr on atr.article_id = a.id ".
            " {$whereStr} {$orderBy} {$limit}";
        $res = $this->db->safeQuery($sql, $bindParam);
        if (!empty($res)) {
            return $res;
        } else {
            return [];
        }
    }
}
