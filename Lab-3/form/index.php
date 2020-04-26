<?php
// После нажатия кнопки "отправить".
 if (count($_POST) > 0) {
  $nameInput = trim($_POST["input-name"]);
  $radioChoice = $_POST["input__radio"];
  $technologies = $_POST["tech"];
  $sport = $_POST["sport"];

  // Проверка: заполнены ли все поля.
  if (!isset($nameInput) || !isset($radioChoice) || !isset($technologies) || !sizeof($_FILES)) {
    $msg = "Пожалуйста, заполните все поля формы.";
  } 
  elseif (!ctype_alpha($nameInput) || strlen($nameInput) < 2) {
    $msg = "Хмм, в имени должно быть больше одной буквы.";
  }
  // Заносим информацию в текстовый файл.
  else {
    $textFile = "./formDataList.txt";
    file_put_contents($textFile, "$nameInput-|-$radioChoice-|-$sport-|-", FILE_APPEND);

    // Загрузка картинок(jpeg) в папку uploads.
    $fileName = $_FILES["file"]["name"];
    $parts = pathinfo($fileName);
    $oldFolder = $_FILES["file"]["tmp_name"];
    $newFolder = "./uploads/";
    $index = 1;
    // Переименовываем картинки в 1.jpg, 2.jpg и так далее.
    while(file_exists($newFolder)){
      $newFolder = "./uploads/" . $index . "." . $parts["extension"];
      $index++;
    }
    file_put_contents($textFile, "$newFolder-|-", FILE_APPEND);

    foreach ($technologies as $technologie) {
      file_put_contents($textFile, "$technologie-|-", FILE_APPEND);
    }

    file_put_contents($textFile, "\r\n", FILE_APPEND);
    move_uploaded_file($oldFolder, $newFolder);
    $msg = "Ваши данные были обработаны.";
  } 
}
else {
  $nameInput = "";
  $radioChoice = "";
  $technologies = array();
  $sport = "";
  $msg = "Пожалуйста, заполните форму.";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Форма</title>
  <link rel="stylesheet" href="main.css">
</head>
<body>
  <div class="block">
    <form method="post" name="form" class="form" enctype="multipart/form-data">
      <div class="form__text">
        <label for="input-name"></label>
        <input type="text" placeholder="Ваше имя" name="input-name" id="input-name" value="<?php echo $nameInput?>">
      </div>
      <div class="form__radio">
        <legend class="title">Что выберешь?</legend>
        <label for="input__radio-front">
          <input type="radio" id="input__radio" name="input__radio" value="Tea">
          Tea
          <input type="radio" id="input__radio" name="input__radio" value="Coffee">
          Coffee
          <input type="radio" id="input__radio" name="input__radio" value="Juice">
          Juice
        </label>
      </div>
      <div class="form__checkbox">
        <legend class="title">Что знаешь?</legend>
        <label for="js">
          <input id="js" type="checkbox" name="tech[]" value="JavaScript">
          JavaScript
        </label>
        <label for="html">
          <input id="html" type="checkbox" name="tech[]" value="HTML">
          HTML
        </label>
        <label for="Java">
          <input id="Java" type="checkbox" name="tech[]" value="Java">
          Java
        </label>
        <label for="css">
          <input id="css" type="checkbox" name="tech[]" value="CSS">
          CSS
        </label>
        <label for="python">
          <input id="python" type="checkbox" name="tech[]" value="Python">
          Python
        </label>
        <label for="algol">
          <input id="algol" type="checkbox" name="tech[]" value="Algol">
          Algol
        </label>
        <label for="git">
          <input id="git" type="checkbox" name="tech[]" value="Git">
          Git
        </label>
      </div>
      <div class="form__select">
        <legend class="title">Выберите ваш любимый вид спорта?</legend>
        <select name="sport">
          <option value="Football">Football</option>
          <option value="Basketball">Basketball</option>
          <option value="Hockey">Hockey</option>
          <option value="Volleyball">Volleyball</option>
          <option value="Tennis">Tennis</option>
        </select>
      </div>
      <div class="form__file">
        <label for="file">Выберете файл (изображение)</label>
        <input id="file" type="file" accept="image/jpeg" name="file">
      </div>
      <div class="form__submit">
        <input type="submit" value="Отправить" name="done">
      </div>
    </form>
    <div class="message">
      <span>
      <?php echo $msg;?>
      </span>
    </div>
  </div>
  <script src="main.js"></script>
</body>
</html>
<style>
.message {
  text-align: center;
  margin-top: 20px;
}
</style>