<?php
/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/6/21 20:12
 * Author: Flamez57 <1050355217@qq.com>
 */

class Model
{
	private $db; //数据库对象
    private $db_name;  //数据库名
	public $tablename; //数据表名
	public $pk;  //主键
	private $fix;  //表前缀
    private $tableAllName; //表全名
    private $order;
    private $group;
    private $where;
    private $page;
    public $lastSql; //最后执行的sql

    //连接数据库 2017/7/18
	public function __construct()
	{
	    $this->fix = defined('TABLE_FIX')?TABLE_FIX:'';
	    $this->tableAllName = (defined('TABLE_FIX')?TABLE_FIX:'').$this->tablename;
	    $conf = array(
	        'host'=>defined('HOST')?HOST:'127.0.0.1',
            'user'=>defined('USERNAME')?USERNAME:'root',
            'prot'=>defined('PORT')?PORT:'3306',
            'db'=>defined('DB_NAME')?DB_NAME:'mysweet',
            'pass'=>defined('PASSWORD')?PASSWORD:''
        );
        $this->db_name = $conf['db'];
		$dsn="mysql:dbname={$conf['db']};host={$conf['host']};port={$conf['port']}";
		try{
		 	$this->db =  new PDO($dsn,$conf['user'],$conf['pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
		}catch(PDOException $e){
		   	echo '数据库连接失败'.$e->getMessage();
		}
	}

	/****
	 *过滤参数 2017/7/18
     * @param $data array
     * @return bool
     */
	private function _filter(&$data)
    {
        $fields = $this->getFields();
        foreach($data as $_k=>$_v){
            if(in_array($_k, $fields)){
                $_v = strtr($_v, ['\\'=>"","'" =>""]);
            }else{
                unset($data[$_k]);
            }
        }
        return $data ? true : false;
    }

    //过滤表字段 2017/7/20
    private function filterField($field)
    {
        $fields = $this->getFields();
        if (in_array($field, $fields)){
            return $field;
        } else {
            return $fields[0];
        }
    }
    /****
     * 插入数据 2017/7/18
     * @param $data array
     * @param $isReplace boolean
     * @return string 如果插入返回插入的id，失败返回0
     * */
	public function insert($data, $isReplace = false)
	{
        if($this->_filter($data)){
            if($this->exec(($isReplace?"REPLACE":"INSERT")." INTO {$this->tablename} (".join(',', array_keys($data)).") VALUES (".join(',', $data).")")){
                return $this->db->lastInsertId();
            }
        }
        return 0;
	}

	public function update()
	{
        $sql="update buyer set username='ff123' where id>3";
//$res=$pdo->exec($sql);
//echo '影响行数：'.$res;
	}

	public function delete()
	{
        //$sql="delete from buyer where id>5";
//$res=$pdo->exec($sql);
//echo '影响行数：'.$res;
	}

	/***查一个字段  2017/7/18
     * @param $field string 要查的字段
     * @param $wheres array 条件
     */
	public function fetchOne($field, $wheres = [])
	{
	    $whereH = '1=1';
	    $field = $this->filterField($field);
	    if ($this->_filter($wheres)) {
	        foreach ($wheres as $_whereKey => $_where) {
                $whereH .= " AND {$_whereKey}={$_where}";
            }
        }

	    $pre = $this->db->prepare("SELECT {$field} FROM ".$this->tableAllName." WHERE {$whereH}");
		$pre->execute();
		$this->lastSql = $pre->queryString;
		$data = $pre->fetch(PDO::FETCH_ASSOC);
		return $data[$field];
	}

	/***查全部  2017/7/20
     * @param $field string 要查的字段
     * @param $wheres array 条件
     */
	public function getAll($wheres = [], $field = '*')
	{
	    $whereH = '1=1';
	    if ($this->_filter($wheres)) {
	        foreach ($wheres as $_whereKey => $_where) {
                $whereH .= " AND {$_whereKey}={$_where}";
            }
        }
        $pre = $this->db->prepare("SELECT {$field} FROM ".$this->tableAllName." WHERE {$whereH}");
        $pre->execute();
        $this->lastSql = $pre->queryString;
        return $pre->fetchAll(PDO::FETCH_ASSOC);
	}

	/***查全部  2017/7/20
     * @param $sql string
     */
    public function fetchAll($sql)
    {
        $pre = $this->db->prepare($sql);
        $pre->execute();
        $this->lastSql = $pre->queryString;
        return $pre->fetchAll(PDO::FETCH_ASSOC);
    }

    /**查一行  2017/7/20
     * @param $wheres array 条件
     * @param $field string 要查的字段
     */
	public function getRow($wheres = [], $field = '*')
	{
	    $whereH = '1=1';
	    if ($this->_filter($wheres)) {
	        foreach ($wheres as $_whereKey => $_where) {
                $whereH .= " AND {$_whereKey}={$_where}";
            }
        }
        $pre = $this->db->prepare("SELECT {$field} FROM ".$this->tableAllName." WHERE {$whereH}");
        $pre->execute();
        $this->lastSql = $pre->queryString;
        return $pre->fetch(PDO::FETCH_ASSOC);
	}

	/**查一行  2017/7/20
     * @param $sql string
     */
    public function fetchRow($sql)
    {
        $pre = $this->db->prepare($sql);
        $pre->execute();
        $this->lastSql = $pre->queryString;
        return $pre->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchPage()
    {

    }
    public function where()
    {
        return $this;
    }

    // 排序 2017/7/20
    public function order($field, $desc = true)
    {
        $field = $this->filterField($field);
        if ($desc) {
            $this->order = " ORDER BY {$field} ASC ";
        } else {
            $this->order = " ORDER BY {$field} DESC ";
        }
        return $this;
    }

    // 分组 2017/7/20
    public function group($field)
    {
        $field = $this->filterField($field);
        $this->group = " GROUP BY {$field} ";
        return $this;
    }

    // 分页 2017/7/20
    public function page($page, $pageSize)
    {
        $limit1 = ($page - 1) * $pageSize;
        $limit2 = $pageSize;
        $this->page = " LIMIT {$limit1},{$limit2}";
        return $this;
    }

    // 查一个值 2017/7/20
    public function find($field = '')
    {
        $pre = $this->db->prepare("SELECT {$field} FROM {$this->tableAllName}{$this->where}");
        $pre->execute();
        $this->lastSql = $pre->queryString;
        return $pre->fetch(PDO::FETCH_ASSOC);
    }

    // 查一条  2017/7/20
    public function findRow($field = [])
    {
        $field = empty($field)?'*':implode(',',$field);
        $pre = $this->db->prepare("SELECT {$field} FROM {$this->tableAllName}{$this->where}");
        $pre->execute();
        $this->lastSql = $pre->queryString;
        return $pre->fetch(PDO::FETCH_ASSOC);
    }

    // 查全部  2017/7/20
    public function findAll($field = [])
    {
        $field = empty($field)?'*':implode(',',$field);
        $pre = $this->db->prepare("SELECT {$field} FROM {$this->tableAllName}{$this->where}{$this->group}{$this->order}{$this->page}");
        $pre->execute();
        $this->lastSql = $pre->queryString;
        return $pre->fetchAll(PDO::FETCH_ASSOC);
    }


	public function exec()
	{
        echo 'hello';
        return $this;
	}

	public function query()
	{
        echo 'world';
	}

	public function begin()
	{

	}

	public function commit()
	{

	}

	public function rollback()
	{

	}

	public function lastSql()
	{

	}

	public function error()
	{

	}

	public function join()
	{

	}

	private function index()
	{

	}

	// 查看表索引
	private function getIndex()
	{
		$stmt = $this->db->prepare('show keys from '.$this->fix.$this->tablename);
		$stmt->execute();  
		$datai = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		foreach($datai as $v){
			$data[$v['Key_name']][$v['Seq_in_index']] = $v['Column_name'];
			$data[$v['Key_name']]['Index_type'] = $v['Index_type'];
		}
		return $data;
	}

	// 查看建表语句 2017/7/19
	public function showCreate()
	{
		$stmt = $this->db->prepare('show create table '.$this->tableAllName);
		$stmt->execute();  
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		return $data['Create Table'];
	}

	// 获取表字段 2017/7/19
	private function getFields()
	{
		$stmt = $this->db->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$this->tableAllName}' AND table_schema = '{$this->db_name}'");
		$stmt->execute();  
		$fieldArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($fieldArr as $_field) {
			$data[] = $_field['COLUMN_NAME'];
		}
		return $data;
	}
}
