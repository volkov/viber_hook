<?php 

$viber_token = $_ENV["VIBER_TOKEN"];

$entityBody = file_get_contents('php://input');
if (hash_hmac('sha256', $entityBody, $viber_token) != $_GET["sig"]) {
	error_log("invalid sig");
	http_response_code(403);
	die("invalid sig");
}
$data=json_decode($entityBody, TRUE);
error_log(print_r($data, TRUE));

$event_type=$data['event'];
if ($event_type != 'message') {
	error_log("got $event_type which is not message");
	print_r("not messages ignored");
	exit(0);
}

require __DIR__ . '/mysqli.php';
$conn = get_viber_mysql_connection();

$stmt = $conn->prepare("INSERT INTO messages (text, sender_name, sender_id) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $message_text, $sender_name, $sender_id);

$message_text=$data['message']['text'];
$sender_id=$data['sender']['id'];
$sender_name=$data['sender']['name'];

$stmt->execute();
$conn->close();
error_log("message saved");
print_r("message saved");

?>