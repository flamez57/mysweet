<?php
/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/6/21 20:12
 * Author: Flamez57 <1050355217@qq.com>
 */
function __autoload($hlClassname) {
    if (class_exists($hlClassname) && interface_exists($hlClassname)) {
        return $hlClassname;
    }
    __loadClass($hlClassname);
    if (!class_exists($hlClassname) && !interface_exists($hlClassname)) {
        trigger_error($hlClassname . ' not found.');
    }
}

function __loadClass($hlClassname) {
    $iLocation = strpos($hlClassname, 'Model');
//    var_dump($hlClassname,$iLocation);echo '<hr>';
    if (is_numeric($iLocation)) {
//        $hlClassname = strtr($hlClassname, '_', '/');
        $hlFilePath = ROOT_PATH . '/model/' . $hlClassname . '.php';
    } else {
        $hlFilePath = ROOT_PATH . '/sweet/' . $hlClassname . '.php';
    }
    if (file_exists($hlFilePath)) {
        require($hlFilePath);
        return true;
    } else {
        return false;
    }
}

class sweet{

    private $module;
    private $controller;
    private $action;

    public function __construct()
    {
        $this->route();
    }

    private function route()
    {
        if(!defined('MODULE') || MODULE == '') defined("MODULE","home");
        if(!defined('CONTROLLER') || CONTROLLER == '') defined("CONTROLLER","Index");
        if(!defined('ACTION') || ACTION == '') defined("ACTION","Index");
        $this->module = empty($_GET['m'])?MODULE:$_GET['m'];
        $this->controller = empty($_GET['c'])?CONTROLLER:ucfirst($_GET['c']);
        $this->action = empty($_GET['a'])?ACTION:ucfirst($_GET['a']);
    }

    public function run()
    {
        include ROOT_PATH.'/app/'.$this->module.'/'.$this->controller.'Controller.php';
        $controller = $this->controller.'Controller';
        $controller = new $controller();
        $a = $this->action;
        $controller -> $a();
    }

}


