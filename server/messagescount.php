<?php
require_once 'main.php';

$msgManager = new messageManager();
echo $msgManager->getMessagesCount();
?>
