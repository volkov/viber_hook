<?php

function get_viber_mysql_connection() {
	$servername = $_ENV["DATABASE_SERVER"] ?: "127.0.0.1:3306";
	$username = $_ENV["DATABASE_USERNAME"] ?: "viber";
	$password = $_ENV["DATABASE_PASSWORD"] ?: "viber";
	$dbname = $_ENV["DATABASE_NAME"] ?: "viber";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
  		error_log("connection error");
  		error_log($conn->connect_error);
  		http_response_code(500);
  		die("Connection failed: " . $conn->connect_error);
	}

    return $conn;
}
?>