<?php
require_once "./db.php";

$productID = $_GET["product_id"];

$sql = $pdo->query("SELECT * FROM product JOIN  manufacturer ON product.manufacturer_id = manufacturer.id WHERE product.product_id = $productID");
?>
<?php
while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
  <div class="modalProduct">
    <div class="modalProduct_img">
      <img src="<?php echo $data["product_image"] ?>" alt="<?php echo $data["product_title"] ?>" width="180">
    </div>
    <ul class="modalProduct_list">
      <li class="modalProduct_item">
        <label>Название товара:</label>
        <span><?php echo $data["product_title"]; ?></span>
      </li>
      <li class="modalProduct_item">
        <label>Цена товара:</label>
        <span><?php echo (number_format($data["product_price"], 0, "", " ")); ?> руб.</span>
      </li>
      <li class="modalProduct_item">
        <label>Описание товара:</label>
        <p><?php echo $data["product_description"]; ?></p>
      </li>
      <li class="modalProduct_item">
        <label>Производитель:</label>
        <span><?php echo $data["manufacturer_name"]; ?></span>
      </li>
    </ul>
  </div>
<?php
}
?>
<style>
  .modalProduct {
    display: flex;
    margin-top: 20px;
  }

  .modalProduct_list {
    list-style: none;
  }

  .modalProduct_item label {
    font-weight: bold;
  }

  .modalProduct_item:not(:last-child) {
    margin-bottom: 10px;
  }

  .modalProduct_img {
    margin-right: 40px;
  }
</style>