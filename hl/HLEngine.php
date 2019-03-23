<?php
namespace hl;
use application\Bootstrap;

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
        include_once('HLRoute.php');
        HLRoute::init($config['common']);      
        $mca = HLRoute::getMCA();
        $this->module = $mca['module'];
        $this->controller = $mca['controller'];
        $this->action = $mca['action'];
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
        HLBootstrap::init();
        $bootstrap = $this->bootstrapFactory($this->module);
        
        $controller = $this->controllerFactory($this->module, $this->controller);
        $controller->{$this->action}();   
    }
    
    /*
    ** 启动器工厂
    */
    private function bootstrapFactory($module)
    {
        HLBootstrap::init();
        $path = ROOT_PATH.$this->module.'/Bootstrap.php';
        include_once("{$path}");
        $class = DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'Bootstrap';
        $class = '\\'.$module.'\\Bootstrap';
        return new $class();
    }
    
    /*
    ** 控制器工厂
    */
    private function controllerFactory($module, $controller)
    {
        $class = DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'controllers'. DIRECTORY_SEPARATOR . ucfirst($controller) . 'Controller';
        $class = '\\' . $module . '\\' . 'controllers'. '\\' . ucfirst($controller) . 'Controller';
        return $class::getInstance($this->config);
    }
}
