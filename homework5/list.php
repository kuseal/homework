<?php

  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  function vardata($data)
  {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
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
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tests list</title>
</head>
<body>
<?php foreach ($links as $link): ?>
  <a href="test.php?test=<?php echo $link; ?>">Test <?php echo $num++; ?></a><br>
<?php endforeach; ?>
</body>
</html>