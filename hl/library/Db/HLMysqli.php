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
    private $errorMsg = ''; //错误信息

    /**
    ** 数据库连接函数
    ** @param $config 数据库配置
    ** @throws DbException
    ** @return resource
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
    ** 执行数据库查询
    ** @param string $query 数据库查询SQL字符串
    ** @param mixed $handle 连接对象
    ** @return resource
    */
    public function query($query, $handle = '')
    {
        //更换数据库
        if (!empty($handle)) {
            $this->_dbLink->select_db($this->_dbLink, $handle);
        }
        $res = $this->_dbLink->query($query);
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        $res->free();
        return $data ?? [];
    }

    /*
    ** 返回上次查询事务的错误
    */
    public function lastError()
    {
        return $this->_dbLink->error;
    }

    /**
    ** 当当前类中没有找到方法时，如果在mysqli类中找到方法，则调用mysqli类的方法
    ** @param $name string 方法名
    ** @param $arguments array 数组的参数
    ** @return 如果在mysqli类中没有找到方法则吸入错误信息errorMsg
    */
    public function __call($name, $arguments)
    {
        if (method_exists($this->_dbLink, $name)) {
            return call_user_func_array(array($this->_dbLink, $name), $arguments);
        }
        $this->errorMsg .= " ==Called to undefined method {$name}!== ";
    }

    /**
    ** 如果在当前类中没有找到属性，则返回mysqli类的属性
    ** @param $name string 属性名称
    ** @return 如果调用属性mysqli也不存在错误信息写入errorMsg
    */
    public function __get($name)
    {
        if (property_exists(array($this->_dbLink, $name))) {
            return $this->_dbLink->$name;
        }
        $this->errorMsg .= " ==Called to undefined property {$name}!== ";
    }

    /**
    ** 确定准备查询的绑定参数的类型
    ** @param $item string 要确定其类型的字符串
    ** @return string
    */
    protected function determineType($item)
    {
        switch (gettype($item)) {
            case 'NULL':
            case 'string':
                return 's';
                break;
            case 'integer':
                return 'i';
                break;
            case 'blob':
                return 'b';
                break;
            case 'double':
                return 'd';
                break;
        }
        return '';
    }

    /**
    ** 转义字符串或数组元素
    ** @param $var array|string 要转义的字符串或数组
    ** @param $recurseEscape bool 如果设置为true并且$var是数组，则转义$var数组的所有元素
    ** @return array|string
    */
    public function escape($var, $recurseEscape = true)
    {
        if (!is_array($var)) {
            $res = $this->_dbLink->real_escape_string($var);
        } else {
            $res = array();
            foreach ($var as $key=>$value) {
                if ($recurseEscape) {
                    $res[$key] = $this->escape($value, $recurseEscape);
                } else {
                    $res[$key] = $value;
                }

            }
        }
        return $res;
    }

    /*
    ** 当脚本执行完执行这个参数
    */
    public function __destruct()
    {
        if(isset($this->_dbLink)){
            $this->_dbLink->close();
        }

    }
}
