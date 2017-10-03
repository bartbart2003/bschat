<?php
session_start();
require_once "connect.php";
if (isset($_SESSION["password"]))
{
	if ($_SESSION["password"] == $action_password)
	{
		if ($_GET[redir] == "true")
			header('Location: index.html');
		if ($_GET[returnname] == "true" and $_GET[redir] == "true")
			header('Location: index.html?name='.$_GET['name']);
		echo "BSChat";
		date_default_timezone_set("Europe/Warsaw");
		$type = "text";
		if ($_GET["type"] == "text")
			$type = "text";
		if ($_GET["type"] == "img")
			$type = "img";
		if ($_GET["type"] == "emoticon")
			$type = "emoticon";
		if ($_GET["type"] == "textadmin")
			$type = "textadmin";
		$name = $_GET["name"];
		$content = $_GET["content"];
		$formatting = "normal";
		$query = $conn->prepare("INSERT INTO chattable (time, type, name, content, formatting) VALUES (?,?,?,?,?)");
		$query->bind_param('sssss', date('Y-m-d H:i'), $type, $name, $content, $formatting);
		$results = $query->execute();
		echo "<br>";
		echo "<a href=index.html>Return</a>";
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
