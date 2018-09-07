<?php
  session_start();

  if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    die();
  }
  if (empty($_SESSION['user'])) {
    header($_SERVER['SERVER_PROTOCOL'] . "403 Forbidden");
    die('<h2>Ошибка 403</h2> Закрытый доступ');
  }

  $dataTests = scandir('json');

  $arr = [];
  $links = [];
  for ($i = 0; $i < count($dataTests); $i++) {
    $arr[] = explode('.', $dataTests[$i]);
    if (isset($arr[$i][1]) && $arr[$i][1] == 'json' && count($arr[$i]) === 2) {
      $links[] = $arr[$i][0];
    }
  }
  $num = 1;

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tests list</title>
  <style>
    div {
      margin: 10px 0;
    }
  </style>
</head>
<body>
<h2>Список тестов</h2>
<table>
  <tr>
    <td width="50%">
      <?php foreach ($links as $link): ?>
        <a href="test.php?test=<?php echo $link; ?>">Test <?php echo $num++; ?></a><br>
      <?php endforeach; ?>
    </td>
    <td width="50%">
      <?php if (!isset($_SESSION['user']['status']) || $_SESSION['user']['status'] != '1'): ?>
        <a href="admin.php"><button>Добавить тест</button></a>
      <?php endif; ?>
    </td>
  </tr>
</table>
<div><a style="color: red" href="list.php?logout">Выход</a></div>


</body>
</html>