<?php
  $name = 'Сергей';
  $age = 54;
  $email = 's.culackow@gmail.com';
  $city = 'Силламяэ';
  $about = 'веб-разработчика';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $name . ' - ' . $about;?></title>
</head>
<body>
<h1>Страница пользователя <?= $name ?></h1>
<dl>
  <dt>Имя</dt>
  <dd><?= $name ?></dd>
  <dt>Возраст</dt>
  <dd><?= $age ?></dd>
  <dt>Адрес электронной почты</dt>
  <dd><a href="mailto:<?= $email ?>"><?= $email ?></a></dd>
  <dt>Город</dt>
  <dd><?= $city ?></dd>
  <dt>О себе</dt>
  <dd><?= $about ?></dd>
</dl>

</body>
</html>