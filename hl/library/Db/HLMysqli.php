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
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $port;

    /**
    * 数据库连接函数
    * @param $config 数据库配置
    * @throws DbException
    * @return resource
    */
    public function connect($config)
    {
        $this->host = $config['host'] ?? 'localhost';
        $this->username = $config['username'] ?? 'root';
        $this->password = $config['password'] ?? '';
        $this->dbname = $config['dbname'] ?? '';
        $this->port = $config['port'] ?? '3306';
        if (!isset($this->_dbLink)) {
            @$this->_dbLink = new \mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->dbname,
                $this->port
            );
            if($this->_dbLink->connect_errno){
                die("链接错误：({$this->_dbLink->connect_errno}){$this->_dbLink->connect_error}");
            }
        }
        $this->_dbLink->set_charset($config['charset'] ?? 'utf8');
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
