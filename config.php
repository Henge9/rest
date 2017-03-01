<?php 
//Never put binero login info in local config.php. 
$db_username = "root";
$db_password = "";
$db_host = "localhost";
$db_database = "219310-abg"

$db = mysqli_connect($db_host, $db_username, $db_password, $db_database);
 ?>