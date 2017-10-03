<?php
session_start();
require_once "connect.php";
if (isset($_SESSION["password"]))
{
	if ($_SESSION["password"] == $action_password)
	{
		if  ($_GET["action"] == "clearall")
		{
			$query = "TRUNCATE TABLE ".$table;
			$results = $conn->query($query);
		}
		if  ($_GET["action"] == "remove")
		{
			$query = $conn->prepare("DELETE FROM ".$table." WHERE messageID=?");
			$query->bind_param('s', $_GET["id"]);
			$results = $query->execute();
		}
		if ($_GET["action"] == "changeanno")
		{
			$query = $conn->prepare("REPLACE INTO ".$table_config." VALUES (1, 'announcement', ?);");
			$query->bind_param('s', $_GET["anno"]);
			$results = $query->execute();
		}
		header('Location: index.html');
	}
	else
	{
			echo "ERROR: Wrong password";
	}
}
else
{
	echo "ERROR: Session not started";
}
?>
