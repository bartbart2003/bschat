<?php
require_once 'main.php';
$dbConnector = new databaseConnector();
$dbConnector->connectToDatabase();
$admManager = new adminManager();
if (isset($_POST['password']))
{
	if ($_POST['password'] == $dbConnector->admin_password)
	{
		if  ($_POST['action'] == 'clearall')
		{
			$admManager->clearAll();
		}
		if  ($_POST['action'] == 'remove')
		{
			$admManager->removeMessage($_POST['value']);
		}
		if ($_POST['action'] == 'changeanno')
		{
			$admManager->changeAnnouncement($_POST['value']);
		}
		if ($_POST['action'] == 'changetitle')
		{
			$admManager->changeTitle($_POST['value']);
		}
		if ($_POST['action'] == 'changedebug')
		{
			$admManager->changeDebug($_POST['value']);
		}
		header('Location: ../client/index.php');
	}
	else
	{
			echo 'ERROR: Wrong password';
	}
}
else
{
	echo 'ERROR: Cannot get password';
}
?>
