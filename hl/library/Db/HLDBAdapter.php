<?php
namespace hl\library\Db;

/**
** @ClassName: HLDBAdapter
** @Description: 数据库适配器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月29日 晚上21:49
** @version V1.0
*/
interface HLDBAdapter
{
    /**
    ** 数据库连接
    ** @param $config 数据库配置
    ** @return resource
    */
    public function connect($config);
    
    /**
    ** 执行数据库查询
    ** @param string $query 数据库查询SQL字符串
    ** @param mixed $handle 连接对象
    ** @return resource
    */
    public function query($query, $handle);
}
