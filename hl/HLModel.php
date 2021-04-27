<?php
namespace hl;

use hl\HLSington;
use hl\library\Db\HLDBFactory;
/**
** @ClassName: HLModel
** @Description: 数据模型基类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/

class HLModel extends HLSington
{
    /*
    ** 数据库对象
    */
    public $db;
    
    /*
    ** 所选数据库
    */
    public $_db;

    /*
     * 主键
     */
    public $id = 'id';

    public $tableName;

    /*
    ** 查询上次连接数据库请求的查询
    */
    private $lastQuery = '';

    public function __construct()
    {
        $config = self::$config;
        $this->db = HLDBFactory::factory('Mysqli');
        if (!isset($config['db'][$this->_db])) {
            die("{$this->_db}配置信息不存在");
        }
        $this->db->connect($config['db'][$this->_db]);
    }

    /*
    ** 获取最后执行的sql
    */
    public function getLastQuery()
    {
        return $this->lastQuery;
    }

    /*
    ** 写入最后执行的sql
    */
    public function setLastQuery($query)
    {
        $this->lastQuery=$query;
    }

    /*
    ** 执行sql返回结果
    */
    public function query($sql, $db = '')
    {
        $this->setLastQuery($sql);
        return $this->db->query($sql, $db);
    }

    /*
    ** 获取一条
    */
    public function getRow($sql, $params = [])
    {
        if (strpos(strtoupper($sql), 'LIMIT ') === false) {
            $sql = trim($sql, '; ') . ' LIMIT 0, 1';
        }
        $res = $this->db->safeQuery($sql, $params);
        if (!empty($res)) {
            return current($res);
        } else {
            return [];
        }
    }

    /*
    ** 获取一个值
    */
    public function getOne($sql, $params = [])
    {
        if (strpos(strtoupper($sql), 'LIMIT ') === false) {
            $sql = trim($sql, '; ') . ' LIMIT 0, 1';
        }
        $res = $this->db->safeQuery($sql, $params);
        if (!empty($res)) {
            return current($res[0]);
        } else {
            return '';
        }
    }

    /*
    ** 获取列表
    */
    public function getAll($sql, $params = [])
    {
        return $this->db->safeQuery($sql, $params);
    }

    /*
     * 默认取一条
     */
    public function getByWhere($where = [], $fields = '*', $orderBy = '', $groupBy = '', $limit = 1)
    {
        $whereStr = $this->db->getPreparingWhereCondition($where, $bindParam);
        if (!empty($orderBy)) {
            $orderBy = " ORDER BY {$orderBy} ";
        }
        if (!empty($groupBy)) {
            $groupBy = " GROUP BY {$groupBy} ";
        }
        $limit = " LIMIT {$limit}";
        $sql = "SELECT {$fields} FROM {$this->tableName} {$whereStr} {$groupBy} {$orderBy} {$limit}";
        if (empty($where)) {
            $res = $this->db->query($sql, $bindParam);
        } else {
            $res = $this->db->safeQuery($sql, $bindParam);
        }
        if (!empty($res)) {
            if ($limit != ' LIMIT 1') {
                return $res;
            } else {
                return current($res);
            }
        } else {
            return [];
        }
    }

    /*
    ** 获取条数
    */
    public function getCountByWhere($where = [])
    {
        $whereStr = $this->db->getPreparingWhereCondition($where, $bindParam);
        $limit = " LIMIT 1";
        $sql = "SELECT COUNT(1) num FROM {$this->tableName} {$whereStr} {$limit}";
        if (empty($where)) {
            $res = $this->db->query($sql, $bindParam);
        } else {
            $res = $this->db->safeQuery($sql, $bindParam);
        }
        if (!empty($res)) {
            return current($res)['num'];
        } else {
            return 0;
        }
    }

    public function updateByWhere($where, $data)
    {
        return $this->db->update($this->tableName, $data, $where);
    }

    public function updateById($id, $data)
    {
        return $this->db->update($this->tableName, $data, [$this->id => $id]);
    }

    /*
     * 减少
     */
    public function decr($where, $field, $step = 1)
    {
        return $this->db->update($this->tableName, [$field => ["$field - $step"]], $where);
    }

    /*
     * 增加
     */
    public function incr($where, $field, $step = 1)
    {
        return $this->db->update($this->tableName, [$field => ["$field + $step"]], $where);
    }

    //根据id删除
    public function delById($id)
    {
        return $this->db->delete($this->tableName, [$this->id => $id]);
    }

    //根据where删除
    public function delByWhere($where = [])
    {
        return $this->db->delete($this->tableName, $where);
    }
}
