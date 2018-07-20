<?php
header('Content-type: text/html; charset=utf-8');

require_once 'main.php';

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
		echo "<img src='".htmlentities($row['content'])."' height='100px'></img>";
	}
	if ($row['type'] == 'emoji')
    {
		echo "<img src='../emojis/".htmlentities($row['content'])."' width='75' height='75'></img>";
	}
    echo '<br>';
    echo "</span></div><div style='height: 2px;'></div>";
}
?>
