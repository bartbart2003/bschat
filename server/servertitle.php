<?php
header('Content-type: text/html; charset=utf-8');
require_once 'main.php';

// Check if debug mode
$confManager = new configManager();
$chat_debug = $confManager->getConfigProperty('debug_mode');

// Enable errors displaying if debug mode
if ($chat_debug == 'true')
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

$confManager = new configManager();
$servertitle = $confManager->getConfigProperty('servertitle');
echo htmlentities($servertitle);
?>
