<?php
namespace hl;
/**
** @ClassName: HLEngine
** @Description: 引擎
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月27日 晚上21:49
** @version V1.0
*/
class HLEngine 
{
    /*
    ** 系统默认模块
    */
    private $module = 'application';
    
    /*
    ** 系统默认控制器
    */
    private $controller = 'index';
    
    /*
    ** 系统默认方法
    */
    private $action = 'index';
    
    /*
    ** 配置参数
    */
    private $config;
    
    /*
    ** 初始化模块-》控制-》方法
    */
    public function __construct($config)
    {
        $this->config = $config;
        if (isset($config['common']['module'])) $this->module = $config['common']['module'];
        if (isset($config['common']['controller'])) $this->controller = $config['common']['controller'];
        if (isset($config['common']['action'])) $this->action = $config['common']['action'];
        $this->route();
    }
    
    /*
    ** 路由
    */
    public function route()
    {
        $m = isset($_GET['m']) ? $_GET['m'] : '';
        $c = isset($_GET['c']) ? $_GET['c'] : '';
        $a = isset($_GET['a']) ? $_GET['a'] : '';
        $this->mvc($m, $c, $a);
    }
    
    /*
    ** 访问控制
    */
    public function mvc($module, $controller, $action)
    {
        if (!empty($module)) $this->module = $module;
        if (!empty($controller)) $this->controller = $controller;
        if (!empty($action)) $this->action = $action;
    }
    
    /*
    ** @Title: 运行起始处
    ** @Description:
    ** @author: flamez57
    ** @date 2018年3月28日 晚上23:07
    ** @return
    */
    public function run()
    {
        include_once(ROOT_PATH.'hl/HLBootstrap.php');
        
        $bootstrap = $this->bootstrapFactory($this->module);
        
        $controller = $this->controllerFactory($this->module, $this->controller);
        $controller->{$this->action}();   
    }
    
    /*
    ** 启动器工厂
    */
    private function bootstrapFactory($module)
    {
        include(ROOT_PATH.$this->module.'/Bootstrap.php');
        $class = DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'Bootstrap';
        return new $class;
    }
    
    /*
    ** 控制器工厂
    */
    private function controllerFactory($module, $controller)
    {
        $class = DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'controllers'. DIRECTORY_SEPARATOR . ucfirst($controller) . 'Controller';
        return $class::getInstance($this->config);
    }
}
