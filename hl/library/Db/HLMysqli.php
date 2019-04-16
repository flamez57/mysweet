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
    ** @param mixed $handle 库名
    ** @return resource
    */
    public function query($query, $handle = '')
    {
        //更换数据库
        if (!empty($handle)) {
            $this->_dbLink->select_db($handle);
        }

        $res = $this->_dbLink->query($query);
        if (stripos($query, "SELECT") !== false) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
            $res->free();
        } else {
            $data = true;
        }
        return $data ?? false;
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

    /**
    **  引用参数
    **  @param array $arr
    **  @return array
    */
    protected function refValues($arr)
    {
        //对于 PHP 5.3+ 引用是必须的
        if (strnatcmp(phpversion(), '5.3') >= 0) {
            $refs = array();
            foreach ($arr as $key => $value) {
                $refs[$key] = & $arr[$key];
            }
            return $refs;
        }
        return $arr;
    }

    /**
    ** 准备查询、绑定参数并执行
    ** @param $query string sql语句
    ** @param $bindParams (array or string) 绑定参数
    ** @param $paramType (array or string) 绑定参数的类型
    ** @returns 查询结果
    */
    public function safeQuery($query, $bindParams, $paramType = NULL)
    {
        if (!is_array($bindParams)) {
            $bindParams = [$bindParams];
        }
        $stmt = $this->_dbLink->prepare($query);
        if (!is_null($paramType)) {
            if (is_array($paramType)) {
                $params[0] = implode("", $paramType);
            } else {
                $params[0] = $paramType;
            }
        } else {
            $params[0] = "";
        }
        foreach ($bindParams as $prop => $val) {
            if (is_null($paramType)) {
                $params[0] .= $this->determineType($val);
            }
            array_push($params, $bindParams[$prop]);
        }
        call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));

        if (!$stmt->execute()) {
            return false;
        }
        if (stripos($query, "SELECT") !== false) {
            $return = $stmt->get_result();
            while($row = $return->fetch_assoc()){
                $return_value[] = $row;
            }
        } else {
            $return_value = true;
        }
        $stmt->free_result();
        $stmt->close();
        return $return_value;
    }

    /*
    ** 返回上次插入事务的插入id
    */
    public function getInsertId()
    {
        return $this->_dbLink->insert_id;
    }

    /**
    ** 通过转义数据向表插入新数据集
    ** @param $table string 要插入的表
    ** @param $data array 要插入的数据
    ** @param $isReplace bool 插入方式 true 替换根据唯一键
    ** @return bool
    */
    public function insert($table, $data, $isReplace = false)
    {
        $query_col = []; //表字段
        $query_v = []; //字段对应值
        $bindProm = []; //绑定参数值
        $data = $this->escape($data);
        foreach ($data as $k => $v) {
            $query_col[] = "`" . $k . "`";
            $query_v[] = '?';
            $bindProm[] = $v;
        }
        if ($isReplace) {
            $insert = "REPLACE";
        } else {
            $insert = "INSERT";
        }
        $query = "{$insert} INTO {$table} (" . implode(", ", $query_col) . ")VALUES(" . implode(", ", $query_v) . ")";

        return  $this->safeQuery($query, $bindProm);
    }

    /**
    ** 删除以数组为参数的表行
    ** @param $table string 表名
    ** @param $where array 条件
    ** @return bool
    */
    public function delete($table, $where = [])
    {
        $whereCondition = $this->getPreparingWhereCondition($where, $bindParam);
        $query = "DELETE FROM {$table} {$whereCondition}";
        return $this->safeQuery($query, $bindParam);
    }

    /**
    ** 使用数组作为参数更新表
    ** @param $table string 表名
    ** @param $data array 更新的数据
    ** @param $where array 条件
    ** @return bool
    */
    public function update($table, $data, $where = [])
    {
        $query_v = [];
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (is_array($v)) {
                    $query_v[] = "`" . $k .  "`=" .  $this->escape($v[0]);
                    unset($data[$k]);
                } else {
                    $query_v[] = "`" . $k .  "`=? ";
                }
            }
            $whereCondition = $this->getPreparingWhereCondition($where, $bindParam);
            $query = "UPDATE {$table} SET " . implode(", ", $query_v) . $whereCondition;
            return $this->safeQuery($query, array_merge(array_values($data), $bindParam));
        } else {
            return false;
        }
    }

    /**
    ** where 条件拼接
    ** @param $where array 条件数组
    ** @param $bindParam array 要绑定的参数
    ** @return string
    */
    public function getPreparingWhereCondition($where, &$bindParam = [])
    {
        if (empty($where)) {
            return "";
        } else {
            $whereStr = " WHERE ";
            $where = $this->escape($where);
            foreach ($where as $k => $v) {
                if (is_array($v)) {
                    $opStr = strtolower($v[0]);
                    $opVal = $v[1];
                    switch ($opStr) {
                        case 'exp':
                            $query_w[] = "`{$k}`={$opVal}";
                            break;
                        case 'neq':
                        case '!=':
                            $query_w[] = "`{$k}`<>?";
                            $bindParam[] = $opVal;
                            break;
                        case 'eq':
                        case '=':
                            $query_w[] = "`{$k}`=?";
                            $bindParam[] = $opVal;
                            break;
                        case 'gt':
                            $query_w[] = "`{$k}`>?";
                            $bindParam[] = $opVal;
                            break;
                        case 'gte':
                        case 'egt':
                            $query_w[] = "`{$k}`>=?";
                            $bindParam[] = $opVal;
                            break;
                        case 'lt':
                            $query_w[] = "`{$k}`<?";
                            $bindParam[] = $opVal;
                            break;
                        case 'lte':
                        case 'elt':
                            $query_w[] = "`{$k}`<=?";
                            $bindParam[] = $opVal;
                            break;
                        case 'between':
                            if (count($v) < 3) {
                                $this->errorMsg .= 'between value must be not empty array';
                            }
                            $query_w[] = "`{$k}`>=? AND `{$k}`<?";
                            $bindParam[] = $v[1];
                            $bindParam[] = $v[2];
                            break;
                        case 'like':
                            $query_w[] = "`{$k}` LIKE ?";
                            $bindParam[] = "%" . trim($opVal, '%') . "%";
                            break;
                        case 'or':
                            if (count($v) < 2) {
                                $this->errorMsg .= 'or value must be not empty array';
                            }
                            $opVal = array_slice($v, 1);
                            $orStrArr = [];
                            foreach ($opVal as $orVal) {
                                $orStrArr[] = "`{$k}` = ?";
                                $bindParam[] = $orVal;
                            }
                            $query_w[] = "(" . implode(' OR ', $orStrArr) . ")";
                            break;
                        case 'intersection':
                            if (count($v) < 2) {
                                $this->errorMsg .= 'intersection value must be not empty array';
                            }
                            $opVal = array_slice($v, 1);
                            $tmpStrArr = [];
                            foreach ($opVal as $_itemVal) {
                                $tmpStrArr[] = "($_itemVal)";
                            }
                            $query_w[] = " AND NOT (" . implode(' OR ', $tmpStrArr) . ")";
                            break;
                        case 'in':
                            $orStrArr = [];
                            foreach ($opVal as $orVal) {
                                $orStrArr[] = "`{$k}` = ?";
                                $bindParam[] = $orVal;
                            }
                            $query_w[] = "(" . implode(' OR ', $orStrArr) . ")";
                            break;
                        case 'nin':
                            $orStrArr = [];
                            foreach ($opVal as $orVal) {
                                $orStrArr[] = "`{$k}` <> ?";
                                $bindParam[] = $orVal;
                            }
                            $query_w[] = "(" . implode(' OR ', $orStrArr) . ")";
                            break;
                        default:
                            $this->errorMsg .= 'not define sql option ' . $opStr;
                    }
                } else {
                    $query_w[] = "`{$k}`=?";
                    $bindParam[] = $v;
                }
            }
            return $whereStr.implode(" AND ", $query_w)." ";
        }
    }

    /**
    ** 使用数组作为参数选择表的行
    ** @param $table string 表名
    ** @param $fields string|array 查询字段
    ** @param $where array 条件
    ** @return array
    */
    public function select($table, $fields = '*', $where = [])
    {
        if (is_array($fields)) {
            $fields = implode(",", $fields);
        }
        $query="SELECT {$fields} FROM {$table} ";
        if (empty($where)) {
            return $this->query($query);
        }
        $whereCondition = $this->getPreparingWhereCondition($where, $bindParam);
        $query .= $whereCondition;
        return $this->safeQuery($query, $bindParam);
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
