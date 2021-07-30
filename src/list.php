<?php

$list_token = $_ENV["LIST_TOKEN"];

if ($list_token != $_GET["token"]) {
	error_log("invalid token");
	http_response_code(403);
	die("invalid token");
}

require __DIR__ . '/mysqli.php';
$conn = get_viber_mysql_connection();

$result = $conn->query("select * from messages where timestamp > timestampadd(day,-1,now()) order by timestamp");
$rows = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  	$rows[] = $row;
  }
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($rows, JSON_UNESCAPED_UNICODE);
?>