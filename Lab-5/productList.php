<?php
require "./getProductList.php";

// Получаем POST-параметры и устанавливаем cookies
if (isset($_POST["columnName"])) {
  $columnName = $_POST["columnName"];
  setcookie("columnName", $columnName, time() + 100);
} else {
  $columnName = isset($_COOKIE["columnName"]) ? $_COOKIE["columnName"] : "product_title";
}

if (isset($_POST["order"])) {
  $order = $_POST["order"];
  setcookie("order", $order, time() + 100);
} else {
  $order = isset($_COOKIE["order"]) ? $_COOKIE["order"] : "ASC";
}

$productList = getProductList($pdo, $columnName, $order);
$order == "DESC" ? $order = "ASC" : $order = "DESC";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Список товаров</title>
  <link rel="stylesheet" href="./main.css">
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>
</head>
</head>

<body>
  <div class="list">
    <div class="container">
      <div class="title">
        <h1>Список товаров</h1>
      </div>
      <table id="main_table">
        <thead>
          <tr>
            <th class="col-image">Фотография товара</th>
            <th class="column_title"><a href="#" class="column_title-link" id="product_title" data-order="DESC">Название товара</a></th>
            <th class="column_title"><a href="#" class="column_title-link" id="product_price" data-order="DESC">Цена товара</a></th>
            <th class="column_title"><a href="#" class="column_title-link" id="manufacturer_name" data-order="DESC">Производитель</a></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($productList as $productItem) {
          ?>
            <tr>
              <td>
                <div>
                  <img src="<?php echo $productItem["product_image"] ?>" alt="<?php echo $productItem["product_title"] ?>" width="180">
                </div>
              </td>
              <td>
                <div>
                  <a class="view" id="<?php echo $productItem["product_id"] ?>" href="#"><?php echo $productItem["product_title"]; ?></a>
                </div>
              </td>
              <td>
                <div>
                  <span><?php echo (number_format($productItem["product_price"], 0, "", " ")); ?> руб.</span>
                </div>
              </td>
              <td>
                <div>
                  <a href="manufacturerProductList.php?manufacturer_id=<?php echo $productItem["manufacturer_id"] ?>" target="_blank"><?php echo $productItem["manufacturer_name"]; ?></a>
                </div>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="./script/main.js"></script>
</body>

</html>
<style>
  .cellFill {
    background-color: #6e00ff2e;
  }

  .arrowOrder {
    font-weight: bold;
    font-size: 20px;
  }

  body {
    font-size: 15px;
  }

  a {
    text-decoration: none;
    color: #000000;
    display: block;
    padding: 10px;
  }

  a:hover {
    text-decoration: underline;
  }

  table,
  td,
  tr {
    border: 2px solid #000000;
    border-collapse: collapse;
    padding: 10px;
    text-align: center;
    vertical-align: middle;
  }

  th {
    color: #000000;
    text-align: center;
    vertical-align: middle;
    border: 2px solid #000000;
    border-collapse: collapse;
  }

  .col-title {
    width: 200px;
  }
</style>