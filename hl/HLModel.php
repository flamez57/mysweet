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
        $this->db->connect($config['db'][$this->_db] + ['dbname' => $this->_db]);
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
    public function query($sql)
    {
        $this->setLastQuery($sql);
        return $this->db->query($sql);
    }
}
