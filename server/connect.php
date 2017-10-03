<?php
# Change these values according to your database server config
$servername = "servername";
$username = "username";
$password = "password";
$database = "database";
$table = "table";

# Config table, different from the table above
$table_config = "configtable";

# Change this value according to your timezone
date_default_timezone_set("Europe/Warsaw");

# Database connection
$conn = new mysqli($servername, $username, $password);
$conn->select_db($database);
?>
