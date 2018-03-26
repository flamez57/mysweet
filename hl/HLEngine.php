<?php
namespace hl;

class HLEngine 
{
    private $module;
    private $controller;
    private $action;
    private $config;
    
    public function __construct($config)
    {
        $this->config = $config;
        $this->route();
    }
    
    public function route()
    {
        $this->mvc();
    }
    
    public function mvc($module = '', $controller = '', $action = '')
    {
        $this->module = empty($module) ? (isset($this->config['common']['module']) ? $this->config['common']['module'] : 'application') : $module;
        $this->controller = empty($controller) ? (isset($this->config['common']['controller']) ? $this->config['common']['controller'] : 'index') : $controller;
        $this->action = empty($action) ? (isset($this->config['common']['action']) ? $this->config['common']['action'] : 'index') : $action;
    }
    
    /*
     * @Title:
     * @Description:
     * @author:
     * @date 
     * @return
     */
    public function run()
    {
        include(ROOT_PATH.'hl/HLBootstrap.php');
        include_once(ROOT_PATH.'hl/HLController.php');
        
        $bootstrap = $this->bootstrapFactory('application');
        
        $aaa = $this->controllerFactory('application', 'index');
        $aaa->index();
//        $bootstrap -> run();
        
            
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
    
    private function controllerFactory($module, $controller)
    {
        $class = DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . ucfirst($controller) . 'Controller';
        return $class::getInstance();
    }
}
