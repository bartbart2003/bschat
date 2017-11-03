<?php
class databaseConnector
{
	# SERVER CONFIG #
	# Database connection
	public $servername = 'servername';
	public $username = 'username';
	public $password = 'password';
	public $database = 'database';
	public $table = 'yourtable';
	# Config table
	public $table_config = 'chatconfig';
	# Admin password
	public $admin_password = 'adminpassword';
	# Timezone
	public $timezone = 'Europe/Warsaw';
	# Time and date format
	public $timeAndDateFormat = 'Y-m-d H:i';
	# END OF CONFIG #
	# Connection variable
	public $conn;
	function connectToDatabase()
	{
		# Set timezone
		date_default_timezone_set($this->timezone);
		
		# Database connection
		$this->conn = new mysqli($this->servername, $this->username, $this->password);
		$this->conn->select_db($this->database);
	}
}
class configManager
{
	public function getConfigProperty($propname)
	{
		$dbConnector = new databaseConnector();
		$dbConnector->connectToDatabase();
		$query = "SELECT * FROM ".$dbConnector->table_config." WHERE confkey='".$propname."'";
		$results = $dbConnector->conn->query($query);
		$propValue = "";
		while ($row = $results->fetch_assoc())
		{
			$propValue = $row["value"];
		}
		return $propValue;
	}
	public function setConfigProperty($propid, $propname, $propvalue)
	{
		$dbConnector = new databaseConnector();
		$dbConnector->connectToDatabase();
		$query = $dbConnector->conn->prepare('REPLACE INTO '.$dbConnector->table_config.' VALUES (?, ?, ?);');
		$query->bind_param('iss', $propid, $propname, $propvalue);
		$results = $query->execute();
	}
}
class messageManager
{
	public function insertMessage($type, $name, $content, $formatting)
	{
		$dbConnector = new databaseConnector();
		$dbConnector->connectToDatabase();
		$query = $dbConnector->conn->prepare('INSERT INTO yourtable (time, type, name, content, formatting) VALUES (?,?,?,?,?)');
		$currentTimeAndDate = date($dbConnector->timeAndDateFormat);
		$query->bind_param('sssss', $currentTimeAndDate, $type, $name, $content, $formatting);
		$results = $query->execute();
	}
	public function getMessages()
	{
		$dbConnector = new databaseConnector();
		$dbConnector->connectToDatabase();
		$query = 'SELECT * from '.$dbConnector->table;
		$results = $dbConnector->conn->query($query);
		return $results;
	}
	public function getMessagesCount()
	{
		$dbConnector = new databaseConnector();
		$dbConnector->connectToDatabase();
		$query = 'SELECT COUNT(*) as rowscount FROM '.$dbConnector->table;
		$results = $dbConnector->conn->query($query);
		$messagesCount = 0;
		while ($row = $results->fetch_assoc()) {
			$messagesCount = $row['rowscount'];
		}
		return $messagesCount;
	}
}
class adminManager
{
	public function clearAll()
	{
		$dbConnector = new databaseConnector();
		$dbConnector->connectToDatabase();
		$query = 'TRUNCATE TABLE '.$dbConnector->table;
		$results = $dbConnector->conn->query($query);
	}
	public function removeMessage($id)
	{
		$dbConnector = new databaseConnector();
		$dbConnector->connectToDatabase();
		$query = $dbConnector->conn->prepare("DELETE FROM ".$dbConnector->table." WHERE messageID=?");
		$query->bind_param('s', $id);
		$results = $query->execute();
	}
	public function changeAnnouncement($announcement)
	{
		$cfgManager = new configManager();
		$cfgManager->setConfigProperty(1, 'announcement', $announcement);
	}
	public function changeTitle($newTitle)
	{
		$cfgManager = new configManager();
		$cfgManager->setConfigProperty(2, 'servertitle', $newTitle);
	}
	public function changeDebug($state)
	{
		$cfgManager = new configManager();
		$cfgManager->setConfigProperty(3, 'debug_mode', $state);
	}
}
?>
