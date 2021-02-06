<?php
//解决跨域问题
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With, X_Requested_With');
//开启报错显示
ini_set("display_errors", "On");
error_reporting(E_ALL);

define("ROOT_PATH", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("HTTP_HOST", $_SERVER['HTTP_HOST'].'/');
define("ENGINE_PATH", ROOT_PATH.'hl/');
//引入常量
include(ENGINE_PATH.'HLConst.php');
//引入引擎
include(ENGINE_PATH.'HLEngine.php');
$config = require(ROOT_PATH.'config/console.php');
$e = new hl\HLEngine($config);
$e->run();
// test
