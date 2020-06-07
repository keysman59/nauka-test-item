<?php
 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

 
$conn = new mysqli("localhost", "root", "", "mass-test");

$query = "SELECT bin_data from binary_data";

$result = $conn->query($query);
 
$users = array();
while($row = $result->fetch_assoc()) {
  array_push($users, $row);
}

// $result['users'] = $users;
 
echo $users;


// Header( "Content-type: ".$row['filetype']."");
// echo base64_encode($row['bin_data']);
// echo base64_encode($result['bin_data']);




?>



