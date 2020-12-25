<?php
namespace blogapi\models;
/**
** @ClassName: tagsModels
** @Description: 文章标签
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class tagsModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_article_tags';
    
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

    public function tagList($where = [], $fields = '*', $orderBy = '')
    {
        $whereStr = $this->db->getPreparingWhereCondition($where, $bindParam);
        if (!empty($orderBy)) {
            $orderBy = " ORDER BY {$orderBy} ";
        }
        $limit = " LIMIT 100";
        $sql = "SELECT {$fields} FROM {$this->tableName} t ".
            "left join yx_article_tags_relevance atr on atr.tag_id = t.id ".
            "left join yx_article a on a.id = atr.article_id {$whereStr} {$orderBy} {$limit}";
        $res = $this->db->safeQuery($sql, $bindParam);
        if (!empty($res)) {
            return $res;
        } else {
            return [];
        }
    }
}
