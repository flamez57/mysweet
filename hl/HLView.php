<?php
namespace hl;

use hl\HLSington;
/**
** @ClassName: HLView
** @Description: 视图基类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月29日 晚上22:49
** @version V1.0
*/

class HLView
{
    /*
    ** 模块
    */
    private static $module;
    
    /*
    ** 视图目录
    */
    private static $viewPath;
    
    /*
    ** 公共文件目录
    */
    private static $publicPath;
    
    /*
    ** 是否默认模板
    */
    private static $default;
    
    /*
    ** 输出参数
    */
    public static $putout;

    /*
    ** 初始化
    ** @param $module string
    ** @param $viewPath string
    ** @return void
    */
    public static function init($module, $viewPath)
    {
        self::$default = true;
        self::$module = $module;
        self::$viewPath = $viewPath;
        self::$publicPath = 'http://'.HTTP_HOST.'public'.DIRECTORY_SEPARATOR.self::$module.DIRECTORY_SEPARATOR;
    }
    
    /*
    ** 引入默认模板
    */
    public static function html($path)
    {
        if (!empty($path) && self::$default) {
            include_once(self::$viewPath.$path.'.tpl');
        }
    }
    
    /*
    ** js文件引入
    ** @param $path 文件路径
    ** @return void
    */
    public static function js($path)
    {
        $path = self::$publicPath.'js'.DIRECTORY_SEPARATOR.$path;      
        echo '<script type="text/javascript" src="'.$path.'"></script>';
    }
    
    /*
    ** css文件引入
    ** @param $path 文件路径
    ** @return void
    */
    public static function css($path)
    {
        $path = self::$publicPath.'css'.DIRECTORY_SEPARATOR.$path;
        echo '<link type="text/css" href="'.$path.'" rel="stylesheet" />';
    }
    
    /*
    ** 图片引入
    ** @param $path 文件路径
    ** @return void
    */
    public static function img($path, $param = [])
    {
        $path = self::$publicPath.'img'.DIRECTORY_SEPARATOR.$path;
        $path2 = self::$publicPath.'img'.DIRECTORY_SEPARATOR;
        $str = '<img src="'.$path.'" ';
        if (isset($param) && is_array($param)) {
            foreach ($param as $_key => $_value) {
                if ($_key == 'data-src') { //懒加载
                    $str .= $_key.'="'.$path2.$_value.'" ';
                } else {
                    $str .= $_key.'="'.$_value.'" ';
                }

            }
        }
        $str .= '>';
        echo $str;
    }

    /**
    ** 图片链接
    ** @param $path 文件路径
    ** @return void
    */
    public static function url($path)
    {
        return self::$publicPath.'img'.DIRECTORY_SEPARATOR.$path;
    }
    
    /*
    ** 传入模板参数
    ** @param $key 键
    ** @param $value 值
    ** @return void
    */
    public static function param($key, $value)
    {
        self::$putout[$key] = $value;
    }
    
    /*
    ** 引入模板
    ** @param $path 文件路径
    ** @return void
    */
    public function showTpl($path)
    {
        self::$default = false;
        include_once(self::$viewPath.$path.'.tpl');
    }
}
