<?php

class sweet{

    public function __autoload($hlClassname) {
        if (class_exists($hlClassname) && interface_exists($hlClassname)) {
            return $hlClassname;
        }
        $this -> __loadClass($hlClassname);
        if (!class_exists($hlClassname) && !interface_exists($hlClassname)) {
            trigger_error($hlClassname . ' not found.');
        }
    }

    public function __loadClass($hlClassname) {
        $iLocation = strpos($hlClassname, '_');
        if ($iLocation) {
            $hlClassname = strtr($hlClassname, '_', '/');
            $hlFilePath = ROOT_PATH . '/model/' . $hlClassname . '.class.php'; //这里自定义类
        } else {
            $hlFilePath = ROOT_PATH . '/sweet/' . $hlClassname . 's/'.$hlClassname.'.php';
        }
        if (file_exists($hlFilePath)) {
            require($hlFilePath);
            return true;
        } else {
            return false;
        }
    }

    public function run()
    {
        $m = isset($_GET['m'])?$_GET['m']:'admin';
        $a = isset($_GET['a'])?$_GET['a']:'Index';
        $c = isset($_GET['c'])?$_GET['c']:'index';

        include ROOT_PATH.'/app/'.$m.'/'.$a.'Controller.php';
        $a = $a.'Controller';
        $controller = new $a();
        $controller -> $c();
    }

}


