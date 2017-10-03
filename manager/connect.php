<?php
$servername = "servername";
$username = "username";
$password = "password";
$database = "database";
$table = "table";
$table_config = "configtable";
$action_password = "actionpassword";
$conn = new mysqli($servername, $username, $password);
$conn->select_db($database);
?>
