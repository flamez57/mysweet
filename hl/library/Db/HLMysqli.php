<?php
namespace hl\library\Db;

use hl\library\Db\HLDBAdapter;
/**
** @ClassName: HLMysqli
** @Description: MySQLi操作数据库
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月29日 晚上21:49
** @version V1.0
*/
class HLMysqli implements HLDBAdapter
{
    private $_dbLink; //数据库连接字符串表示

    /**
    * 数据库连接函数
    * @param $config 数据库配置
    * @throws DbException
    * @return resource
    */
    public function connect($config)
    {
        if (!isset($this->_dbLink)) {
            $this->_dbLink = new \mysqli(
                $config['host'],
                $config['username'],
                $config['password'],
                $config['dbname'],
                $config['port']
            );
            if($this->_dbLink->connect_errno){
                die("链接错误：({$this->_dbLink->connect_errno}){$this->_dbLink->connect_error}");
            }
        }
        $this->_dbLink->set_charset($config['charset']);
    }
    
    /**
    * 执行数据库查询
    * @param string $query 数据库查询SQL字符串
    * @param mixed $handle 连接对象
    * @return resource
    */
    public function query($query, $handle)
    {
        $res = $this->_dbLink->query($query);
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        $res->free();
        $this->_dbLink->close();
        return $data ?? [];
    }
}
