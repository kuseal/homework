<?php
  $results = [];
  if (isset($_GET['test'])) {
    $query = htmlspecialchars($_GET['test']);
    $data = file_get_contents(__DIR__ . '/json/' . $query . '.json');
    $results = json_decode($data, true);
    if (json_last_error() != JSON_ERROR_NONE) {
      echo 'File error';
      exit;
    }
  }
$info = [];
  if (!empty($_POST)) {
    $row = 0;
    while ($row < count($results)) {
      $array_params[] = $results[$row]['params'];
      if (array_key_exists($results[$row]['name'], $_POST)) {
        foreach ($results[$row]['params'] as $key => $value) {
          if ($key == $_POST[$results[$row]['name']]) {
            if ($value) {
              $info[] = 'Тест ' . $results[$row]['label'] . ': Ответ ' . $key . ' правильный<br>';
            } else {
              $info[] = 'Тест ' . $results[$row]['label'] . ': Ответ ' . $key . ' <b>НЕ</b> правильный<br>';
            }
          }
        }
      }else{
        $info[] = 'Тест ' . $results[$row]['label'] . ': <b>Нет ответа</b><br>';
      }
      $row++;
    }

  }else{
    $info[] = 'Нет ни одного ответа!';
  }

?>
  <!doctype html>
  <html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Тесты</title>
    <style>
      form {
        width: 600px;
      }

      fieldset, div {
        margin: 10px 0;
      }
    </style>
  </head>
  <body>
  <?php if (!empty($info)): ?>
    <?php foreach ($info as $value): ?>
      <?php echo $value;?>
    <?php endforeach; ?>
  <?php endif; ?>


  <?php if (isset($query)): ?>
    <form method="POST" action="test.php?test=<?php echo $query; ?>">
      <?php foreach ($results as $result): ?>
        <fieldset>
          <legend><?php echo $result['label'] ?></legend>
          <?php foreach ($result['params'] as $key => $param): ?>
            <div><input type="radio" name="<?php echo $result['name']; ?>" value="<?php echo $key; ?>"> <?php echo $key; ?></div>
          <?php endforeach; ?>
        </fieldset>
      <?php endforeach; ?>
      <div><input type="submit" value="Отправить"></div>
    </form>
  <?php else: ?>
    <a href="list.php">Tests list</a>
  <?php endif; ?>
  <div><a href="list.php">Список тестов</a> </div>
  </body>
  </html>
