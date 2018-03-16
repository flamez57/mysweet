<?php
namespace hl;

class HLBootstrap
{
    public static $loader;
    
    public static function init() {
        if (self::$loader == NULL) {
            self::$loader = new self ();
        }
        return self::$loader;
    }
    
    public function __construct() 
    {
        spl_autoload_register ( array ($this, 'models' ) );
        spl_autoload_register ( array ($this, 'controllers' ) );
        spl_autoload_register ( array ($this, 'services' ) );
    }
    
    public function controllers($class) 
    {
        $class = preg_replace ( '/_controller$/ui', '', $class );
        set_include_path ( get_include_path () . PATH_SEPARATOR . '/controllers/' );
        spl_autoload_extensions ( '.php' );
        spl_autoload ( $class );
    }
    
    public function models($class)
    {
        $class = preg_replace ( '/_model$/ui', '', $class );
        set_include_path ( get_include_path () . PATH_SEPARATOR . '/models/' );
        spl_autoload_extensions ( '.php' );
        spl_autoload ( $class );
    }
    
    public function services($class) 
    {
        $class = preg_replace ( '/_helper$/ui', '', $class );
        set_include_path ( get_include_path () . PATH_SEPARATOR . '/services/' );
        spl_autoload_extensions ( '.php' );
        spl_autoload ( $class );
    }
   
    public function HLinitConfig()
	{
		//把配置保存起来
	}

	public function HLinitPlugin()
	{
		//注册一个插件
	}

	public function HLinitRoute()
	{
		//在这里注册自己的路由协议,默认使用简单路由
	}

	public function HLinitView()
	{
		//在这里注册自己的view控制器，例如smarty,firekylin
	}
    
    public function run()
    {
        echo 'bootstrap run';
    }
}
// class autoloader {
  

// }
// //call
// autoloader::init ();
// function core_autoload($class_name) {
//     $prefix = substr($class_name,0,2);
//     switch($prefix){
//         case 'm_':
//             $file_name = ROOT_PATH . '/app/models/' . substr($class_name, 2) . '.php';
//         break;
//         case 'a_':
//             $file_name = ROOT_PATH . '/app/actions/' . substr($class_name, 2) . '.php';
//         break;
//         case 'u_':
//             $file_name = ROOT_PATH . '/app/lib/usr/' . substr($class_name, 2) . '.php';
//         break;
//         default:
//             $file_name =  get_include_path() . str_replace('_', '/', $class_name).'.php';
//     }
//     if( file_exists($file_name) )
//             require_once $file_name;
//     else spl_autoload($class_name);
// }
// spl_autoload_register('core_autoload');