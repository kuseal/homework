<?php
  if (isset($argv[1])) {
    if ($argv[1] === '--today') {
      $row = 1;
      $handle = fopen("money.csv", "r");
      if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
          if ($data[0] === date('Y-m-d')) {
            $arr += $data[1];
          }
          $row++;
        }
        fclose($handle);
        echo date('Y-m-d')." расход за день $arr";
      }
    } else {
      $date = date('Y-m-d');
      $price = $argv[1];
      $prod = implode(' ', array_slice($argv, 2));
      $list = [
          [$date, $price, $prod]
      ];
      $fp = fopen(__DIR__ . "/money.csv", 'a+');

      foreach ($list as $item) {
        fputcsv($fp, $item, ';');
      }
      fclose($fp);

      echo "Добавлена строка: $date,  $price, $prod";
    }

  }else{
    echo 'Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
  }

