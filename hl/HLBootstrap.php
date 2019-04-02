<?php
namespace hl;
/**
** @ClassName: HLBootstrap
** @Description:自动加载器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/

class HLBootstrap
{
    /*
    ** 加载器实例
    */
    public static $loader;
    
    /*
    ** 实例化自身
    */
    public static function init()
    {
        if (self::$loader == NULL) {
            self::$loader = new self();
        }
        return self::$loader;
    }
    
    /*
    ** 注册类
    */
    public function __construct()
    {
        spl_autoload_register(array($this, 'controllers'));
        spl_autoload_register(array($this, 'library'));
    }
    
    /*
    ** 惰性加载类（加载控制器前身）
    */
    private function controllers($class)
    {
        spl_autoload($class);
    }

    /*
    ** 加在library里面的
    */
    private function library($class)
    {
        $class = explode('\\', $class);
        $class = implode(DIRECTORY_SEPARATOR, $class);
        set_include_path(get_include_path () . PATH_SEPARATOR . ROOT_PATH . $class);
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }
}
