<?php
require_once "./db.php";

function getManufacturerProductList($pdo, $manufacturerID, $columnName, $order) {
  $sql = $pdo->query("SELECT * FROM product JOIN  manufacturer ON product.manufacturer_id = manufacturer.id WHERE product.manufacturer_id = $manufacturerID ORDER BY $columnName $order");
  $result = array();
  while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    array_push($result, $data);
  }
  return $result;
}?>