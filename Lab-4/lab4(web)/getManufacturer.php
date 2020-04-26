<?php
require_once "./db.php";

function getManufacturer($pdo){
  $sql = $pdo->query("SELECT * FROM manufacturer");
  $result = array();
  while ($data = $sql->fetch(PDO::FETCH_ASSOC)){
    array_push($result, $data);
  }
  return $result;
}
?>