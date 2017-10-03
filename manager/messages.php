<?php
header('Content-type: text/html; charset=utf-8');
require_once "connect.php";
date_default_timezone_set("UTC");
$query="SELECT * FROM ".$table_config." WHERE confkey='announcement'";
$results = $conn->query($query);
$annotext = "";
while ($row = $results->fetch_assoc()) {
	$annotext = $row["value"];
}
if ($annotext != "")
{
	echo "<div style='text-align: center; background-color: red;'>Announcement: ".htmlentities($annotext)."</div>";
}
$query="SELECT * from ".$table;
$results = $conn->query($query);
while ($row = $results->fetch_assoc()) {
    echo "<div style='float: center;padding-top: 5px; padding-bottom: 5px;'>";
    echo "<span style='background-color: lightsteelblue; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; margin-bottom: 15px;'>";
    echo htmlentities($row['messageID']);
    echo "</span><span style='background-color: lightgray; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; margin-bottom: 15px;'>";
    echo htmlentities($row['time']);
    echo "</span><span style='background-color: gray; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; '> ";
    echo htmlentities($row['name']);
    echo "</span><span style='display: inline-block; max-width: 80vw; word-wrap: break-word; background-color: gainsboro; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;'>";
    if ($row['type'] == "textadmin")
        echo "<b>".htmlentities($row['content'])."</b>";
    if ($row['type'] == "text")
        echo htmlentities($row['content']);
    if ($row['type'] == "img")
        echo "<img src=\"".htmlentities($row['content'])."\" width=\"100\" height=\"100\"></img>";
    if ($row['type'] == "emoticon")
    {
		echo "<img src='../emoticons/".htmlentities($row['content'])."' width='100' height='100'></img>";
	}
    echo "</span><span style='background-color: red; border-radius: 8px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;'><a href='action.php?action=remove&id=".$row['messageID']."'>REMOVE</a></span></div><div style='height: 2px;'></div>";
}
?>
