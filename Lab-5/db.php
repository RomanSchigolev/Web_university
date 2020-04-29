<?php
$driver = "mysql";
$host = "localhost";
$port = "3309";
$db_name = "lab4";
$db_user = "root";
$db_pass = "root";
$charset = "utf8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try{
  $pdo = new PDO("$driver:host=$host;port=$port;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options);
} catch (PDOException $error){
  die("Подключение не удалось: " . $error->getMessage());
}
?>