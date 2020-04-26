<?php
require "./getProductItem.php";

$productID = $_GET["product_id"];
$productItem = getProductItem($pdo, $productID);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>О товаре <?=$productItem["0"]["product_title"];?></title>
  <link rel="stylesheet" href="./main.css">
</head>

<body>
  <div class="list">
    <div class="container">
      <div class="title">
        <h1>Подробнее о товаре <?=$productItem["0"]["product_title"];?></h1>
      </div>
      <table>
        <thead>
          <tr>
            <th class="col-image">Фотография товара</th>
            <th class="col-title">Название товара</a></th>
            <th class="col-desc">Описание товара</th>
            <th class="col-price">Цена товара</a></th>
            <th class="col-name">Производитель</a></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($productItem as $productItemField) {
          ?>
          <tr>
              <td>
                <div>
                  <img src="<?php echo $productItemField["product_image"] ?>" alt="<?php echo $productItemField["product_title"] ?>" width="180">
                </div>
              </td>
              <td>
                <div>
                  <span><?php echo $productItemField["product_title"]; ?></span>
                </div>
              </td>
              <td>
                <div>
                  <p><?php echo $productItemField["product_description"]; ?></p>
                </div>
              </td>
              <td>
                <div>
                  <span><?php echo (number_format($productItemField["product_price"], 0, "", " ")); ?></span>
                </div>
              </td>
              </td>
              <td>
                <div>
                  <span><?php echo $productItemField["manufacturer_name"];?></span>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
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
</style>