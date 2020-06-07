<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

$conn = new mysqli('localhost','root','','nauka');
if($conn->connect_error) {
	die("Connection Failed!".$conn->connect_error);
}

$sql = $conn->query("SELECT * FROM tbl_sample");
$users = array();
while($row = $sql->fetch_assoc()) {
  array_push($users, $row);
}
$result['users'] = $users;

$conn->close();

echo json_encode($result);


?>