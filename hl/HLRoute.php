<?php
namespace hl;
/**
** @ClassName: HLRoute
** @Description:路由
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年4月2日 晚上21:49
** @version V1.0
*/
class HLRoute
{
    /*
	** 普通模式
	*/
	const COMMON_MODE = 0;

	/*
	** 美化模式
	*/ 
	const BEAUTIFY_MODE = 1;

	/*
	** 路由模式
	*/
    static private $urlMode;

    /*
    ** 模块
    */
    static private $module;

    /*
    ** 控制器
    */
    static private $controller;

    /*
    ** 方法
    */
    static private $action;

    static private $var_module = 'm';
    static private $var_controller = 'c';
    static private $var_action = 'a';

    /*
    ** 初始化方法
    ** @param $config
    */
    static public function init($config) 
    {
        self::$urlMode = $config['url_mode'];
        self::$module = $config['module'];
        self::$controller = $config['controller'];
        self::$action = $config['action'];
    }

    /*
    ** 生成链接
    ** @param $module string 模块
    ** @param $controller string 控制器
    ** @param $action string 方法
    ** @return string
    */
    static public function makeUrl($module, $controller, $action, $param = [])
    {
    	switch (self::$urlMode) {
    		case self::COMMON_MODE:
    			$url = "/index.php?m={$module}&c={$controller}&a={$action}";
    			if (!empty($param)) {
    			    foreach ($param as $_k => $_v) {
    			        $url .= "&{$_k}={$_v}";
                    }
                }
    		break;
    		case self::BEAUTIFY_MODE:
    		    if (!empty($param)) {
    			    foreach ($param as $_k => $_v) {
    			        $action .= "_{$_k}_{$_v}";
                    }
                }
    			$url = "/{$module}_{$controller}_{$action}.html";
    		break;
    	}
    	return $url;
    }

    /*
    ** 获取跳转路由
    */
    static public function getMCA()
    {
    	$data = [
    		'module' => self::$module,
    		'controller' => self::$controller,
    		'action' => self::$action
    	];
    	switch (self::$urlMode) {
    		case self::COMMON_MODE:
    			$params = empty($_SERVER['QUERY_STRING']) ? [] : explode('&', $_SERVER['QUERY_STRING']);
    			if ($params) {
    				foreach ($params as $_paramV) {
		                $tmp = explode('=', $_paramV);
		                switch ($tmp[0]) {
                            case self::$var_module:
		                		$data['module'] = $tmp[1];
		                	break;
                            case self::$var_controller:
		                		$data['controller'] = $tmp[1];
		                	break;
                            case self::$var_action:
		                		$data['action'] = $tmp[1];
		                	break;
		                }
		            }
    			}
    		break;
    		case self::BEAUTIFY_MODE:
                if ($_SERVER['REQUEST_URI'] != '/') {
                    $params = explode('_', rtrim(ltrim($_SERVER['REQUEST_URI'], '/'), '.html'));
                    if ($params) {
                        krsort($params);
                        $data['module'] = array_pop($params);
                        $data['controller'] = array_pop($params);
                        $data['action'] = array_pop($params);
                    }
                }
    		break;
    	}
    	return $data;
    }

    /*
    ** 获取参数
    ** @param $key string 
    ** @param $value string
    ** @return string|array
    */
    static public function getParam($key = '', $value = '')
    {
    	$data = [];
    	switch (self::$urlMode) {
    		case self::COMMON_MODE:
    			$data = self::getParamByDynamic();
    		break;
    		case self::BEAUTIFY_MODE:
    			$data = self::getParamByPathinfo();
    		break;
    	}
    	if (empty($key)) {
    		return $data;
    	} else {
    		return isset($data[$key]) ? $data[$key] : $value;
    	}
    }
 
    /**
     * 获取参数通过url传参模式
     */
    static private function getParamByDynamic()
    {
        $arr = empty($_SERVER['QUERY_STRING']) ? array() : explode('&', $_SERVER['QUERY_STRING']);
        $data = array(
            'module' => '',
            'controller' => '',
            'action' => '',
            'param' => array()
        );
        if (!empty($arr)) {
            $tmp = array();
            $part = array();
            foreach ($arr as $v) {
                $tmp = explode('=', $v);
                $tmp[1] = isset($tmp[1]) ? trim($tmp[1]) : '';
                $part[$tmp[0]] = $tmp[1];
            }
            if (isset($part[self::$var_module])) {
                $data['module'] = $part[self::$var_module];
                unset($part[self::$var_module]);
            }
            if (isset($part[self::$var_controller])) {
                $data['controller'] = $part[self::$var_controller];
                unset($part[self::$var_controller]);
            }
            if (isset($part[self::$var_action])) {
                $data['action'] = $part[self::$var_action];
                unset($part[self::$var_action]);
            }
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    unset($_GET[self::$var_controller], $_GET[self::$var_action], $_GET[self::$var_module]);
                    $data['param'] = array_merge($part, $_GET);
                    unset($_GET);
                    break;
                case 'POST':
                    unset($_POST[self::$var_controller], $_POST[self::$var_action], $_GET[self::$var_module]);
                    $data['param'] = array_merge($part, $_POST);
                    unset($_POST);
                    break;
                case 'HEAD':
                    break;
                case 'PUT':
                    break;
            }
        }
        return $data['param'];
    }
 
    /**
     * 获取参数通过pathinfo模式
     */
    static private function getParamByPathinfo()
    {
        $part = explode(
            '_',
            trim(substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '.html')), '/')
        );
        $data = [];
        if (!empty($part)) {
            $data['module'] = array_shift($part);
            $data['controller'] = array_shift($part);
            $data['action'] = array_shift($part);
            $part = array_values($part);
            $tmp = array();
            if (count($part) > 0) {
                foreach ($part as $k => $v) {
                    if ($k % 2 == 0) {
                        $tmp[$v] = isset($part[$k + 1]) ? $part[$k + 1] : '';
                    }
                }
            }
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $data = $tmp;
                    unset($_GET);
                    break;
                case 'POST':
                    $data = array_merge($tmp, $_POST);
                    unset($_POST);
                    break;
                case 'HEAD':
                    break;
                case 'PUT':
                    break;
            }
        }
        return $data;
    }
}
