<?php
require "./getProductList.php";

// Получаем GET-параметры и устанавливаем cookies
if (isset($_GET["order"])) {
  $order = $_GET["order"];
  setcookie("order", $order, time()+3600);
} else {
  $order = isset($_COOKIE["order"]) ? $_COOKIE["order"] : "product_title";
}

if (isset($_GET["sort"])) {
  $sort = $_GET["sort"];
  setcookie("sort", $sort, time()+3600);
} else {
  $sort = isset($_COOKIE["sort"]) ? $_COOKIE["sort"] : "ASC";
}

if ($_GET['order'] == 'product_title') {
  $color = 'red';
} elseif ($_GET['order'] == 'product_price') {
  $color = 'blue';
} elseif ($_GET['order'] == 'manufacturer_name') {
  $color = 'black';
} else {
  $color = 'white';
}

$productList = getProductList($pdo, $order, $sort);
$sort == "DESC" ? $sort = "ASC" : $sort = "DESC";

echo "<br>";
echo $color;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Список товаров</title>
  <link rel="stylesheet" href="./main.css">
</head>

<body>
  <div class="list">
    <div class="container">
      <div class="title">
        <h1>Список товаров</h1>
      </div>
      <table>
        <thead>
          <tr>
            <th class="col-image">Фотография товара</th>
            <th class="col-title"><a href="<?php echo "?order=product_title&sort=$sort"; ?>">Название товара</a></th>
            <th class="col-price"><a href="<?php echo "?order=product_price&sort=$sort"; ?>">Цена товара</a></th>
            <th class="col-name"><a href="<?php echo "?order=manufacturer_name&sort=$sort"; ?>">Производитель</a></th>
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
                  <a href="productItem.php?product_id=<?php echo $productItem["product_id"] ?>" target="_blank"><?php echo $productItem["product_title"]; ?></a>
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
</body>

</html>
<style>
  body {
    font-size: 15px;
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
</style>
<?php
?>