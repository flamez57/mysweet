<?php
$common = require(__DIR__ . '/common.php');
$db = require(__DIR__ . '/db.php');
$adminMenu = require(__DIR__ . '/adminMenu.php');
$token = require(__DIR__ . '/token.php');

$config = [
	'db' => $db,
	'common' => $common,
    'admin_menu' => $adminMenu,
    'token' => $token,
];

return $config;
