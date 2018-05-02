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

class HLView extends HLSington
{
    /*
    ** 模块
    */
    private $module;
    
    /*
    ** 视图目录
    */
    private $viewPath;
    
    /*
    ** 公共文件目录
    */
    private $publicPath;
    
    /*
    ** 是否默认模板
    */
    private $default;
    
    /*
    ** 输出参数
    */
    public $putout;

    /*
    ** 初始化
    ** @param $module string
    ** @param $viewPath string
    ** @return void
    */
    public function init($module, $viewPath)
    {
        $this->default = true;
        $this->module = $module;
        $this->viewPath = $viewPath;
        $this->publicPath = 'http://'.HTTP_HOST.'public'.DIRECTORY_SEPARATOR.$this->module.DIRECTORY_SEPARATOR;
    }
    
    /*
    ** 引入默认模板
    */
    public function html($path)
    {
        if (!empty($path) && $this->default) {
            include_once($this->viewPath.$path.'.tpl');
        }
    }
    
    /*
    ** js文件引入
    ** @param $path 文件路径
    ** @return void
    */
    public function js($path)
    {
        $path = $this->publicPath.'js'.DIRECTORY_SEPARATOR.$path;      
        echo '<script type="text/javascript" src="'.$path.'"></script>';
    }
    
    /*
    ** css文件引入
    ** @param $path 文件路径
    ** @return void
    */
    public function css($path)
    {
        $path = $this->publicPath.'css'.DIRECTORY_SEPARATOR.$path;
        echo '<link type="text/css" href="'.$path.'" rel="stylesheet" />';
    }
    
    /*
    ** 图片引入
    ** @param $path 文件路径
    ** @return void
    */
    public function img($path, $param)
    {
        $path = $this->publicPath.'img'.DIRECTORY_SEPARATOR.$path;
        $str = '<img src="'.$path.'" ';
        if (isset($param) && is_array($param)) {
            foreach ($param as $_key => $_value) {
                $str .= $_key.'="'.$_value.'" ';
            }
        }
        $str .= '>';
        echo $str;
    }
    
    /*
    ** 传入模板参数
    ** @param $key 键
    ** @param $value 值
    ** @return void
    */
    public function param($key, $value)
    {
        $this->putout[$key] = $value;
    }
    
    /*
    ** 引入模板
    ** @param $path 文件路径
    ** @return void
    */
    public function showTpl($path)
    {
        $this->default = false;
        include_once($this->viewPath.$path.'.tpl');
    }
}