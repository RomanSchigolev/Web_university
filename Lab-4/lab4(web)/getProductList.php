<?php
require_once "./db.php";

function getProductList($pdo, $order, $sort) {
  $sql = $pdo->query("SELECT * FROM product, manufacturer WHERE product.manufacturer_id = manufacturer.id ORDER BY $order $sort");
  $result = array();
  while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    array_push($result, $data);
  }
  return $result;
}
?>