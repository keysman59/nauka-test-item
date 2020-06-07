<?php
 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

if(!preg_match("|^[\d]*$|",$_GET['id'])) exit();
 
// подключение к базе данных
// (возможно, вам придется настроить имя хоста, имя пользователя и пароль)
$dbh = new mysqli("localhost", "root", "", "nauka");
 
if(mysqli_connect_errno())
{
  exit("Ошибка подключения к базе данных MySQL: Сервер база данных не доступен!<br>
  Проверте параметры подключения к базе данных.");
}

$_POST = json_decode(file_get_contents('php://input'), true);
// var_dump($_POST);

// $_POST['id'] = 1;

$query = "SELECT bin_data,filetype from binary_data WHERE id=".$_POST['id'];
$result = $dbh->query($query);
 
if(!$result) exit("Ошибка выполнения SQL запроса!");
 
$row = $result->fetch_array();
 
Header( "Content-type: ".$row['filetype']."");
// echo $row['bin_data'];

echo base64_encode($row['bin_data']);
// echo $row['filetype'];


// $result = base64_encode($row['bin_data']);
// $type = $row['filetype'];
// echo $result;
// echo $type;

?>



