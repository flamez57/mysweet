<?php
define("ROOT_PATH", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("ENGINE_PATH", ROOT_PATH.'hl/');
include(ENGINE_PATH.'HLEngine.php');
$config = require(ROOT_PATH.'config/console.php');
$e = new hl\HLEngine($config);
$e->run();
