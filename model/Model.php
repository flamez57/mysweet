<?php
/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/6/21 20:12
 * Author: Flamez57 <1050355217@qq.com>
 */
const DB = 'weixin2';
const HOST = 'localhost';
const PORT = '3306';
const USER = 'root';
const PASS = '';
const FIX = 'ims_';
class Model
{
	private $db;
	public $tablename;
	public $pk;

	public function __construct($conf)
	{
		$dsn="mysql:dbname={$conf['db']};host={$conf['host']};port={$conf['port']}";
		try{
		 	$this->db =  new PDO($dsn,$conf['user'],$conf['pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
		}catch(PDOException $e){
		   	echo '数据库连接失败'.$e->getMessage();
		}
	}

	public function insert()
	{

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
	private function getField($conf,$table_name,$db)
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







