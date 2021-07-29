<?php
$servername = $_ENV["DATABASE_SERVER"] ?: "127.0.0.1:3306";
$username = $_ENV["DATABASE_USERNAME"] ?: "viber";
$password = $_ENV["DATABASE_PASSWORD"] ?: "viber";
$dbname = $_ENV["DATABASE_NAME"] ?: "viber";

$list_token = $_ENV["LIST_TOKEN"];

if ($list_token != $_GET["token"]) {
	error_log("invalid sig");
	die("invalid sig");
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  error_log("connection error");
  error_log($conn->connect_error);
  die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

$result = $conn->query("select * from messages where timestamp > timestampadd(day,-1,now()) order by timestamp");
$rows = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  	$rows[] = $row;
  }
}
$conn->close();
echo json_encode($rows);
?>