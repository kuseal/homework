<?php
  // Числовой ряд Фибоначчи

  if (isset($_GET['num']) and !empty($_GET['num'])) {
    $x = $_GET['num'];
  } else {
    $x = '0';
  }

  $x1 = 0;
  $x2 = 1;
  $i = 1;

  while (true) {
    if ($x1 > $x) {
      echo "Задуманное число \"$x\"  НЕ входит в числовой ряд <br><br>";
      break;
    }

    if ($x1 == $x) {
      echo "Задуманное число \"$x\" входит в числовой ряд <br><br>";
      break;
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
<form method="GET" action="#">
  <input name="num" placeholder="number">
  <button type="submit">Go</button>
</form>
</body>
</html>






