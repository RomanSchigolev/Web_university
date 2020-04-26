<?php
require_once "./db.php";

function getProductItem($pdo, $productID) {
  $sql = $pdo->query("SELECT * FROM product LEFT JOIN manufacturer ON product.manufacturer_id = manufacturer.id WHERE product.product_id = $productID");
  $result = array();
  while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    array_push($result, $data);
  }
  return $result;
}?>
