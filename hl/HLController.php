<?php
namespace hl;

class HLController
{
    private static $_instance = NULL;
    /**
     * @return mysqlDao
     */
    final public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$_instance) || !self::$_instance instanceof self) {
            self::$_instance[$class] = new $class();
        }
        return self::$_instance[$class];
    }
    
    public function run()
    {
        echo 'hello world!';
    }
}
