<?php
  /*Числовой ряд Фибоначчи */

  if (isset($_GET['num']) and !empty($_GET['num'])) {
    $x = $_GET['num'];
  } else {
    $x = 1;
  }

  $x1 = 1;
  $x2 = 1;
  $i = 1;

  if ($x1 > $x) {
    $info = "<p>Задуманное число \"$x\"  НЕ входит в числовой ряд </p>";
  }
  while ($x1 <= $x) {
    if ($x1 == $x) {
      $info = "<p>Задуманное число \"$x\" входит в числовой ряд </p>";
    } else {
      $info = "<p>Задуманное число \"$x\"  НЕ входит в числовой ряд </p>";
    }
    $x3 = $x1;
    $x1 = $x1 + $x2;
    $x2 = $x3;
    $i++;
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fibonacci numbers</title>
</head>
<body>
<?php echo $info; ?>
<form method="GET" action="#">
  <input name="num" placeholder="number">
  <button type="submit">Go</button>
</form>
</body>
</html>






