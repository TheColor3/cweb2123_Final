<?php
//connect to database
$host = "localhost";
$db_name = "mydb";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

// to handle connection error
catch(PDOException $exception){
	echo "Connection error: " . $exception->getMessage();
}
?>