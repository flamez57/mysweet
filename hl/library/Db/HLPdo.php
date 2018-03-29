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
class HLPdo implements HLDBAdapter
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
        
    }
    
    /**
    * 执行数据库查询
    * @param string $query 数据库查询SQL字符串
    * @param mixed $handle 连接对象
    * @return resource
    */
    public function query($query, $handle)
    {
        
    }
}
