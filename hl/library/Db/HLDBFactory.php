<?php
namespace hl\library\Db;

/**
** @ClassName: HLDBFactory
** @Description: 数据库工厂
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月29日 晚上21:49
** @version V1.0
*/

class HLDBFactory
{
    public static function factory($type)
    {
        if (class_exists('hl\library\Db\HL'.$type)) {
            $classname = 'hl\library\Db\HL'.$type;
            return new $classname;
        } else {
            throw new Exception('Driver not found');
        }
    }
}
