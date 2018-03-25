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
    public function run()
    {
        include(ROOT_PATH.'hl/HLBootstrap.php');
        include_once(ROOT_PATH.'hl/HLController.php');
        include(ROOT_PATH.$this->module.'/Bootstrap.php');
        $bootstrap = new \application\Bootstrap();
        var_dump(\application\IndexController::getInstance());
        $bootstrap -> run();
//        echo '<pre>';
//        var_dump($_SERVER);
//        echo '</pre>';
        for($i=0;$i<33;$i++){
            echo '<img src="mm/640 ('.$i.').webp" width="200px">';
        }
        for($i=0;$i<225;$i++){
            echo '<img src="mm/jpg/'.$i.'.jpg" width="200px">';
        }
            
    }
}

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