<?php
require_once "./db.php";

// Получаем POST-параметры и устанавливаем cookies
if (isset($_POST["columnName"])) {
  $columnName = $_POST["columnName"];
  setcookie("columnName", $columnName, time()+100);
} else {
  $columnName = isset($_COOKIE["columnName"]) ? $_COOKIE["columnName"] : "product_title";
}

if (isset($_POST["order"])) {
  $order = $_POST["order"];
  setcookie("order", $order, time()+100);
} else {
  $order = isset($_COOKIE["order"]) ? $_COOKIE["order"] : "ASC";
}

$sql = $pdo->query("SELECT * FROM product, manufacturer WHERE product.manufacturer_id = manufacturer.id ORDER BY $columnName $order");
$order == "DESC" ? $order = "ASC" : $order = "DESC";
?>
<table>
  <thead>
    <tr>
      <th class="col-image">Фотография товара</th>
      <th class="column_title"><a href="#" class="column_title-link" id="product_title" data-order="<?php echo $order; ?>">Название товара</a></th>
      <th class="column_title"><a href="#" class="column_title-link" id="product_price" data-order="<?php echo $order; ?>">Цена товара</a></th>
      <th class="column_title"><a href="#" class="column_title-link" id="manufacturer_name" data-order="<?php echo $order; ?>">Производитель</a></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <tr>
        <td>
          <div>
            <img src="<?php echo $data["product_image"] ?>" alt="<?php echo $data["product_title"] ?>" width="180">
          </div>
        </td>
        <td>
          <div>
            <a class="view" id="<?php echo $data["product_id"] ?>" href="#" target="_blank"><?php echo $data["product_title"]; ?></a>
          </div>
        </td>
        <td>
          <div>
            <span><?php echo (number_format($data["product_price"], 0, "", " ")); ?> руб.</span>
          </div>
        </td>
        <td>
          <div>
            <a href="manufacturerProductList.php?manufacturer_id=<?php echo $data["manufacturer_id"] ?>" target="_blank"><?php echo $data["manufacturer_name"]; ?></a>
          </div>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>