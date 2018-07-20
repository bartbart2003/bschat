<?php
class databaseConnector
{
	# SERVER CONFIG #
	# Database connection
	public $servername = '';
	public $username = '';
	public $password = '';
	public $database = '';
	public $table = '';
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
?>
