<?php
 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');


// Код, который будет выполняться, если форма была оправлена:
    // подключение к базе данных
    // (возможно, вам придется настроить имя хоста, имя пользователя и пароль)

var_dump($_GET);
var_dump($_POST);
var_dump($_FILES);


$dbh = new mysqli("localhost", "root", "", "nauka");

if(mysqli_connect_errno())
{
    exit("Ошибка подключения к базе данных MySQL: Сервер база данных не доступен!<br>
    Проверте параметры подключения к базе данных.");
}
var_dump($_FILES);
$data = addslashes(fread(fopen($_FILES['file']['tmp_name'], "r"), 
filesize($_FILES['file']['tmp_name'])));

$_POST['form_description'] = trim($_POST['form_description']);
$size = filesize ($_FILES['file']['tmp_name']);

$result=$dbh->prepare("INSERT INTO binary_data (description,bin_data,filename,filesize,filetype) 
"."VALUES ('".$_POST['form_description']."',
'".$data."',
'".$_FILES["file"]["name"]."',
'".$size."',
'".$_FILES["file"]["type"]."')");

if(!$result) exit("Ошибка выполнения SQL запроса!");

$result->execute(); 
$id = $dbh->prepare();

echo "<p>Этот файл имеет следующий идентификатор (ID) в базе данных: <b>".$id."</b>";
 
?>
