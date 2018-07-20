<?php
require_once 'main.php';

# Redirect back to client and/or return username
if ($_GET['redir'] == 'true' and $_GET['returnname'] != 'true')
	header('Location: ../client');
if ($_GET['returnname'] == 'true' and $_GET['redir'] == 'true')
	header('Location: ../client/?name='.$_GET['name']);

# Get type
$type = 'text';
switch ($_GET['type'])
{
	case 'img':
		$type = 'img';
		break;
	case 'emoji':
		$type = 'emoji';
		break;
}

# Get formatting
$formatting = 'normal';
switch ($_GET['formatting'])
{
	case 'italic':
		$formatting = 'italic';
		break;
	case 'strike':
		$formatting = 'strike';
		break;
	case 'underline':
		$formatting = 'underline';
		break;
}
	
# Get username and content
$name = $_GET['name'];
$content = $_GET['content'];

# Insert message
$msgManager = new messageManager();
$msgManager->insertMessage($type, $name, $content, $formatting);
?>
