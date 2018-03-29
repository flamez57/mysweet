<?php
namespace hl;
/**
** @ClassName: HLSington
** @Description: 单例实现
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月29日 晚上22:49
** @version V1.0
*/
class HLSington
{
    private static $_instance = NULL;
    /**
     * @return HLSington
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
