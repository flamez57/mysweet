<?php
namespace hl;
/**
** @ClassName: HLModel
** @Description: 数据模型基类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/

class HLModel
{
    private static $_instance = NULL;
    /**
     * @return HLModel
     */
    final public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$_instance) || !self::$_instance instanceof self) {
            self::$_instance[$class] = new $class();
        }
        return self::$_instance[$class];
    }
}
