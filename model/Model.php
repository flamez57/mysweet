<?php
/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/6/21 20:12
 * Author: Flamez57 <1050355217@qq.com>
 */

class Model
{
	private $db;
	public $tablename;
	public $pk;
	private $fix;

	public function __construct()
	{
	    $this->fix = defined('TABLE_FIX')?TABLE_FIX:'';
	    $conf = array(
	        'host'=>defined('HOST')?HOST:'127.0.0.1',
            'user'=>defined('USERNAME')?USERNAME:'root',
            'prot'=>defined('PORT')?PORT:'3306',
            'db'=>defined('DB_NAME')?DB_NAME:'mysweet',
            'pass'=>defined('PASSWORD')?PASSWORD:''
        );

		$dsn="mysql:dbname={$conf['db']};host={$conf['host']};port={$conf['port']}";
		try{
		 	$this->db =  new PDO($dsn,$conf['user'],$conf['pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
		}catch(PDOException $e){
		   	echo '数据库连接失败'.$e->getMessage();
		}
	}

	/****
	 *过滤参数
     * @param array
     * @return bool
     */
	private function _filter(&$datas)
    {
        $fields = $this->getFields();
        foreach($datas as $_k=>$_v){
            if(isset($datas)){

            }else{
                unset($datas[$_k]);
            }
        }
        return $datas ? true : false;
    }
    /****
     * 插入数据
     * @param array
     * @return string 如果插入返回插入的id，失败返回0
     * */
	public function insert($datas)
	{
        if($this->_filter($datas)){
            if($this->exec("INSERT INTO {$this->tablename} (".join(',',array_keys($datas)).") VALUES (".join(',',$datas).")")){
                return $this->db->lastInsertId();
            }
        }
        return 0;
	}

	public function update()
	{

	}

	public function delete()
	{

	}

	//查一个字段
	public function fetchOne()
	{

	}

	//查全部
	public function fetchAll()
	{
        $sql = "SELECT * FROM ".$this->tablename;
//        return $sql;
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_ASSOC);
	}

	//查一行
	public function fetchRow()
	{

	}

	public function exec()
	{

	}

	public function query()
	{

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

	// 查看表
	private function getIndex()
	{
		$stmt = $this->db->prepare('show keys from '.$this->tablename);  
		$stmt->execute();  
		$datai = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		foreach($datai as $v){
			$data[$v['Key_name']][$v['Seq_in_index']] = $v['Column_name'];
			$data[$v['Key_name']]['Index_type'] = $v['Index_type'];
		}
		return $data;
	}

	// 查看库里面所有的表
	private function showTable()
	{
		$stmt = $this->db->prepare('show tables');  
		$stmt->execute();  
		$dataz = $stmt->fetchAll(PDO::FETCH_NUM);
		foreach($dataz as $k=>$v){
			$data[$k] = $v[0];
		}
		return $data;
	}

	// 查看建表语句
	private function showCreate()
	{
		$stmt = $this->db->prepare('show create table '.$this->tablename);  
		$stmt->execute();  
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// 获取表字段
	private function getFields($conf,$table_name,$db)
	{
		$stmt = $this->db->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$this->tablename}' AND table_schema = '{$db}'");  
		$stmt->execute();  
		$dataz = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($dataz as $v){
			$data[$v['COLUMN_NAME']]['TABLE_NAME'] = $v['TABLE_NAME'];
			$data[$v['COLUMN_NAME']]['COLUMN_NAME'] = $v['COLUMN_NAME'];
			$data[$v['COLUMN_NAME']]['COLUMN_TYPE'] = $v['COLUMN_TYPE'];
			$data[$v['COLUMN_NAME']]['EXTRA'] = $v['EXTRA'];
			$data[$v['COLUMN_NAME']]['IS_NULLABLE'] = $v['IS_NULLABLE'];
			$data[$v['COLUMN_NAME']]['COLUMN_COMMENT'] = $v['COLUMN_COMMENT'];
		}
		return $data;
	}
}







