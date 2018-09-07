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

  function stringx($im, $fontSiize, $fontFile, $string)
  {
    $bbox = imageftbbox($fontSiize, 0, $fontFile, $string);
    $x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) - 5;
    return $x;
  }

  $results = [];
  if (!empty($_GET['test'])) {
    $query = htmlspecialchars($_GET['test']);
    $data = file_get_contents(__DIR__ . '/json/' . $query . '.json');
    if (!$data) {
      header($_SERVER['SERVER_PROTOCOL'] . " Not Found");
      die("<h2>Ошибка 404</h2> <p>Нет такой страницы</p>");
    }
    $results = json_decode($data, true);
    if (json_last_error() != JSON_ERROR_NONE) {
      echo 'File error';
      exit;
    }
  } else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    die("<h2>Ошибка 404</h2> <p>Нет такой страницы</p>");
  }
  $info = [];
  if (!empty($_POST)) {

    $userName = $_SESSION['user']['firstName'];
    $countResults = count($results);
    $row = 0;
    $poin = [];

    while ($row < $countResults) {
      if (array_key_exists($results[$row]['name'], $_POST)) {
        foreach ($results[$row]['params'] as $key => $value) {
          if ($key == $_POST[$results[$row]['name']]) {
            if ($value) {
              $poin[] = '1';
            } else {
              $poin[] = '0';
            }
          }
          $num[] = $_POST[$results[$row]['name']];
        }
      }
      $row++;
    }

    if (!empty($poin)) {
      $poins = array_sum($poin);
    } else {
      $poins = '0';
    }

    if (empty($num)) {
      $info[] = 'Нет ни одного ответа';
    } else {
      $im = imagecreatefrompng(__DIR__ . '/images/sert14.png');
      $black = imagecolorallocate($im, 0, 0, 0);
      $fontFile = __DIR__ . '/fonts/arial.ttf';

      $string1 = 'о прохождлении теста выдан на имя';
      $fontSize1 = 13;

      $string2 = $userName;
      $fontSize2 = 16;

      $string3 = "количество баллов $poins из $countResults";
      $fontSize3 = 16;

      $x1 = stringx($im, $fontSize1, $fontFile, $string1);
      $x2 = stringx($im, $fontSize2, $fontFile, $string2);
      $x3 = stringx($im, $fontSize3, $fontFile, $string3);


      imagefttext($im, $fontSize1, 0, $x1, 250, $black, $fontFile, $string1);
      imagefttext($im, $fontSize2, 0, $x2, 300, $black, $fontFile, $string2);
      imagefttext($im, $fontSize3, 0, $x3, 350, $black, $fontFile, $string3);

      header('Content-Type: image/png');

      imagepng($im);
      imagedestroy($im);
      die();
    }
  }

?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Тесты</title>
  <style>
    div {
      margin: 10px 0;
    }

    form {
      width: 600px;
    }

    fieldset, div {
      margin: 10px 0;
    }

    .error {
      color: red;
    }
  </style>
</head>
<body>
<h2>Тестируемый <?php echo $_SESSION['user']['firstName']; ?></h2>
<?php if (!empty($info)): ?>
  <?php foreach ($info as $value): ?>
    <p class="error"><?php echo $value; ?></p>
  <?php endforeach; ?>
<?php endif; ?>


<?php if (isset($query)): ?>
  <form method="POST" action="test.php?test=<?php echo $query; ?>">
    <?php foreach ($results as $result): ?>
      <fieldset>
        <legend><?php echo $result['label'] ?></legend>
        <?php foreach ($result['params'] as $key => $param): ?>
          <div>
            <input type="radio" name="<?php echo $result['name']; ?>" value="<?php echo $key; ?>"> <?php echo $key; ?>
          </div>
        <?php endforeach; ?>
      </fieldset>
    <?php endforeach; ?>
    <div><input type="submit" value="Отправить"></div>
  </form>
<?php else: ?>
  <a href="list.php">Список тестов</a>
<?php endif; ?>
<div><a href="list.php">Список тестов</a></div>
<div><a style="color: red" href="list.php?logout">Выход</a></div>
</body>
</html>
