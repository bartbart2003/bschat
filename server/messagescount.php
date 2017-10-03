<?php
require_once "connect.php";

$query = "SELECT COUNT(*) as rowscount FROM ".$table;
$results = $conn->query($query);
while ($row = $results->fetch_assoc()) {
	echo $row['rowscount'];
}
?>
