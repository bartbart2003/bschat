<?php
header('Content-type: text/html; charset=utf-8');

require_once 'main.php';

// Check if debug mode
$confManager = new configManager();
$chat_debug = $confManager->getConfigProperty('debug_mode');

// Enable errors displaying and display "DEBUG" if debug mode
if ($chat_debug == 'true')
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	echo '<b>DEBUG MODE</b><br>';
}

# Announcement
$confManager = new configManager();
$annotext = $confManager->getConfigProperty('announcement');
if ($annotext != '')
{
	switch(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2))
	{
		case 'pl':
			echo "<div style='text-align: center;'><span style='font-weight: bold; background-color: red; border-radius: 10px; padding-left: 20px; padding-right: 20px;'>Ogłoszenie: ".htmlentities($annotext)."</span></div>";
			break;
		default:
			echo "<div style='text-align: center;'><span style='font-weight: bold; background-color: red; border-radius: 10px; padding-left: 20px; padding-right: 20px;'>Announcement: ".htmlentities($annotext)."</div>";
			break;
	}
}

# Messages
$msgManager = new messageManager();
$messages = $msgManager->getMessages();
while ($row = $messages->fetch_assoc()) {
    echo "<div style='float: center; padding-top: 5px; padding-bottom: 5px;'>";
    echo "<span style='background-color: lightgray; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; margin-bottom: 15px;'>";
    # Time and name
    echo htmlentities($row['time']);
    echo "</span><span style='background-color: gray; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;'> ";
    echo htmlentities($row['name']);
    echo "</span><span style='display: inline-block; max-width: 80vw; word-wrap: break-word; background-color: lightsteelblue; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;'>";
    # Content
    if ($row['type'] == 'text')
    {
		if ($row['formatting'] == 'normal')
		{
			echo htmlentities($row['content']);
		}
		if ($row['formatting'] == 'italic')
		{
			echo "<span style='font-style: italic;'>".htmlentities($row['content'])."</span>";
		}
		if ($row['formatting'] == 'strike')
		{
			echo "<span style='text-decoration: line-through;'>".htmlentities($row['content'])."</span>";
		}
		if ($row['formatting'] == 'underline')
		{
			echo "<span style='text-decoration: underline;'>".htmlentities($row['content'])."</span>";
		}
		if ($row['formatting'] == 'bold')
		{
			echo "<span style='font-weight: bold;'>".htmlentities($row['content'])."</span>";
		}
	}
    if ($row['type'] == 'img')
    {
		echo "<img src='".htmlentities($row['content'])."' width='100' height='100'></img>";
	}
	if ($row['type'] == 'emoji')
    {
		echo "<img src='../emojis/".htmlentities($row['content'])."' width='75' height='75'></img>";
	}
	# Other things
    echo '<br>';
    echo "</span></div><div style='height: 2px;'></div>";
}
?>
