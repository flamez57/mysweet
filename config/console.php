<?php
$common = require(__DIR__ . '/common.php');
$db = require(__DIR__ . '/db.php');
$adminMenu = require(__DIR__ . '/adminMenu.php');

$config = [
	'db' => $db,
	'common' => $common,
    'admin_menu' => $adminMenu,
];

return $config;
