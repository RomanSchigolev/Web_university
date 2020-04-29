<?php
require "./getManufacturer.php";

$manufacturerList = getManufacturer($pdo);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Добавление товара</title>
  <link rel="stylesheet" href="./main.css">
</head>

<body>
  <div class="content">
    <div class="block">
      <div class="title">
        <h1>Добавить товар</h1>
      </div>
      <form action="./addData.php" method="post" name="form" class="form" enctype="multipart/form-data">

        <div class="form__name">
          <label for="input-name">
            <input type="text" placeholder="Название товара" name="product-name" id="product-name">
          </label>
        </div>

        <div class="form_desc">
          <label for="product-desc">
            <textarea name="product-desc" id="product-desc" placeholder="Описание товара"></textarea>
          </label>
        </div>

        <div class="form_price">
          <label for="product-price">
            <input type="text" placeholder="Цена товара" name="product-price" id="product-price">
          </label>
        </div>

        <div class="form__select">
          <label>Выберите производителя:
            <select name="product-manufacturer">
              <?php foreach ($manufacturerList as $manufacturerItem) : ?>
                <option value="<?= $manufacturerItem["id"] ?>"><?= $manufacturerItem["manufacturer_name"] ?></option>
              <?php endforeach; ?>
            </select>
          </label>
        </div>

        <div class="form__file">
          <label for="file">Загрузить файл (изображение):</label>
          <input type="file" accept="image/jpeg" name="product-img" id="product-img">
        </div>

        <div class="form__submit">
          <input type="submit" value="Отправить" name="done">
        </div>

      </form>
    </div>
    <div class="showListProduct">
      <a class="showListProduct_link" href="./productList.php" target="_blank">Посмотреть полный список товаров</a>
    </div>
  </div>
</body>

</html>