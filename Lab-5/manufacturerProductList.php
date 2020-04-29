<?php
require "./getManufacturerProductList.php";

// Получаем GET-параметры
if (isset($_GET["columnName"])) {
  $columnName = $_GET["columnName"];
} else {
  $columnName = "product_title";
}

if (isset($_GET["order"])) {
  $order = $_GET["order"];
} else {
  $order = "ASC";
}

$manufacturerID = $_GET["manufacturer_id"];
$manufacturerProductList = getManufacturerProductList($pdo, $manufacturerID, $columnName, $order);
$order == "DESC" ? $order = "ASC" : $order = "DESC";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Список товаров производителя <?= $manufacturerProductList["0"]["manufacturer_name"]; ?></title>
  <link rel="stylesheet" href="./main.css">
</head>

<body>
  <div class="list">
    <div class="container">
      <div class="title">
        <h1>Список товаров производителя <?= $manufacturerProductList["0"]["manufacturer_name"]; ?></h1>
      </div>
      <table>
        <thead>
          <tr>
            <th class="col-image">Фотография товара</th>
            <th class="col-title"><a href="<?php echo "?manufacturer_id=$manufacturerID&columnName=product_title&order=$order"; ?>">Название товара</a></th>
            <th class="col-desc">Описание товара</th>
            <th class="col-price"><a href="<?php echo "?manufacturer_id=$manufacturerID&columnName=product_price&order=$order"; ?>">Цена товара</a></th>
            <th class="col-name">Производитель</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($manufacturerProductList as $manufacturerProductItem) {
          ?>
            <tr>
              <td>
                <div>
                  <img src="<?php echo $manufacturerProductItem["product_image"] ?>" alt="<?php echo $manufacturerProductItem["product_title"] ?>" width="180">
                </div>
              </td>
              <td>
                <div>
                  <span><?php echo $manufacturerProductItem["product_title"]; ?></span>
                </div>
              </td>
              <td>
                <div>
                  <p><?php echo $manufacturerProductItem["product_description"]; ?></p>
                </div>
              </td>
              <td>
                <div>
                  <span><?php echo (number_format($manufacturerProductItem["product_price"], 0, "", " ")); ?></span>
                </div>
              </td>
              </td>
              <td>
                <div>
                  <span><?php echo $manufacturerProductItem["manufacturer_name"]; ?></span>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="backToList">
        <a class="backToListLink" href="./productList.php">Вернуться к списку всех товаров</a>
      </div>
    </div>
  </div>
</body>

</html>

<style>
  body {
    font-size: 15px;
  }

  .container {
    max-width: 90vw;
  }

  a {
    text-decoration: none;
    color: #000000;
  }

  a:hover {
    text-decoration: underline;
  }

  table,
  td,
  tr,
  th {
    border: 2px solid #000000;
    border-collapse: collapse;
    padding: 10px;
    text-align: center;
    vertical-align: middle;
  }

  th {
    color: #000000;
  }

  .col-title {
    width: 200px;
  }

  .col-price {
    width: 130px;
  }

  .backToList {
    margin-top: 50px;
  }

  .backToListLink {
    padding: 10px;
    border-radius: 10px;
    background-color: rgb(38, 90, 169);
    color: #ffffff;
  }
</style>