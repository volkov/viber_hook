<?php 

$servername = $_ENV["DATABASE_SERVER"] ?: "127.0.0.1:3306";
$username = $_ENV["DATABASE_USERNAME"] ?: "viber";
$password = $_ENV["DATABASE_PASSWORD"] ?: "viber";
$dbname = $_ENV["DATABASE_NAME"] ?: "viber";
$viber_token = $_ENV["VIBER_TOKEN"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  error_log("connection error");
  error_log($conn->connect_error);
  die("Connection failed: " . $conn->connect_error);
}

$entityBody = file_get_contents('php://input');
if (hash_hmac('sha256', $entityBody, $viber_token) != $_GET["sig"]) {
	error_log("invalid sig");
	die("invalid sig");
}

$data=json_decode($entityBody,true);


$MyEvent=$data['event'];

$stmt = $conn->prepare("INSERT INTO messages (text, sender_name, sender_id) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $message_text, $sender_name, $sender_id);

$message_text=$data['message']['text'];
$sender_id=$data['sender']['id'];
$sender_name=$data['sender']['name'];

$stmt->execute();
$conn->close();
print_r("test message");

error_log(print_r($data, TRUE));

?>