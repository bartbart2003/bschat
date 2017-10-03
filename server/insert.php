<?php
if ($_GET[redir] == "true")
	header('Location: ../client/index.php');
if ($_GET[returnname] == "true" and $_GET[redir] == "true")
	header('Location: ../client/index.php?name='.$_GET['name']);

echo "BSChat";
require_once "connect.php";

# Get required data
$type = "text";
if ($_GET["type"] == "img")
	$type = "img";
if ($_GET["type"] == "emoticon")
	$type = "emoticon";

$formatting = "normal";
if ($_GET["formatting"] == "italic")
	$formatting = "italic";
if ($_GET["formatting"] == "strike")
	$formatting = "strike";

$name = $_GET["name"];
$content = $_GET["content"];

# Insert into database
$query = $conn->prepare("INSERT INTO chattable (time, type, name, content, formatting) VALUES (?,?,?,?,?)");
$query->bind_param('sssss', date('Y-m-d H:i'), $type, $name, $content, $formatting);
$results = $query->execute();

# Display return link
echo "<br><a href=../client/index.php>Return</a>";
?>
