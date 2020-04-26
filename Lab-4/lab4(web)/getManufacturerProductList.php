<?php
require_once "./db.php";

function getManufacturerProductList($pdo, $manufacturerID) {
  $sql = $pdo->query("SELECT * FROM product JOIN manufacturer ON product.manufacturer_id = manufacturer.id WHERE product.manufacturer_id = $manufacturerID");
  $result = array();
  while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    array_push($result, $data);
  }
  return $result;
}?>