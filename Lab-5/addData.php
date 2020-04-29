<?php
require_once "./db.php";

if (!empty($_POST["product-name"])) {
  $productName = trim($_POST["product-name"]);
  $productDescription = trim($_POST["product-desc"]);
  $productPrice = $_POST["product-price"];
  $productManufacturer = $_POST["product-manufacturer"];

  // Проверка, что файл был указан и был загружен во временную папку
  if (isset($_FILES["product-img"]) && $_FILES["product-img"]["tmp_name"] != '') {
    $oldFileName = $_FILES["product-img"]["name"];
    $imageExtension = pathinfo($oldFileName, PATHINFO_EXTENSION);
    $newFolder = "./uploads-image/"; // Папка для загрузки изображений
    $oldFolder = $_FILES["product-img"]["tmp_name"];
    // Будем генерировать уникальное имя файла с помощью uniqid()
    $newFileName = uniqid();
    while (file_exists($newFolder)) {
      $newFolder .= $newFileName . "." . $imageExtension;
    }
    move_uploaded_file($oldFolder, $newFolder);
  } else { // Если нет картинки, то подставляем фотографию по умолчанию
    $defaultFileName = "nophoto.jpg";
    $newFolder = "./uploads-image/"; // Папка для загрузки изображений
    $newFolder .= $defaultFileName;
    move_uploaded_file($oldFolder, $newFolder);
  }

  // Используем именованные плейсхолдеры
  $sql = "INSERT INTO product(product_title, product_description, product_image, product_price, manufacturer_id) VALUES(:product_title, :product_description, :product_image, :product_price, :manufacturer_id)";
  $fields = ["product_title" => $productName, "product_description" => $productDescription, "product_image" => $newFolder, "product_price" => $productPrice, "manufacturer_id" => $productManufacturer];
  $stmt = $pdo->prepare($sql); // Подготавливаем запрос
  $stmt->execute($fields); // Запускаем запрос

  header("Location: ./addProduct-success.php");
}
