<?php
  session_start();
  if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    die();
  }

  if (!isset($_SESSION['user']['status']) || $_SESSION['user']['status'] != '1') {
    header($_SERVER['SERVER_PROTOCOL'] . "403 Forbidden");
    die('<h2>Ошибка 403</h2> Закрытый доступ');
  }
  $data = scandir('json');
  $arr = [];
  $links = [];
  for ($i = 0; $i < count($data); $i++) {
    $arr[] = explode('.', $data[$i]);
    if (isset($arr[$i][1]) && $arr[$i][1] == 'json' && count($arr[$i]) === 2) {
      $links[] = $arr[$i][0];
    }
  }

  $num = 1;

  if (isset($_FILES)) {
    if (array_key_exists("userfile", $_FILES)) {
      $dirname = 'json';
      $count = count(scandir('json')) - 2;
      $filename = 'test_' . ($count + 1) . '.json';
      $uploadfile = $dirname . '/' . $filename;

      if ($_FILES['userfile']['type'] == "application/json") {
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
          header('Location:list.php');
        } else {
          echo "Возможная атака с помощью файловой загрузки!\n";
        }
      } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
      }
    }
  }
if(isset($_GET['delete'])){
  unlink(__DIR__.'/json/'.$_GET['delete'].'.json');
  header('Location:admin.php');
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    Admin
  </title>
  <style>
    div {
      margin: 10px 0;
    }
    table{
      width: 600px;
    }
    .delete{
      color: red;
    }
  </style>
</head>
<body>
<h2>Админ</h2>
<table>
  <tr>
    <td width="50%">
      <h3>Список тестов</h3>
      <?php foreach ($links as $link): ?>
        <a href="test.php?test=<?php echo $link; ?>">Test <?php echo $num++; ?></a> * <a class="delete" href="admin.php?delete=<?php echo $link; ?>">Удалить</a> <br>
      <?php endforeach; ?>
    </td>
    <td width="50%">
      <h3>Добавить тест</h3>
      <form enctype="multipart/form-data" action="admin.php" method="POST">
        <div><input type="file" name="userfile"></div>
        <div><input type="submit" value="Отправить"></div>
      </form>
    </td>
  </tr>
</table>
<div><a style="color: red" href="list.php?logout">Выход</a></div>
</body>
</html>



