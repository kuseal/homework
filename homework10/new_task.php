<?php
  session_start();

  if (!isset($_SESSION['user_id']) or empty($_SESSION['user_id'])) {
    header('Location:index.php');
    die();
  }

  include 'DB.php';

  $db = new DB();
  $error = '';

  if (!empty($_POST)) {
    if (!empty($_POST['desc'])) {
      if ($db->newTask($_SESSION['user_id'], $_POST['desc'])) {
        header('Location:index.php');
        die();
      }else{
        $error = 'Задача не добавлена';
      }
    } else {
      $error = 'Поле не заполнено';
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Новая задача</title>
  <style>
    body {
      width: 900px;
      margin: 0 auto;
    }

    form {
      width: 400px;
    }

    textarea {
      width: 100%;
    }

    div {
      margin: 10px 0;
    }

    .error {
      color: red;
    }
  </style>
</head>
<body>
<h1>Добавить задачу</h1>
<p class="error"><?php echo $error; ?></p>
<form method="post">
  <div><textarea name="desc" rows="5" placeholder="Описание задачи"></textarea></div>
  <div><input type="submit" value="Добавить"></div>
</form>
</body>
</html>
