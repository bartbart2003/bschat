<?php
require_once 'main.php';

// Check if debug mode
$confManager = new configManager();
$chat_debug = $confManager->getConfigProperty('debug_mode');

// Enable errors displaying and display return link if debug mode
if ($chat_debug == 'true')
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	echo "<a href='../client'>Return</a>";
}

if ($_GET['redir'] == 'true' and $chat_debug != 'true' and $_GET['returnname'] != 'true')
	header('Location: ../client');
if ($_GET['returnname'] == 'true' and $_GET['redir'] == 'true' and $chat_debug != 'true')
	header('Location: ../client/?name='.$_GET['name']);

# Get type
$type = 'text';
if ($_GET['type'] == 'img')
	$type = 'img';
if ($_GET['type'] == 'emoji')
	$type = 'emoji';

# Get formatting
$formatting = 'normal';
if ($_GET['formatting'] == 'italic')
	$formatting = 'italic';
if ($_GET['formatting'] == 'strike')
	$formatting = 'strike';
if ($_GET['formatting'] == 'underline')
	$formatting = 'underline';
	
# Get name and content
$name = $_GET['name'];
$content = $_GET['content'];

# Insert message
$msgManager = new messageManager();
$msgManager->insertMessage($type, $name, $content, $formatting);
?>
