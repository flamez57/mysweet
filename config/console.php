<?php
$common = require(__DIR__ . '/common.php');
$db = require(__DIR__ . '/db.php');

$config = [
	'db' => $db,
	'common' => $common
];

return $config;