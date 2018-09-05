<?php
  session_start();

  if (empty($_SESSION['user'])) {
    header("HTTP/1.0 403 Forbidden");
    die('Закрытый доступ');
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
      <?php if (isset($_SESSION['user']['status']) && $_SESSION['user']['status'] == '1'): ?>
        <a href="admin.php"><button>Добавить тест</button></a>
      <?php endif; ?>
    </td>
  </tr>
</table>



</body>
</html>