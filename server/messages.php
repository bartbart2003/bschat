<?php
header('Content-type: text/html; charset=utf-8');
require_once "connect.php";

# Announcement
$query="SELECT * FROM ".$table_config." WHERE confkey='announcement'";
$results = $conn->query($query);
$annotext = "";
while ($row = $results->fetch_assoc())
{
	$annotext = $row["value"];
}
if ($annotext != "")
{
	
	switch(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2))
	{
		case "pl":
			echo "<div style='text-align: center; background-color: red; font-weight: bold;'>Ogłoszenie: ".htmlentities($annotext)."</div>";
			break;
		default:
			echo "<div style='text-align: center; background-color: red; font-weight: bold;'>Announcement: ".htmlentities($annotext)."</div>";
			break;
	}
}

# Messages
$query="SELECT * from ".$table;
$results = $conn->query($query);
while ($row = $results->fetch_assoc()) {
    echo "<div style='float: center; padding-top: 5px; padding-bottom: 5px;'>";
    echo "<span style='background-color: lightgray; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; margin-bottom: 15px;'>";
    # Time and name
    echo htmlentities($row['time']);
    echo "</span><span style='background-color: gray; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;'> ";
    echo htmlentities($row['name']);
    echo "</span><span style='display: inline-block; max-width: 80vw; word-wrap: break-word; background-color: lightsteelblue; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;'>";
    # Content
    if ($row['type'] == "textadmin")
    {
		echo "<b>".htmlentities($row['content'])."</b>";
	}
    if ($row['type'] == "text")
    {
		if ($row['formatting'] == "normal")
		{
			echo htmlentities($row['content']);
		}
		if ($row['formatting'] == "italic")
		{
			echo "<span style='font-style: italic;'>".htmlentities($row['content'])."</span>";
		}
		if ($row['formatting'] == "strike")
		{
			echo "<span style='text-decoration: line-through;'>".htmlentities($row['content'])."</span>";
		}
	}
    if ($row['type'] == "img")
    {
		echo "<img src='".htmlentities($row['content'])."' width='100' height='100'></img>";
	}
	if ($row['type'] == "emoticon")
    {
		echo "<img src='../emoticons/".htmlentities($row['content'])."' width='75' height='75'></img>";
	}
	# Other things
    echo "<br>";
    echo "</span></div><div style='height: 2px;'></div>";
}
?>
